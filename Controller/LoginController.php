<?php


namespace Controller;



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
            $userDB = new User();
            $login = $this->clear_str($post['login']);
            $password = $this->clear_str($post['password']);
            if (empty($login) || empty($password)){
                $this->app->flash('error','Заполните обезязательные поля');
                $this->app->redirect($_POST['redirect']);
            }
            $password = MD5($password);

            $result = $userDB->getUserLoginPass($login,$password);
            if (!$result){
                $this->app->flash('error','Пароль или логин ввели не правильно');
                $this->app->redirect($_POST['redirect']);
            }


            $_SESSION['auth'] = true;
            $_SESSION['login'] = $result['login'];
            $_SESSION['status'] = $result['status'];
            $_SESSION['id'] = $result['id'];
            $salt = $this->generateSalt();
            $this->app->setEncryptedCookie('key', $salt, '30 days');
            $this->app->setEncryptedCookie('id', $result['id'], '30 days');
            $userDB->userLogin($salt,$result['id']);
            $userDB->updateIp($_SERVER['REMOTE_ADDR'],$result['id']);

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