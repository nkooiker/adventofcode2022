<?php

$input = file_get_contents('input5');
$input_array = explode(PHP_EOL, $input);

/*
                [V]     [C]     [M]
[V]     [J]     [N]     [H]     [V]
[R] [F] [N]     [W]     [Z]     [N]
[H] [R] [D]     [Q] [M] [L]     [B]
[B] [C] [H] [V] [R] [C] [G]     [R]
[G] [G] [F] [S] [D] [H] [B] [R] [S]
[D] [N] [S] [D] [H] [G] [J] [J] [G]
[W] [J] [L] [J] [S] [P] [F] [S] [L]
 1   2   3   4   5   6   7   8   9 

move 2 from 2 to 7
*/

$stacks = array();
foreach($input_array as $value) {
    if (str_starts_with($value, "move")) {
        // Move
        $arguments = explode(' ', $value);
        $amount = $arguments[1];
        $from = $arguments[3];
        $to = $arguments[5];
        
        $slice = array_slice($stacks[$from], 0, $amount);
        $stacks[$from] = array_slice($stacks[$from], $amount);
        $stacks[$to] = array_merge($slice, $stacks[$to]);
        // print_r($stacks);exit;

    } else {
        // Parse stacks
        $crates = str_split($value, 4);
        $stack = 0;
        foreach($crates as $crate) {
            $stack++;
            $unpacked = str_split($crate);
            if ($unpacked[0] == '[') $stacks[$stack][] = $unpacked[1];
        }
    }
}
print_r($stacks);

$message = '';
for ($i = 1; $i < 10; $i++) {
    $message .= $stacks[$i][0];
}

echo $message.PHP_EOL;

?>