<?php

$input = file_get_contents('input6');
$input_array = str_split($input);

$sequenceLength = 4; // 6a: 4, 6b: 14

$position = 0;
$buffer = array();
foreach($input_array as $value) {
    $position++;
    if (count($buffer) == $sequenceLength) array_shift($buffer);
    array_push($buffer, $value);
    if (count(array_unique($buffer)) == $sequenceLength) break;
}

print_r($buffer);
echo $position.PHP_EOL;

?>