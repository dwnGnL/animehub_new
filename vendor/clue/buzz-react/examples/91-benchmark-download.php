<?php

// a) simple download benchmark against public HTTP endpoint:
// $ php examples/91-benchmark-download.php http://httpbin.org/get

// b) local 10 GB download benchmark against localhost address to avoid network overhead
//
// b1) first run example HTTP server, e.g. from react/http:
// $ cd workspace/reactphp-http
// $ php examples/99-benchmark-download.php 8080
//
// b2) run HTTP client receiving a 10 GB download:
// $ php examples/92-benchmark-download.php http://localhost:8080/ 10000

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use React\Stream\ReadableStreamInterface;

$url = isset($argv[1]) ? $argv[1] : 'http://google.com/';

require __DIR__ . '/../vendor/autoload.php';

if (extension_loaded('xdebug')) {
    echo 'NOTICE: The "xdebug" extension is loaded, this has a major impact on performance.' . PHP_EOL;
}

$loop = React\EventLoop\Factory::create();
$client = new Browser($loop);

echo 'Requesting ' . $url . '…' . PHP_EOL;

$client->withOptions(array('streaming' => true))->get($url)->then(function (ResponseInterface $response) use ($loop) {
    echo 'Headers received' . PHP_EOL;
    echo RingCentral\Psr7\str($response);

    $stream = $response->getBody();
    if (!$stream instanceof ReadableStreamInterface) {
        throw new UnexpectedValueException();
    }

    // count number of bytes received
    $bytes = 0;
    $stream->on('data', function ($chunk) use (&$bytes) {
        $bytes += strlen($chunk);
    });

    // report progress every 0.1s
    $timer = $loop->addPeriodicTimer(0.1, function () use (&$bytes) {
        echo "\rDownloaded " . $bytes . " bytes…";
    });

    // report results once the stream closes
    $time = microtime(true);
    $stream->on('close', function() use (&$bytes, $timer, $loop, $time) {
        $loop->cancelTimer($timer);

        $time = microtime(true) - $time;

        echo "\r" . 'Downloaded ' . $bytes . ' bytes in ' . round($time, 3) . 's => ' . round($bytes / $time / 1000000, 1) . ' MB/s' . PHP_EOL;
    });
}, 'printf');

$loop->run();
