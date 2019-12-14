<?php


namespace Controller;
defined('_Sdef') or exit();

class RegistController extends DisplayController
{
    protected $index;

    public function formView(){
        $this->index = $this->app->view()->fetch('regist.tpl.php',[
            'uri' => $this->uri,
        ]);
        $this->display();
    }

    public function registration(){

if (isset($_POST['button'])) {
    $errors = [];
    if (isset($_POST['login'])) {
        if (trim($_POST['login']) == '') {
            $errors[] = 'Введите логин!';
        } elseif ((strlen(trim($_POST['login']))) <= 3) {
            $errors[] = 'Login должен иметь более 3 символов';
        }
    }

    if (isset($_POST['email'])) {
        if (trim($_POST['email']) == '') {
            $errors[] = 'Введите email!';
        }
    }

    if (isset($_POST['password'])) {
        if (trim($_POST['password']) == '') {
            $errors[] = 'Введите пароль!';
        }
    }
    if (isset($_POST['repassword'])) {
        if ($_POST['password'] != $_POST['repassword']) {
            $errors[] = 'Введённые пароли должны совпадать.!';
        }
        if (trim($_POST['password']) == '') {
            $errors[] = 'Введите повторный пароль!';
        }
    }

    }

    $count = $this->model->getCountUsersLoginOrEmail($_POST['login'], $_POST['email']);
    if ($count['COUNT(*)'] > 0) {
        $errors [] = 'Пользователь с таким логином или почтой существует!';
    }
    if (empty($errors)) {
        $this->model->addNewUser($_POST['login'], $_POST['email'], $_POST['password'],time(), $_SERVER['REMOTE_ADDR'],$this->uri);
        $this->app->redirectTo('home');
        echo '<p style="color:green;">Вы успешно зарегистрировались на сайте!,</p>';
    } else {
        echo '<p style="color: red; margin-left: 10px;">' . array_shift($errors) . '</p>';

    }
}




    protected function display()
    {
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }

}