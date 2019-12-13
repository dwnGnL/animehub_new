<?php
session_start();
//Если переменная auth из сессии не пуста и равна true, то...
if (isset($_COOKIE['login'])) {

    session_destroy(); //разрушаем сессию для пользователя
    unset($_COOKIE['login']);
    unset($_COOKIE['key']);
    //Удаляем куки авторизации путем установления времени их жизни на текущий момент:
    setcookie('login', null, -1, '/'); //удаляем логин
    setcookie('key', null, -1, '/'); //удаляем ключ

    header('Location:../index.php');
}

if(isset($_SESSION['auth'])){
    session_destroy();
    header('Location:../index.php');
}

?>