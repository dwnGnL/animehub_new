<?php


namespace Controller;



use Lib\Auth;
use Lib\AuthClass;
use Model\User;

defined('_Sdef') or exit();

class LoginController extends DisplayController
{

    public function execute($param = [])
    {

          return  $this->login();
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
            $login = clear_str($post['login']);
            $password = clear_str($post['password']);
            if (empty($login) || empty($password)){
                $this->app->flash('error','Заполните обязательные поля');
                $this->app->redirect($_POST['redirect']);
            }
            $result = Auth::auth($login, $password) ;
            if (!$result){
                $this->app->flash('error','Пароль или логин ввели не правильно');
                $this->app->redirect($_POST['redirect']);
            }
            $this->app->redirect($_POST['redirect']);
        }else{
            $this->app->redirect($this->app->urlFor('home'));
        }
    }
    public function getLogin(){
        if (isset($_SESSION['auth'])){
            $userDB = new User();
            $user = $userDB->getUsersProperties($this->app->getEncryptedCookie('key'), $this->app->getEncryptedCookie('id'));
            $result = [
                'info' => $user,
                'status' => 200
            ];
            echo json_encode($result);
            exit();
        }
        echo json_encode(['status' => 501]);
        exit();


    }
    public function checkAuth(){
        if (isset($_SESSION['auth'])){
            echo json_encode(['status' => 200]);
            exit();
        }
        echo json_encode(['status' => 501]);
        exit();
    }

}
