<?php

namespace Lesson\GpsConverter\Provider;

use Exception;
use Lesson\GpsConverter\Entity\Bore;
use Lesson\GpsConverter\Entity\Location;

class LocationTxtProvider
{
    private array $locations = [];

    /**
     * @throws Exception
     */
    public function load(string $path): self
    {
        $lines = explode("\n", file_get_contents($path));
        $currentLineIsLocation = true;
        $currentLocation = null;
        $result = [];
        foreach ($lines as $line) {
            if ($line === '') {
                if ($currentLocation instanceof Location) {
                    $result[] = $currentLocation;
                    $currentLineIsLocation = true;
                    $currentLocation = null;
                }
                continue;
            }

            if (true === $currentLineIsLocation) {
                $currentLocation = new Location($line);
                $currentLineIsLocation = false;
            } else {
                $exploded = explode("\t", $line);

                if (count($exploded) !== 3) {
                    throw new Exception('Bad line format');
                }

                if (false === is_numeric($exploded[0])) {
                    throw new Exception('Bore number is wrong');
                }

                if ($currentLocation === null) {
                    throw new Exception('Location parsing error');
                }

                $currentLocation->addBore(
                    new Bore(
                        (int)$exploded[0],
                        $this->stringToCoordinate($exploded[1]),
                        $this->stringToCoordinate($exploded[2])
                    )
                );
            }
        }
        $this->locations = $result;
        return $this;
    }

    /**
     * @return Location[]
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

    protected function stringToCoordinate(string $coordinate): float
    {
        $prepared = str_replace(' ', '', $coordinate);
        $prepared = str_replace(',', '.', $prepared);

        /** @see https://www.designcise.com/web/tutorial/is-there-a-way-to-use-multiple-delimiters-with-the-php-explode-function */
        $exploded = preg_split("/[°'\"]/", $prepared, -1, PREG_SPLIT_NO_EMPTY);

        if (
            (count($exploded) !== 3) ||
            (false === (is_numeric($exploded[0]) && is_numeric($exploded[1]) && is_numeric($exploded[2])))
        ) {
            throw new Exception('Bad coordinates format. Use format: 55°27\'37,41"');
        }

        $degree = floatval($exploded[0]);
        $minute = floatval($exploded[1]);
        $second = floatval($exploded[2]);

        return $degree + ($minute / 60) + ($second / 3600);
    }
}