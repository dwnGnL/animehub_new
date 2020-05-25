<?php


namespace Lib;


use Slim\Middleware;

class CheckAuthMiddleware extends Middleware
{
    protected $exception;

    public function __construct(\Lib\AuthClass $auth, $exception)
    {
        $this->auth = $auth;
        $this->exception = $exception;
    }

    public function call()
    {
        if ($_SERVER['REMOTE_ADDR'] == '146.185.152.98'){
            exit('ты заблокирован за накрутку просмотров аниме Наруто Ураганные Хроники');
        }
        if ($user = $this->auth->isUserLogin()) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['status'] = $user['status'];
        }
        if ($this->app->request->isPost()) {

            for ($i = 0; $i < count($this->exception); $i++ ) {
                if ($this->exception[$i] == $this->app->request->getResourceUri()) {
                    return $this->next->call();
                }
            }
                if (isset($_SESSION['auth'])) {
                    return $this->next->call();
                }

                echo json_encode(['status' => '401']);
                exit();

            }
            // TODO: Implement call() method.

        return $this->next->call();
    }
}