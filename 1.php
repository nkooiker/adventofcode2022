<?php

$input = file_get_contents('input1');
$input_array = explode(PHP_EOL, $input);

$max = 0;
$subtotal = 0;
foreach($input_array as $value) {
    if ($value == "") {
        if ($subtotal > $max) {
            $max = $subtotal;
        }
        $subtotal = 0;
        continue;
    }
    $subtotal += (int)$value;
}

echo $max.PHP_EOL;


?>