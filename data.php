<?php
$blackList = [
    '176.113.132.212',
    '176.113.128.26',
    '176.113.131.191',
    '193.176.84.182',
];

$whiteList = [
    '95.142.88.193',
    '185.177.0.237'
];

// тут пути в которых не надо проверять авторизован ли чел или нет и проверять токен
$exception = [
    '/login',
    '/registration',
    '/ajax/chat/getMessage',
    '/ajax/check/auth',
    '/ajax/chat/connect',
    '/ajax/search/ajax',
];
?>