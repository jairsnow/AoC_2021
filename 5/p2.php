<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$grid = [];

foreach($lines as $line) {

    $points = explode('->', $line);
    list($x1, $y1) = explode(',', trim($points[0]));
    list($x2, $y2) = explode(',', trim($points[1]));

    if($x1 === $x2) {

        for($y = min($y1, $y2); $y <= max($y1, $y2); $y++) {
            if(!isset($grid[$y])) $grid[$y] = [];
            if(!isset($grid[$y][$x1])) $grid[$y][$x1] = 0;
            $grid[$y][$x1]++;
        }

    } else if($y1 === $y2) {

        for($x = min($x1, $x2); $x <= max($x1, $x2); $x++) {
            if(!isset($grid[$y1])) $grid[$y1] = [];
            if(!isset($grid[$y1][$x])) $grid[$y1][$x] = 0;
            $grid[$y1][$x]++;
        }

    } else {

        $point_reach = false;
        $x = $x1;
        $y = $y1;

        while(!$point_reach) {

            if(!isset($grid[$y])) $grid[$y] = [];
            if(!isset($grid[$y][$x])) $grid[$y][$x] = 0;
            $grid[$y][$x]++;

            if($x < $x2) $x++;
            if($x > $x2) $x--;
            if($y < $y2) $y++;
            if($y > $y2) $y--;

            if($x == $x2 and $y == $y2) {
                if(!isset($grid[$y])) $grid[$y] = [];
                if(!isset($grid[$y][$x])) $grid[$y][$x] = 0;
                $grid[$y][$x]++;
                $point_reach = true;
            }

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

echo "Amount: " . $amount . PHP_EOL;


?>