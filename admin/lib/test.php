<?php
require_once 'phpQuery.php';
include 'curl.php';
require_once 'Model.php';
$model = new Model();
set_time_limit(0);

print_r(curl_get('http://topvideo.tj/')) ;


?>


