<?php
define('_Sdef', true);
session_start();

require_once 'vendor/autoload.php';

require 'config.php';
require 'data.php';
require 'Lib/functions.php';
$access = '';
if (SITE){
    foreach ($blackList as $value){
        if ($_SERVER['REMOTE_ADDR'] == $value){
            exit('Ты заблокирован за вредоносные действия на сайте');
        }
    }
}else{
	$access = 0;
    foreach ($whiteList as $value){
        if ($_SERVER['REMOTE_ADDR'] == $value){
        	$access = 1;
        	break;
        }
    }
}

if($access != 1 && !SITE){
	exit('Идет тех обслуживание');
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim([
        'debug' => DEBUG,
        'cookies.encrypt' => true,
        'cookies.secret_key' => 'Desu',
]);


function my_autoload($className)
{
    $baseDir = __DIR__;
    $fileName = $baseDir . DIRECTORY_SEPARATOR;
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= ucfirst($className) . '.php';

    if (file_exists($fileName)) {

        require $fileName;
    }

}

spl_autoload_register('my_autoload');

$app->add(new \Lib\CheckAuthMiddleware(\Lib\AuthClass::getInstance(new \Model\Driver(), $app), $exception)
);
$app->add(new \Lib\CheckToken($exception));
$middle = function () {
    $obj = new \Lib\AuthMiddleware(
        \Lib\AclClass::getInstance()
    );
    return $obj->onBeforeDispatch();
};

$app->get('/parser', function () use ($app) {
    $o = \Controller\Controller::getInstance('parser'); //ParserController
    $o->changeSrc();
});
$app->get('/parserTop', function () use ($app) {
    $o = \Controller\Controller::getInstance('parser'); //ParserController
    $o->changeSrcTopVideo();
});
$app->group('/shop', function () use ($app) {
    $app->get('(/:page)', function ($page = false) {
        $o = \Controller\Controller::getInstance('shop'); //ShopController
        $o->index($page);
    });
    $app->get('/product/:product', function ($product) {
        $o = \Controller\Controller::getInstance('shop'); //ParserController
        $o->store($product);
    });
});
$app->group('/dashboard', $middle, function () use ($app) {

    $app->get('/', function () {
        $o = \Controller\Controller::getInstance('parser', 'AdminController'); //ParserController
        $o->index();
    })->name('dashboard');
    $app->get('/global', function () {
        $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
        $o->globalCorrect();
    })->name('globalCorrect');
    $app->group('/shop', function () use ($app) {
//        $app->get('/global', function () {
//            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
//            $o->globalCorrect();
//        })->name('globalCorrect');

        $app->get('/viewAdd', function () {
            $o = \Controller\Controller::getInstance('shop', 'AdminController'); //ParserController
            $o->viewAdd();
        })->name('viewAdd');

        $app->get('/products', function () {
            $o = \Controller\Controller::getInstance('product', 'AdminController'); //ParserController
            $o->view();
        })->name('products');

        $app->get('/product(/:id)', function ($id) {
            $o = \Controller\Controller::getInstance('product', 'AdminController'); //ParserController
            $o->edit($id);
        })->name('editProduct');

        $app->post('/product(/:id)', function ($id) {
            $o = \Controller\Controller::getInstance('product', 'AdminController'); //ParserController
            $o->update($id);
        })->name('products')->name('updateProduct');

        $app->post('/product/delete(/:id)', function ($id) {
            $o = \Controller\Controller::getInstance('product', 'AdminController'); //ParserController
            $o->delete($id);
        })->name('deleteProduct');

        $app->post('/viewAttr', function () {
            $o = \Controller\Controller::getInstance('shop', 'AdminController'); //ParserController
            $o->viewAttr();
        });

        $app->post('/add', function () {
            $o = \Controller\Controller::getInstance('shop', 'AdminController'); //ParserController
            $o->add();
        })->name('addProduct');
    });
    $app->group('/slider', function () use ($app) {
        $app->get('/', function () {
            $o = \Controller\Controller::getInstance('slider', 'AdminController'); //SliderController
            $o->index();
        })->name('slider');

        $app->post('/edit', function () {
            $o = \Controller\Controller::getInstance('slider', 'AdminController'); //SliderController
            $o->edit();
        })->name('editSlider');

        $app->post('/add', function () {
            $o = \Controller\Controller::getInstance('slider', 'AdminController'); //SliderController
            $o->add();
        })->name('addSlider');

        $app->post('/delete', function () {
            $o = \Controller\Controller::getInstance('slider', 'AdminController'); //SliderController
            $o->delete();
        })->name('deleteSlider');
    });

    $app->group('/post', function () use ($app) {

        $app->get('(/:page)', function ($page = false) {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->index($page);
        })->name('viewPosts')->conditions(['page' => '\d+']);

        $app->get('/add', function () {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->add();
        })->name('addPost');

        $app->post('/addPost', function () {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->addPost();
        })->name('addPostF');

        $app->post('/update', function () {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->update();
        })->name('updatePost');

        $app->post('/delete', function () {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->delete();
        })->name('deletePost');

        $app->get('/edit/:alias(/:post)', function ($alias, $post) {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->edit(['alias' => $alias, 'post' => $post]);
        })->name('editPost')->conditions(['post' => '\d+']);
        $app->post('/seria/edit', function () {
            $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
            $o->editSeria();
        })->name('editSeria');
    });

    $app->group('/parse', function () use ($app) {
        $app->post('/sort', function () {
            $o = \Controller\Controller::getInstance('sort', 'AdminController'); //SortController
            $o->sortView();
        });

        $app->post('/delete', function () {
            $o = \Controller\Controller::getInstance('sort', 'AdminController'); //SortController
            $o->sortDelete();
        });

        $app->post('/save', function () {
            $o = \Controller\Controller::getInstance('sort', 'AdminController'); //ParserController
            $o->saveSort();
        });

        $app->post('/start', function () {
            $o = \Controller\Controller::getInstance('parser', 'AdminController'); //ParserController
            $o->start();
        });

        $app->post('/channel', function () {
            $o = \Controller\Controller::getInstance('parser', 'AdminController'); //ParserController
            $o->startChannel();
        });

    });

});

$app->get('/ws/test', function () use ($app) {
    $o = \Controller\Controller::getInstance('page');
    $o->chat();

});
$app->get('/ws/login', function () use ($app) {
    $o = \Controller\Controller::getInstance('login');
    $o->getLogin();

});


$app->group('/ajax', function () use ($app) {
    $app->group('/chat', function () use ($app) {
        $app->post('/connect', function () {
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onConnect();
        });

        $app->post('/online', function () {
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onListener();
        });

        $app->post('/message', function () {
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onSave();
        });

        $app->post('/getMessage', function () {
            $o = \Controller\Controller::getInstance('chat'); //ChatController
            $o->onMessage();
        });
    });
    $app->post('/search/posts', function () {
        $o = \Controller\Controller::getInstance('post', 'AdminController'); //PostController
        $o->searchAjax();
    });
    $app->post('/add/vote', function () {
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
$app->post('/question', function () {
    $o = \Controller\Controller::getInstance('Widget'); //WidgetController
    $o->addQuestionnaire();
})->name('addQA');
$app->get('/question', function () {
    $o = \Controller\Controller::getInstance('Widget'); //WidgetController
    $o->viewQuestionnaire();
})->name('viewQuest');

$app->get('/registration', function () {
    $o = \Controller\Controller::getInstance('regist'); //RegistController
    $o->formView();
})->name('registration.index');

$app->post('/registration', function () {
    $o = \Controller\Controller::getInstance('regist'); //RegistController
    $o->registration();
})->name('regist');
$app->get('/search', function () use ($app) {
    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->search($app->request->get('do'));
})->name('search');
$app->get('/profile(/:user)', function ($user) use ($app) {
    $o = \Controller\Controller::getInstance('profile'); //ProfileController
    $o->viewProfile(['login' => $user]);
})->name('viewProfile');

$app->get('/type/:alias(/:page)', function ($alias, $page = false) use ($app) {
    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'type']);
})->name('type');

$app->get('/year/:alias(/:page)', function ($alias, $page = false) use ($app) {
    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'year']);

})->name('year')->conditions(['alias' => '\d+']);

$app->get('/category/:alias(/:page)', function ($alias, $page = false) use ($app) {

    $o = \Controller\Controller::getInstance('page'); //CategoryController
    $o->allPost(['alias' => $alias, 'page' => $page, 'url' => 'category']);
})->name('category');


$app->get('/', function () use ($app) {

    $o = \Controller\Controller::getInstance('index'); //IndexController
    $o->execute();
})->name('home');

$app->get('/login/logout', function () use ($app) {
    $o = \Controller\Controller::getInstance('login'); //LoginController
    $o->logout();
})->name('logout');

$app->get('/:alias(/:page)', function ($alias, $page = false) use ($app) {
    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->allPost(['alias' => $alias, 'page' => $page]);

})->conditions(['page' => '\d+'])->name('page');

$app->get('/:alias(/:page)', function ($alias, $page = false) use ($app) {

    $o = \Controller\Controller::getInstance('page'); //PageController
    $o->post(['alias' => $alias, 'page' => $page]);
})->name('post');


$app->post('/login', function () use ($app) {
    $o = \Controller\Controller::getInstance('login'); //LoginController
    $o->execute();
})->name('login');


$app->post('/ajax/comment', function () use ($app) {
    $o = \Controller\Controller::getInstance('Ajax'); //AjaxController
    $o->request();
});


$app->run();
?>
