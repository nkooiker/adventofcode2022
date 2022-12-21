<?php

$input = explode(PHP_EOL, file_get_contents('input10'));

$cycle = 0;
$x = 1;
$sumSignalStrengths = 0;
$crt = array();
$crtLine = 0;

foreach($input as $line) {
    $value = 0;
    
    $cycle++;
    checkSignal();
    processPixel();
    
    if (str_starts_with($line, "addx")) {
        $value = explode(" ", $line)[1];
    
        $cycle++;
        checkSignal();
        processPixel();
    }

    $x += $value;
}

echo 'Sum: '. $sumSignalStrengths.PHP_EOL;

function checkSignal() {
    global $cycle, $x, $sumSignalStrengths;
    // echo $cycle.' '.$x.PHP_EOL;

    // echo $cycle.' % '.(($cycle - 20) % 40).PHP_EOL;
    if (($cycle - 20) % 40 == 0) {
        //echo $cycle.' '.$x.PHP_EOL;

        $sumSignalStrengths += ($cycle * $x);
    }
}

function processPixel() {
    global $cycle, $x, $crt, $crtLine;
    $pixel = ".";

    if (!isset($crt[$crtLine])) {
        $crt[$crtLine] = "";
    }

    $pointer = ($cycle % 40)-1;
    if ($pointer >= ($x-1) && $pointer <= ($x+1)) {
        $pixel = "#";
    }

    echo $cycle.' '.$x.' '.$pixel.' '.($x % 40).PHP_EOL;

    $crt[$crtLine] .= $pixel;

    if ($cycle % 40 == 0) {
        echo '--- New CRT line ---'.PHP_EOL;
        $crtLine++;
    }

    // if ($cycle == 40) {
    //     echo $crt.PHP_EOL;exit;
    // }
}

print_r($crt);

?>