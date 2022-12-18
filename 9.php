<?php

$input = explode(PHP_EOL, file_get_contents('input9'));

$headX = 0; $headY = 0;
$tailX = 0; $tailY = 0;
$visited = array();
foreach($input as $line) {
    list($direction, $amount) = explode(' ', $line);
    echo "-- Going $direction for $amount".PHP_EOL;
    do {
        if ($direction == 'U') $headY--;
        if ($direction == 'R') $headX++;
        if ($direction == 'D') $headY++;
        if ($direction == 'L') $headX--;

        if (abs($tailX - $headX) > 1 || abs($tailY - $headY) > 1) {
            
            if ($tailX == $headX || $tailY == $headY) {
                // straight
                if ($tailX < $headX) $tailX++;
                if ($tailY < $headY) $tailY++;
                if ($tailX > $headX) $tailX--;
                if ($tailY > $headY) $tailY--;
            } else {
                // diagonal
                if ($tailX < $headX && $tailY < $headY) { $tailX++; $tailY++; }
                if ($tailX < $headX && $tailY > $headY) { $tailX++; $tailY--; }
                if ($tailX > $headX && $tailY < $headY) { $tailX--; $tailY++; }
                if ($tailX > $headX && $tailY > $headY) { $tailX--; $tailY--; }
            }
            $visited[$tailX.','.$tailY] = true;

        } 

        echo "$headX, $headY - $tailX, $tailY".PHP_EOL;

        $amount--;
    } while ($amount > 0);
}

// print_r($visited);
echo (count($visited)+1).PHP_EOL;

?>