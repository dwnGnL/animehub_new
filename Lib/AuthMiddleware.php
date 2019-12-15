<?php

namespace Lib;

use Slim\Middleware;

defined('_Sdef') or exit();

class AuthMiddleware extends Middleware {

    public function __construct( \Lib\AclClass $acl)
    {


        $this->app = \Slim\Slim::getInstance();
        $this->acl = $acl;
    }

    public function call()
    {

        $this->app->hook('slim.before.dispatch',[$this,'onBeforeDispatch']);

        $this->next->call();
    }

    public function onBeforeDispatch(){
       $resource = $this->app->router->getCurrentRoute()->getPattern();


            if (!isset($_SESSION['auth'])){
                $this->app->notFound();
            }
            $this->acl->setAllow('Анимешник','/admin(/:page)', ['GET','POST']);
            $this->acl->setAllow('_VIP_','/admin(/:page)', ['GET','POST']);
            if (!$this->acl->check($resource, $_SESSION['status'],$this->app->request->getMethod()))   {
                $this->app->notFound();
            }

       return true;
    }
}