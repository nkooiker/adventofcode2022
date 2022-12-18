<?php

$input = file_get_contents('input2');
$input_array = explode(PHP_EOL, $input);

$total = 0;
foreach($input_array as $value) {
    $score = 0;
    $round = explode(' ', $value);
    if ($round[1] == 'X') {
        $score = 0;
        if ($round[0] == 'A') $score += 3; // you need scissors to lose
        if ($round[0] == 'B') $score += 1; // you need rock to lose
        if ($round[0] == 'C') $score += 2; // you need paper to lose
    } else if ($round[1] == 'Y') {
        $score = 3;
        if ($round[0] == 'A') $score += 1; // you need scissors to draw
        if ($round[0] == 'B') $score += 2; // you need rock to draw
        if ($round[0] == 'C') $score += 3; // you need paper to draw
    } else if ($round[1] == 'Z') {
        $score = 6;
        if ($round[0] == 'A') $score += 2; // you need paper to win
        if ($round[0] == 'B') $score += 3; // you need scissors to win
        if ($round[0] == 'C') $score += 1; // you need rock to win
    }
    $total += $score;
}

echo $total.PHP_EOL;

?>