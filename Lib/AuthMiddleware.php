<?php

namespace Lib;

use Slim\Middleware;

defined('_Sdef') or exit();

class AuthMiddleware extends Middleware {

    protected $config;
    public function __construct($setting = [], \Lib\AuthClass $auth,\Lib\AclClass $acl)
    {
        $defaults = [
            'routeName' => '/admin'
        ];

        $this->config = array_merge($defaults,$setting);

        $this->app = \Slim\Slim::getInstance();
        $this->auth = $auth;
        $this->acl = $acl;
    }

    public function call()
    {

        $this->app->hook('slim.before.dispatch',[$this,'onBeforeDispatch']);

        $this->next->call();
    }

    public function onBeforeDispatch(){
       $resource = $this->app->router->getCurrentRoute()->getPattern();

//       if ($resource == $this->config['routeName']){
            if (!$user = $this->auth->isUserLogin()){

                if ($_SESSION['status'] != "Админ"){

                    exit('Страница не найдена ошибка: 404');
                }

            }
            $this->acl->setAllow('Админ','/admin(/:page)', ['GET','POST']);

            if (!$this->acl->check($resource, $_SESSION['status'],$this->app->request->getMethod()))   {
                exit('Страница не найдено ошибка: 404');
            }
//       }
       return true;
    }
}