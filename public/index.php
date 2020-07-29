<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;


require __DIR__ . '/../vendor/autoload.php';

////////////////////////////////////
// Setup
////////////////////////////////////

$app = AppFactory::create();

////////////////////////////////////
// Application
////////////////////////////////////

// トップページ
$app->get('/bench1', function (Request $request, Response $response) {
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
    $response->getBody()->write(json_encode([
        'result' => $sum,
        'time'   => $end - $start
    ]));
    return $response;
});

$app->get('/bench2', function (Request $request, Response $response) {
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
    $response->getBody()->write(json_encode([
        'result' => $sum,
        'time'   => $end - $start
    ]));

    return $response;
});

$app->get('/bench3', function (Request $request, Response $response) {
    $start = microtime(true);

    function r(int $n):void {
        if ($n > 0) {
            r($n - 1);
        }
    }

    r(500000);

    $end = microtime(true);

    $response->getBody()->write(json_encode([
        'time' => $end - $start
    ]));

    return $response;
});


$app->get('/bench4', function (Request $request, Response $response) {
    $start = microtime(true);

    $values = range(1, 100000);

    for ($i = 0; $i < 100000; $i++) {
        if ($i % 5 === 0){
            in_array($i, $values, true);
        }
    }

    $end = microtime(true);

    $response->getBody()->write(json_encode([
        'time' => $end - $start
    ]));

    return $response;
});

$app->get('/bench5', function (Request $request, Response $response) {
    $start = microtime(true);

    $t = '';

    for ($i = 0; $i < 10000000; $i++) {
        $t .= 'a';
    }

    $end = microtime(true);

    $response->getBody()->write(json_encode([
        'result' => $t,
        'time' => $end - $start
    ]));

    return $response;
});

$app->run();
