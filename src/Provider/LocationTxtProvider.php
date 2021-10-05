<?php

namespace Lesson\GpsConverter\Provider;

use Lesson\GpsConverter\Entity\Bore;
use Lesson\GpsConverter\Entity\Location;

class LocationTxtProvider
{
    public function getBores(): array
    {
        $array = explode("\n", file_get_contents('./src/data/coord.txt', true));
        $locations = [];
        $location  = [];
        foreach($array as $line) {
            if (strpos($line, '°') !== false) {
                $pos = strpos($line, "\t", 0);
                $name = (integer)substr($line, 0, $pos);
                $degree = (integer)substr($line, $pos, 4);
                $pos += 5;
                $minute = (integer)substr($line, $pos, 4);
                $pos += 3;
                $second = (integer)substr($line, $pos, 4);
                $pos += 3;
                $part_s = (integer)substr($line, $pos, 4);
                $pos += 3;
                $latitude = $degree + $minute / 60;
                $latitude += $second / 3600;
                $latitude += ($part_s / 100) / 3600;
                $degree = (integer)substr($line, $pos, 4);
                $pos += 5;
                $minute = (integer)substr($line, $pos, 4);
                $pos += 3;
                $second = (integer)substr($line, $pos, 4);
                $pos += 3;
                $part_s = (integer)substr($line, $pos, 4);
                $longitude = $degree + $minute / 60;
                $longitude += $second / 3600;
                $longitude += ($part_s / 100) / 3600;
                $location->addBore(new Bore($name, $latitude, $longitude));
            } else {
                if (strlen($line) !== 0) {
                    if (!empty($location)) $locations[] = $location;
                    $location = new Location($line);
                }
            }
        }
        return $locations;
    }
}