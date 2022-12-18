<?php

$input = explode(PHP_EOL, file_get_contents('input8'));

$x = 0;
$y = 0;
$forest = array();
$visibletrees = array();
foreach($input as $line) {
    $x = 0;
    $trees = str_split($line);
    foreach($trees as $tree) {
        $forest[$x][$y] = $tree;

        if ($x == 0 || $x == count($trees)-1) $visibletrees[$x][$y] = true;
        

        $x++;
    }
    $y++;
}

$length = count($forest)-1;
for($d = 0; $d < 4; $d++) {
    for($i = 0; $i <= $length; $i++) {
        $highest = -1;
        for($j = 0; $j <= $length; $j++) {
            if ($d == 0) {
                $x = $i;
                $y = $j;
            } else if ($d == 1) { 
                $x = $j;
                $y = $i;
            } else if ($d == 2) {
                $x = $length - $i;
                $y = $length - $j;
            } else if ($d == 3) {
                $x = $length - $j;
                $y = $length - $i;
            }
            
            $tree = $forest[$x][$y];
            echo "trying x:$x, y:$y - highest:$highest, tree:$tree".PHP_EOL;
            if ($highest < $tree) {
                $visibletrees[$x][$y] = true;
                $highest = $tree;
            }

        }
    }
}

$count = 0;

for($x = 0; $x < count($forest); $x++) {
    for($y = 0; $y < count($forest[$x]); $y++) {
        if (isset($visibletrees[$x][$y]) && $visibletrees[$x][$y] === true) $count++;
    }
}

echo $count.PHP_EOL; // Part 1





// Part 2

$bestScore = 0;
for($x = 0; $x < count($forest); $x++) {
    for($y = 0; $y < count($forest[$x]); $y++) {
        $tree = $forest[$x][$y];
        $score = 1;

        for($d = 0; $d < 4; $d++) {
            $sight = 0;
            $refX = $x;
            $refY = $y;
            $refTree = -1;
            while($refTree < $tree) {
                if ($d == 0) {
                    $refX++;
                } else if ($d == 1) { 
                    $refY++;
                } else if ($d == 2) {
                    $refX--;
                } else if ($d == 3) {
                    $refY--;
                }
                
                if ($refX < 0 || $refY < 0 || $refX > $length || $refY > $length) break;
                $refTree = $forest[$refX][$refY];
                if ($refTree >= $tree) $refTree = $tree;
                $sight++;
            }
            
            $score = $score * $sight;
        }
        
        if ($score > $bestScore) {
            $bestScore = $score;
            echo 'found better spot: '.$score.PHP_EOL;
        }

    }
}

?>