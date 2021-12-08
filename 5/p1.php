<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$grid = [];


foreach($lines as $line) {

    $points = explode('->', $line);
    list($x1, $y1) = explode(',', trim($points[0]));
    list($x2, $y2) = explode(',', trim($points[1]));

    if($x1 === $x2) {

        for($i = min($y1, $y2); $i <= max($y1, $y2); $i++) {
            if(!isset($grid[$x1])) $grid[$x1] = [];
            if(!isset($grid[$x1][$i])) $grid[$x1][$i] = 0;
            $grid[$x1][$i]++;
        }

    } else if($y1 === $y2) {

        for($i = min($x1, $x2); $i <= max($x1, $x2); $i++) {
            if(!isset($grid[$i])) $grid[$i] = [];
            if(!isset($grid[$i][$y1])) $grid[$i][$y1] = 0;
            $grid[$i][$y1]++;
        }

    }
}

$amount = 0;
foreach($grid as $x => $content) {
    foreach($content as $y => $value) {
        if($value >= 2) {
            $amount++;
        }
    }
}
var_dump($amount);
?>