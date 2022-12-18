<?php

$input = file_get_contents('input4');
$input_array = explode(PHP_EOL, $input);

$total = 0;
foreach($input_array as $value) {
    $pairs = explode(',', $value);
    $first_range = explode('-', $pairs[0]);
    $second_range = explode('-', $pairs[1]);
    
    $first = range($first_range[0], $first_range[1]);
    $second = range($second_range[0], $second_range[1]);

    foreach($first as $section) {
        if (in_array($section, $second)) {
            print_r($pairs);
            $total++;
            break;
        }
    }

}

echo $total.PHP_EOL;

?>