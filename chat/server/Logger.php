<?php

namespace Server;

use Server\LoggerInterface;

/*
* Логирование в файл.
*
*/

class Logger implements LoggerInterface
{
    private $config;

    public function __construct($config)
    {
        $path = __DIR__ . '../../' . $config['folder'];

        if (!file_exists($path)) {
            mkdir($path, 0777);  // создаем папку, если еще не создана
        }

        $fOpen = fopen($path . '/' . $config['fileName'], 'a'); // создаем файл

        $logPath = $path . '/' . $config['fileName'];

        $this->logPath = $logPath;
    }

    public function save($time, $events, $value)
    {
        file_put_contents($this->logPath, "[$time]^[$events] - $value" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}