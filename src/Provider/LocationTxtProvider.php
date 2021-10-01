<?php

namespace Lesson\GpsConverter\Provider;

class LocationTxtProvider
{
    public function getBores()
    {
        $array = explode("\n", file_get_contents('./coord.txt', true));
        foreach($array as $ar)
        {
        if (strpos($ar, '°') !== false) {
            $pos = strpos($ar, "\t", 0);
            $name = substr($ar, 0, $pos);
            $degree1 = (integer)substr($ar, $pos, 4);
            $pos += 5;
            $minute1 = (integer)substr($ar, $pos, 4);
            $pos += 3;
            $second1 = (integer)substr($ar, $pos, 4);
            $pos += 3;
            $part_s1 = (integer)substr($ar, $pos, 4);
            $pos += 3;
            $degree2 = (integer)substr($ar, $pos, 4);
            $pos += 5;
            $minute2 = (integer)substr($ar, $pos, 4);
            $pos += 3;
            $second2 = (integer)substr($ar, $pos, 4);
            $pos += 3;
            $part_s2 = (integer)substr($ar, $pos, 4);
            $coord1 = $degree1 + $minute1 / 60;
            $coord1 += $second1 / 3600;
            $coord1 += ($part_s1 / 100) / 3600;
            $coord2 = $degree2 + $minute2 / 60;
            $coord2 += $second2 / 3600;
            $coord2 += ($part_s2 / 100) / 3600;
            }
        }
    }
}