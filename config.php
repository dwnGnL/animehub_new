<?php

define('PREF', 'lite_');

define('DB_HOST', 'localhost');
define('DB_USER', 'nonofon_anime');
define('DB_PASSWORD', 'animehub000');
define('DB_NAME', 'nonofon_anime');

define('QUANTITY', 28);
define('QUANTITY_LINKS', 3);

define('DATE', 2);
// тут пути в которых не надо проверять авторизован ли чел или нет и проверять токен
$exception = [
    '/login',
    '/registration',
    '/ajax/chat/getMessage',
    '/ajax/check/auth',
    '/ajax/chat/connect',
    '/ajax/search/ajax',
]
?>