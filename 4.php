<?php

$input = file_get_contents('input4');
$input_array = explode(PHP_EOL, $input);

$total = 0;
foreach($input_array as $value) {
    $pairs = explode(',', $value);
    $first_range = explode('-', $pairs[0]);
    $second_range = explode('-', $pairs[1]);
    
    if ( ($first_range[0] <= $second_range[0] && $first_range[1] >= $second_range[1]) || 
         ($second_range[0] <= $first_range[0] && $second_range[1] >= $first_range[1]) ){
        print_r($pairs);
        $total++;
    }

}

echo $total.PHP_EOL;

?>