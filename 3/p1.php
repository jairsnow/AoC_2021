<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$counter = [];

foreach($lines as $line) {
    foreach(str_split($line) as $i => $bit) {

        if(!isset($counter[$i])) {
            $counter[$i] = [
                '0' => 0,
                '1' => 0
            ];
        }

        $counter[$i][$bit]++;
    }
}

$gammaB = '';
$epsilonB = '';

foreach($counter as $bitPosition) {

    if($bitPosition['0'] > $bitPosition['1']) {
        $gammaB .= "0";
        $epsilonB .= "1";
    } else if($bitPosition['1'] > $bitPosition['0']) {
        $gammaB .= "1";
        $epsilonB .= "0";
    } else {
        echo "The 0 and 1 are even -.-\"";
        exit();
    }

}

$gamma = bindec($gammaB);
$epsilon = bindec($epsilonB);

echo "Gamma: ${gamma}" . PHP_EOL;
echo "Epsilon: ${epsilon}" . PHP_EOL;
echo "Final result: " . $gamma * $epsilon . PHP_EOL;
?>