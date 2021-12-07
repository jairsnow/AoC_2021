<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$oxygenGenerator = $co2Scrubber = array_map(function($value) {
    return str_split($value);
}, $lines);

function get_elements($array, $position, $getFewer = false) {

    if(count($array) === 1) {
        return $array;
    }

    $vars = [
        '0'    => 0,
        '1'    => 0,
        'tmp0' => [],
        'tmp1' => []
    ];

    foreach($array as $line) {
        $vars[$line[$position]]++;
        $vars['tmp' . $line[$position]][] = $line;
    }

    if($getFewer) {
        return $vars['0'] <= $vars['1'] ? $vars['tmp0'] : $vars['tmp1'];
    } else {
        return $vars['1'] >= $vars['0'] ? $vars['tmp1'] : $vars['tmp0'];
    }

}

for($i = 0; $i < count($oxygenGenerator[0]); $i++) {

    $oxygenGenerator = get_elements($oxygenGenerator, $i);
    $co2Scrubber = get_elements($co2Scrubber, $i, true);

    if(count($oxygenGenerator) === 1 and count($co2Scrubber) === 1) {
        break;
    }

}

$O2 = bindec(implode('', $oxygenGenerator[0]));
$CO2 = bindec(implode('', $co2Scrubber[0]));

echo "Oxygen: ${O2}" . PHP_EOL;
echo "CO2 scrubber: ${CO2}" . PHP_EOL;
echo "Final result: " . $O2 * $CO2 . PHP_EOL;
?>