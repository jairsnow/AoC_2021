<?php

$source = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$counter = 0;

foreach($source as $i => $amount) {

    if($i === 0) {
        continue;
    }

    if($amount > $source[$i - 1]) {
        $counter++;
    }

}

echo "Increased values: ${counter}" . PHP_EOL;

?>