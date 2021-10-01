<?php

namespace Lesson\GpsConverter;

/*$str = "55°27'37,41";

$degree = (integer)substr($str, 0, 2);
$minute = (integer)substr($str, 4, 2);
$second = (integer)substr($str, 7, 2);
$part_s = (integer)substr($str, 10, 2);

echo $str . "<br>";
$coord = $degree + $minute / 60;
$coord = $coord + $second / 3600;
$coord = $coord + ($part_s / 100) / 3600;
//echo $coord;
*/

$file = file_get_contents('./src/coord.txt', true);
$out = '';
$array = explode("\n", $file);
foreach($array as $ar)
{
    //$fixedFile .= $ar."<br>\n";
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
        $coord1 = $coord1 + $second1 / 3600;
        $coord1 = $coord1 + ($part_s1 / 100) / 3600;
        $coord2 = $degree2 + $minute2 / 60;
        $coord2 = $coord2 + $second2 / 3600;
        $coord2 = $coord2 + ($part_s2 / 100) / 3600;
        //echo $ar . " >> " . $coord1 . " " . $coord2 . "<br>";
        $out .= "<Placemark id=\"0C69AD0E2E1D5C1207CD\">
		<name>скв_" . $name . "</name>
		<Point>
			<coordinates>" . $coord1 . "," . $coord2 . ",0</coordinates>
		</Point>
	</Placemark>";
    }
}
file_put_contents('./src/out_placemark.txt', $out);