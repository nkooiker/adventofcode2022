<?php

$input = file_get_contents('input1');
$input_array = explode(PHP_EOL, $input);

$totals = array();
$subtotal = 0;
foreach($input_array as $value) {
    if ($value == "") {
        $totals[] = $subtotal;
        $subtotal = 0;
        continue;
    }
    $subtotal += (int)$value;
}

rsort($totals);

print_r($totals);

$total = $totals[0] + $totals[1] + $totals[2];

echo $total.PHP_EOL;


?>