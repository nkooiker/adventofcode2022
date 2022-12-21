<?php

$input = explode(PHP_EOL, file_get_contents('input11'));

$monkeys = array();
$monkey;
foreach($input as $line) {

    if(str_starts_with($line, "Monkey")) {
        $part = explode(" ", $line)[1];
        $number = substr($part, 0, strlen($part)-1);
        
        $monkeys[$number] = array();
        $monkey = &$monkeys[$number];
        $monkey["number"] = $number;

    } else if (str_starts_with($line, "  Starting items")) {
        $items = explode(", ", trim(explode(":", $line)[1]));
        $monkey["items"] = $items;
        
    } else if (str_starts_with($line, "  Operation")) {
        $operation = explode(": new = old ", $line)[1];
        list($operator, $value) = explode(" ", $operation);
        $monkey["operation"] = $operation;
        $monkey["operator"] = $operator;
        $monkey["value"] = $value;
        
    } else if (str_starts_with($line, "  Test")) {
        $test = (int)explode(": divisible by", $line)[1];
        $monkey["test"] = $test;

    } else if (str_starts_with($line, "    If true")) {
        $true = (int)explode(": throw to monkey ", $line)[1];
        $monkey["true"] = $true;

    } else if (str_starts_with($line, "    If false")) {
        $false = (int)explode(": throw to monkey ", $line)[1];
        $monkey["false"] = $false;

    }

    $monkey["inspects"] = 0;
}

// print_r($monkeys); exit;

for ($round = 1; $round <= 20; $round++) {

    foreach($monkeys as &$monkey) {
        echo 'Monkey '.$monkey["number"].PHP_EOL;
        
        $items = &$monkey["items"];
        while (count($items) > 0) {
            $item = array_shift($items);
            echo "  Monkey inspects an item with a worry level of $item.".PHP_EOL;
            $monkey["inspects"]++;
            $value = $monkey["value"];
            if ($value == "old") $value = $item;
            if ($monkey["operator"] == "*") {
                $item = (int)($item * $value);
                echo "    Worry level is multiplied by $value to $item.".PHP_EOL;
            } else if ($monkey["operator"] == "+") {
                $item = $item + $value;
                echo "    Worry level increases by $value to $item.".PHP_EOL;
            }

            $item = (int)($item / 3);
            echo "    Monkey gets bored with item. Worry level is divided by 3 to $item.".PHP_EOL;

            $test = (int)$monkey["test"];
            $testSucceeds = ($item % $test == 0);
            $targetMonkey = &$monkeys[$monkey["false"]];
            if ($testSucceeds) {
                echo "    Current worry level is divisible by $test.".PHP_EOL;
                $targetMonkey = &$monkeys[$monkey["true"]];
            } else {
                echo "    Current worry level is not divisible by $test.".PHP_EOL;
            }

            array_push($targetMonkey["items"], $item);
            echo "    Item with worry level $item is thrown to monkey ".$targetMonkey["number"].".".PHP_EOL;

        }
    }

    $inspects = array();
    foreach($monkeys as &$monkey) {
        echo 'Monkey '.$monkey["number"].': '.implode(", ", $monkey["items"]).' ('.$monkey["inspects"].' inspects)'.PHP_EOL;
        $inspects[] = $monkey["inspects"];
    }
    rsort($inspects);
    print_r($inspects);
    echo 'Level of monkey business: '.($inspects[0] * $inspects[1]).PHP_EOL;
}

// print_r($monkeys);


?>