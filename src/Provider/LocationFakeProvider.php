<?php

namespace Lesson\GpsConverter\Provider;

use Lesson\GpsConverter\Entity\Bore;
use Lesson\GpsConverter\Entity\Location;

class LocationFakeProvider
{
    public function getLocations(): array
    {
        return [
            new Location('test_location_1', ...[new Bore(1, 90,90)]),
            new Location('test_location_2', ...[new Bore(1, 90.1,90.1)]),
        ];
    }
}