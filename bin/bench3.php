<?php

$start = microtime(true);

function r(int $n):void {
    if ($n > 0) {
        r($n - 1);
    }
}

r(500000);


$end = microtime(true);

echo 'bench: ' . $end - $start . '/s' . PHP_EOL;
