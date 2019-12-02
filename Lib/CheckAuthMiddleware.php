<?php


namespace Lib;


use Slim\Middleware;

class CheckAuthMiddleware extends Middleware
{

   public function __construct( \Lib\AuthClass $auth)
   {
       $this->auth = $auth;
   }

    public function call()
    {
        if ($user = $this->auth->isUserLogin()){
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['status'] = $user['status'];
        }

        $this->next->call();
        // TODO: Implement call() method.
    }
}