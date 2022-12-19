<?php

$input = explode(PHP_EOL, file_get_contents('input9'));

$headX = 0; $headY = 0;
$visited = array();
$rope = array(
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0),
    array("x" => 0, "y" => 0)
);

foreach($input as $line) {
    list($direction, $amount) = explode(' ', $line);
    echo "-- Going $direction for $amount".PHP_EOL;

    
    do {
        if ($direction == 'U') $headY--;
        if ($direction == 'R') $headX++;
        if ($direction == 'D') $headY++;
        if ($direction == 'L') $headX--;

        for($i = 0; $i < 9; $i++) {

            $prevX = $headX;
            $prevY = $headY;
            if ($i > 0) {
                $prevX = $rope[$i-1]['x'];
                $prevY = $rope[$i-1]['y'];
            }
            $tailX = $rope[$i]['x'];
            $tailY = $rope[$i]['y'];

            if (abs($tailX - $prevX) > 1 || abs($tailY - $prevY) > 1) {
            
                if ($tailX == $prevX || $tailY == $prevY) {
                    // straight
                    if ($tailX < $prevX) $tailX++;
                    if ($tailY < $prevY) $tailY++;
                    if ($tailX > $prevX) $tailX--;
                    if ($tailY > $prevY) $tailY--;
                } else {
                    // diagonal
                    if ($tailX < $prevX && $tailY < $prevY) { $tailX++; $tailY++; }
                    if ($tailX < $prevX && $tailY > $prevY) { $tailX++; $tailY--; }
                    if ($tailX > $prevX && $tailY < $prevY) { $tailX--; $tailY++; }
                    if ($tailX > $prevX && $tailY > $prevY) { $tailX--; $tailY--; }
                }
    
            } 

            $rope[$i]['x'] = $tailX;
            $rope[$i]['y'] = $tailY;

            if ($i == 8) {
                $visited[$tailX.','.$tailY] = true;
            }
        }

        $amount--;
    } while ($amount > 0);

    
    
}

print_r($visited);
echo (count($visited)).PHP_EOL;

?>