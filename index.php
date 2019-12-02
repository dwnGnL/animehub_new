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

$app->get('/', function ($page = false) use($app){

    $o = \Controller\Controller::getInstance('index'); //IndexController
    $o->execute(['page' => $page]);
})->name('home');

$app->get('/page/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->execute(['alias' => $alias, 'page' => $page]);
})->conditions(['page' => '\d+'])->name('page');

$app->get('/category/:alias(/:page)', function ($alias, $page = false) use($app){

    $o = \Controller\Controller::getInstance('category'); //CategoryController
    $o->execute(['alias' => $alias, 'page' => $page]);
})->name('category');

$app->get('/post/:alias', function ($alias) use($app){

    $o = \Controller\Controller::getInstance('post'); //PostController
    $o->execute(['alias' => $alias]);
})->name('post');

$app->post('/login', function () use ($app){
    $o = \Controller\Controller::getInstance('login'); //LoginController
    $o->execute();
})->name('login');

$app->get('/logout/:route', function ($route) use ($app){
    $o = \Controller\Controller::getInstance('login'); //LoginController
    $o->logout( $route);
})->name('logout');

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