<?php
$blackList = [
    '176.113.132.212',
    '176.113.128.26',
    '176.113.131.191',
    '193.176.84.182',
    '91.231.254.204',
    '91.218.163.74',
  	'84.244.20.100',
  	'78.96.77.21',
  	'89.137.66.113',
  	'95.77.142.16',
  	'89.137.66.245',
  	'89.38.73.9',
  	'185.147.213.175',

  
   
];

$whiteList = [
    '95.142.88.193',
    '185.177.0.237',

];

$exceptionIp = [
    '95.142.88.193',
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