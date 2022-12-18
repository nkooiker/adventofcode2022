<?php

$input = file_get_contents('input3');
$input_array = explode(PHP_EOL, $input);

$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$letters = str_split($alphabet);
$priorities = array();
$priority = 0;
foreach($letters as $letter) {
    $priority++;
    $priorities[$letter] = $priority;
}

$total = 0;
for ($i = 0; $i < (count($input_array) / 3); $i++) {
    $j = $i * 3;
    $first = str_split($input_array[$j]);
    $second = str_split($input_array[$j+1]);
    $third = str_split($input_array[$j+2]);
    foreach($first as $item) {
        if (in_array($item, $second) && in_array($item, $third)) {
            echo 'The shared item is '.$item.PHP_EOL;
            $total += $priorities[$item];
            break;
        }
    }
}

echo $total.PHP_EOL;

?>