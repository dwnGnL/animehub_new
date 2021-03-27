<?php
$app->get('/imagesParse', function () use ($app) {
    $o = \Controller\Controller::getInstance('parser', 'AdminController'); //ParserController
    $o->saveImages();
});

$app->get('/anime_post_id', function () use ($app) {
    $o = \Controller\Controller::getInstance('anime', 'AdminController'); //ParserController
    $o->index();
});
