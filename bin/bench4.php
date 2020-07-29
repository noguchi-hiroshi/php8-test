<?php

$start = microtime(true);

$values = range(1, 100000);

for ($i = 0; $i < 100000; $i++) {
    if ($i % 5 === 0){
        in_array($i, $values, true);
    }
}

$end = microtime(true);

echo 'bench: ' . $end - $start . '/s' . PHP_EOL;
