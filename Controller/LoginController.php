<?php


namespace Controller;



defined('_Sdef') or exit();

class LoginController extends DisplayController
{

    public function execute($param = [])
    {



          return  $this->login();

       // $auth = \Lib\Authclass;

//        if (FALSE){
//
//        }else{
//
//        }
    }

    public function logout(){
        if (isset($_SESSION['auth'])){
            session_destroy();
            $this->app->deleteCookie('key');
            $this->app->deleteCookie('id');
            $this->app->redirect($this->app->urlFor('home'));


        }
        $this->app->redirect($this->app->urlFor('home'));

    }

    protected function login(){

        $post = $this->app->request->post();

        if (!empty($post)){
            $login = $this->clear_str($post['login']);
            $password = $this->clear_str($post['password']);
            if (empty($login) || empty($password)){
                $this->app->flash('error','Заполните обезязательные поля');
                $this->app->redirect($_POST['redirect']);
            }
            $password = MD5($password);
            $result = $this->model->getUserLoginPass($login,$password);
            if (!$result){
                $this->app->flash('error','Пароль или логин ввели не правильно');
                $this->app->redirect($_POST['redirect']);
            }


            $_SESSION['auth'] = true;
            $_SESSION['login'] = $result['login'];
            $_SESSION['status'] = $result['status'];
            $_SESSION['id'] = $result['id'];
            $salt = $this->generateSalt();
            $this->app->setCookie('key', $salt, '30 days');
            setcookie('id', $result['id'], time() + (86400 * 7));
            $this->model->userLogin($salt,$result['id']);
            $this->model->updateIp($_SERVER['REMOTE_ADDR'],$result['id']);

            $this->app->redirect($_POST['redirect']);

        }else{
            $this->app->redirect($this->app->urlFor('home'));
        }
    }

}