<?php
  define('_Sdef', true);

  session_start();

  require_once 'vendor/autoload.php';

  require 'config.php';


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
        'templates.path' => __DIR__.'/templates',
        'debug' => true,
        'cookies.encrypt' => false,
        'cookies.secret_key' => 'my_secret_key',
]);
function my_autoload($className){
    $baseDir = __DIR__;

    $fileName = $baseDir.DIRECTORY_SEPARATOR;
    $namespace = '';
    if($lastNsPos = strripos($className, '\\')){
        $namespace = substr($className, 0,$lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName .= str_replace('\\',DIRECTORY_SEPARATOR,$namespace).DIRECTORY_SEPARATOR;
    }
    $fileName .= ucfirst($className).'.php';

    if (file_exists($fileName)){

        require $fileName;
    }

}

spl_autoload_register('my_autoload');

$app->add(new \Lib\CheckAuthMiddleware( \Lib\AuthClass::getInstance(new \Model\Driver()))
);

$app->group('/ajax', function () use ($app){

    $app->post('/add/comment', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->addComment();
    })->name('addComment');

});

$app->get('/type/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'type']);
})->name('type');

$app->get('/year/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'year']);
})->name('year');

$app->get('/category/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'category']);
})->name('category');

$app->get('/', function () use($app){

    $o = \Controller\Controller::getInstance('index'); //IndexController
    $o->execute();
})->name('home');

$app->get('/login/logout', function () use ($app){
    $o = \Controller\Controller::getInstance('login'); //LoginController
    $o->logout();
})->name('logout');

$app->get('/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->allPost(['alias' => $alias, 'page' => $page]);
})->conditions(['page' => '\d+'])->name('page');

$app->get('/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->post(['alias' => $alias, 'page' => $page]);
})->name('post');





$app->post('/login', function () use ($app){
    $o = \Controller\Controller::getInstance('login'); //LoginController
    $o->execute();
})->name('login');



$app->post('/ajax/comment', function () use ($app){
   $o = \Controller\Controller::getInstance('Ajax'); //AjaxController
    $o->request();
});
$middle = function (){
    $obj = new \Lib\AuthMiddleware(
    \Lib\AclClass::getInstance()
                                );
   return $obj->onBeforeDispatch();
};

$app->group('/admin', $middle,function () use ($app){

        $app->get('(/:page)', function ($page = 1) {
                $o = \Controller\Controller::getInstance('admin'); //AdminController
                $o->execute();
        })->conditions(['page' => '\d+'])->name('aItems');

});

$app->run();
?>