<?php

$source = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$counter = 0;

foreach($source as $i => $value) {

    if($i < 3) {
        continue;
    }

    if($value + $source[$i - 1] + $source[$i - 2] > $source[$i - 1] + $source[$i - 2] + $source[$i - 3]) {
        $counter++;
    }

}

echo "Increased values: ${counter}" . PHP_EOL;

?>