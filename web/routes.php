<?php
$app->get('/imagesParse', function () use ($app) {
    $o = \Controller\Controller::getInstance('parser', 'AdminController'); //ParserController
    $o->saveImages();
});
