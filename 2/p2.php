<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$forward = 0;
$depth = 0;
$aim = 0;

foreach($lines as $line) {

    list($command, $amount) = explode(' ', $line);

    switch($command) {
        case 'forward':
            $forward += $amount;
            $depth += $aim * $amount;
            break;
        case 'up':
            $aim -= $amount;
            break;
        case 'down':
            $aim += $amount;
            break;
        default:
            echo "Unknown command: ${command}";
            exit();
    }

}

echo "Final result: ${forward} x ${depth} = " . $forward * $depth . PHP_EOL;
?>