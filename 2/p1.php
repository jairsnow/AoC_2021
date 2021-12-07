<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$forward = 0;
$depth = 0;

foreach($lines as $line) {

    list($command, $amount) = explode(' ', $line);

    switch($command) {
        case 'forward':
            $forward += $amount;
            break;
        case 'up':
            $depth -= $amount;
            break;
        case 'down':
            $depth += $amount;
            break;
        default:
            echo "Unknown command: ${command}";
            exit();
    }

}

echo "Final result: ${forward} x ${depth} = " . $forward * $depth . PHP_EOL;
?>