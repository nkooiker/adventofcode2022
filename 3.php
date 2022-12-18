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
foreach($input_array as $value) {
    $items = str_split($value);
    $compartments = array_chunk($items, count($items) / 2);

    foreach($compartments[0] as $item) {
        if (in_array($item, $compartments[1])) {
            echo 'The shared item is '.$item.PHP_EOL;
            $total += $priorities[$item];
            break;
        }
    }
}

echo $total.PHP_EOL;

?>