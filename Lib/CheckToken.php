<?php


namespace Lib;


use Slim\Middleware;

class CheckToken extends Middleware
{

    /**
     * @inheritDoc
     */
    public function call()
    {
        // Роуты в которых проверка токена не работает
        $route = [$this->app->urlFor('login'), $this->app->urlFor('regist')];

        if ($this->app->request()->isPost()){

            foreach ($route as $value){
                if ($value == $this->app->request->getResourceUri()){

                   return $this->next->call();

                }
            }
       if ($_SESSION['token'] == $this->app->request->post('token')){

         return  $this->next->call();
       }
            exit('fatal error token not found');
        }else{

          return  $this->next->call();
        }

    }


}