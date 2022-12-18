<?php

$input = file_get_contents('input2');
$input_array = explode(PHP_EOL, $input);

$total = 0;
foreach($input_array as $value) {
    $score = 0;
    $round = explode(' ', $value);
    if (($round[0] == 'A' && $round[1] == 'Y') ||
        ($round[0] == 'B' && $round[1] == 'Z') ||
        ($round[0] == 'C' && $round[1] == 'X') ) {
            // win
            $score = 6;
    } else if(  ($round[0] == 'A' && $round[1] == 'X') ||
                ($round[0] == 'B' && $round[1] == 'Y') ||
                ($round[0] == 'C' && $round[1] == 'Z') ) {
                    // draw
                    $score = 3;
    } else {
        $score = 0;
    }

    if ($round[1] == 'X') $score += 1;
    if ($round[1] == 'Y') $score += 2;
    if ($round[1] == 'Z') $score += 3;

    $total += $score;
}

echo $total.PHP_EOL;

?>