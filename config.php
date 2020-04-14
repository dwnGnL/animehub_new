<?php

define('PREF', 'lite_');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'animehub');

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