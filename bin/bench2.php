<?php

$start = microtime(true);

$sum = 0;
$len = 1000;

for ($i = 1; $i <= $len; $i++) {
    for ($j = 1; $j <= $len; $j++) {
        for ($k = 1; $k <= $len; $k++) {
            $sum++;
        }
    }
}

$end = microtime(true);

echo 'sum: ' . $sum . PHP_EOL;
echo 'bench: ' . $end - $start . '/s' . PHP_EOL;
