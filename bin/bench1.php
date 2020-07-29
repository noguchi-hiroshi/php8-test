<?php

$start = microtime(true);

$oddsMap = [];
$oddsText = explode("\n", file_get_contents(__DIR__ . '/../resources/odds.txt'));
foreach ($oddsText as $t) {
    [$number, $odds] = explode("=", $t);
    $oddsMap[$number] = $odds;
}

$answers = explode("\n", file_get_contents(__DIR__ . '/../resources/answers.txt'));

$sum = 0;
foreach ($answers as $ans) {
    if (isset($oddsMap[$ans])) {
        $sum += $oddsMap[$ans];
    }
}

$end = microtime(true);

echo 'sum: ' . $sum . PHP_EOL;
echo 'bench: ' . $end - $start . '/s' . PHP_EOL;
