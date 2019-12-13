<?php
require_once 'phpQuery.php';
include 'curl.php';
require_once 'Model.php';
$model = new Model();
set_time_limit(0);

$post = $model->getTitleNonAlias();

foreach ($post as $item){

    $title = $item['title'];
    $title = str_replace(' ', '+',$title);
    $model->updateAlias(AutoWrite($title), $item['id']);
}

function AutoWrite ($title) {
  $html = curl_get('https://animebest.org/index.php?story='.$title.'&do=search&subaction=search');
  $php = phpquery::newDocument($html);
  $title = $php->find('.shortstory-poster a')->attr('title');
  $title = explode('/', $title);
  return $title['1'];
}

?>


