<?php

$lines = explode(PHP_EOL, file_get_contents(__DIR__ . '/data'));
$numbers = explode(',', array_shift($lines));

enum ComboType {
    case Row;
    case Column;
}

class Combo {

    public ComboType $type;
    public array $values;

    public function __construct($elements, ComboType $type) {
        if(is_string($elements)) {
            $elements = explode(' ', $elements);
            $elements = array_values(array_diff($elements, ['']));
        }
        $this->values = $elements;
        $this->type = $type;
    }

    public function draw_number($number): int {
        if(in_array($number, $this->values)) {
            $index = array_search($number, $this->values);
            array_splice($this->values, $index, 1);
        }
        return count($this->values);
    }

    public function getPos($pos) {
        return $this->values[$pos];
    }
}

class Board {

    /* @var $combo Combo[] */
    private array $combo = [];
    private bool $hasWon = false;

    public function __construct($l1, $l2, $l3, $l4, $l5) {
        $this->combo[] = new Combo($l1, ComboType::Row);
        $this->combo[] = new Combo($l2, ComboType::Row);
        $this->combo[] = new Combo($l3, ComboType::Row);
        $this->combo[] = new Combo($l4, ComboType::Row);
        $this->combo[] = new Combo($l5, ComboType::Row);
        $this->calcCols();
    }

    private function calcCols(): void {
        for($i = 0; $i < 5; $i++) {
            $this->combo[] = new Combo([
                $this->combo[0]->getPos($i),
                $this->combo[1]->getPos($i),
                $this->combo[2]->getPos($i),
                $this->combo[3]->getPos($i),
                $this->combo[4]->getPos($i)
            ], ComboType::Column);
        }
    }

    public function draw_number($number): int {
        foreach($this->combo as $i => $combo) {
            if($combo->draw_number($number) === 0 && $this->hasWon === false) {
                // This means that this combo has won!
                $this->hasWon = true;
                return $this->winning_result($number, $combo->type);
            }
        }
        return 0;
    }

    private function winning_result($finalNumber, ComboType $winType): int {

        $unmarkedNumbers = 0;
        foreach($this->combo as $combo) {
            if($combo->type !== $winType) {
                continue;
            }
            $unmarkedNumbers += array_sum($combo->values);
        }
        return $unmarkedNumbers * $finalNumber;
    }

}

/* @var $boards Board[] */
$boards = [];
for($i = 5; $i < count($lines); $i += 6) {
    $boards[] = new Board($lines[$i - 4], $lines[$i - 3], $lines[$i - 2], $lines[$i - 1], $lines[$i]);
}

$last = [];
foreach($numbers as $number) {
    foreach($boards as $board) {
        $result = $board->draw_number($number);
        if($result > 0) {
            // This means the board has win
            $last = $result;
        }
    }
}

echo "Result: ${last} " . PHP_EOL;

?>