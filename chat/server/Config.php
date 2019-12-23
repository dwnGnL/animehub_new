<?php

return $config = [
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'dbname' => 'animehub',
        'charset' => 'utf8'
    ],
    'log' => [
        'folder' => 'log',
        'fileName' => 'LogFile.txt'
    ],
    'webSocket' => [
        'host' => '127.0.0.1',
        'port' => '8000',
        'countWorkers' => '4',
        'intervalPing' => 30
    ]
];