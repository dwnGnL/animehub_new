<?php


namespace Lib;


use Slim\Middleware;

class CheckToken extends Middleware
{
    protected $exception;

    /**
     * @inheritDoc
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function call()
    {

        if ($this->app->request()->isPost()){

            foreach ($this->exception as $value){
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