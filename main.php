#!/usr/bin/env php
<?php

use Lesson\GpsConverter\Provider\LocationTxtProvider;

require_once 'vendor/autoload.php';

$provider = new LocationTxtProvider();
$provider->load('./src/data/coordinates.txt');

foreach ($provider->getLocations() as $location) {
    printf("Location: '%s' has %u bores\n", $location->getName(), count($location->getBores()));
}