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
        'cookies.secret_key' => 'Desu',
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
$middle = function (){
    $obj = new \Lib\AuthMiddleware(
        \Lib\AclClass::getInstance()
    );
    return $obj->onBeforeDispatch();
};

$app->group('/dashboard', function () use ($app){

    $app->get('/', function () {
        $o = \Controller\Controller::getInstance('admin', 'AdminController'); //AdminController
        $o->index();
    })->name('dashboard');

    $app->get('/slider', function (){
        $o = \Controller\Controller::getInstance('post','\Admin\\'); //AdminController
        $o->viewSlider();
    })->name('slider');
    $app->group('/post', function () use ($app){

        $app->get('/', function (){
            $o = \Controller\Controller::getInstance('post','AdminController'); //AdminController
            $o->index();
        })->name('viewPosts');

        $app->get('/add', function (){
            $o = \Controller\Controller::getInstance('post','\AdminController'); //AdminController
            $o->add();
        })->name('addPost');
    });

});
$app->get('/ws/test', function () use ($app){
    $o = \Controller\Controller::getInstance('page');
    $o->chat();

});
$app->get('/ws/login', function () use ($app){
    $o = \Controller\Controller::getInstance('login');
    $o->getLogin();

});




$app->group('/ajax', function () use ($app){
    $app->group('/chat', function () use ($app){
        $app->post('/connect', function (){
           $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onConnect();
        });

        $app->post('/online', function (){
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onListener();
        });

        $app->post('/message', function (){
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onSave();
        });

        $app->post('/getMessage', function (){
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onMessage();
        });
    });
    $app->post('/add/vote', function (){
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->addVoted();
    })->name('addVote');
    $app->post('/add/comment', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->addComment();
    })->name('addComment');

    $app->post('/save/profile', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->saveProfile();
    })->name('saveProfile');

    $app->post('/save/vip', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->saveVip();
    })->name('saveVip');

    $app->post('/voted/rating', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->rating();
    })->name('rating');

    $app->post('/search/ajax', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->searchAjax();
    })->name('searchAjax');

    $app->post('/favorites/add', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->addFavPost();
    })->name('addFavPost');

    $app->post('/favorites/delete', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->deleteFavPost();
    })->name('deleteFavPost');

    $app->post('/notification/delete', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->deleteNotification();
    })->name('deleteNotification');
    $app->post('/notification/update', function () use ($app) {
        $o = \Controller\Controller::getInstance('ajax'); //AjaxController
        $o->updateNot();
    })->name('updateNotification');

    $app->post('/check/auth', function () use ($app) {
        $o = \Controller\Controller::getInstance('login'); //AjaxController
        $o->checkAuth();
    })->name('checkAuth');

});
$app->post('/question', function (){
    $o = \Controller\Controller::getInstance('Widget'); //WidgetController
    $o->addQuestionnaire();
})->name('addQA');
$app->get('/question', function (){
    $o = \Controller\Controller::getInstance('Widget'); //WidgetController
    $o->viewQuestionnaire();
})->name('viewQuest');

$app->get('/registration', function (){
    $o = \Controller\Controller::getInstance('regist'); //RegistController
    $o->formView();
});

$app->post('/registration', function (){
    $o = \Controller\Controller::getInstance('regist'); //RegistController
    $o->registration();
});
$app->get('/search', function () use ($app) {
    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->search($app->request->get('do'));
})->name('search');
$app->get('/profile(/:user)', function ($user) use ($app){
    $o = \Controller\Controller::getInstance('profile'); //ProfileController
    $o->viewProfile(['login' => $user]);
})->name('viewProfile');

$app->get('/type/:alias(/:page)', function ($alias, $page = false) use($app){
    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'type']);
})->name('type');

$app->get('/year/:alias(/:page)', function ($alias, $page = false) use($app){
    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'year']);

})->name('year')->conditions(['alias' => '\d+']);

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




$app->run();
?>