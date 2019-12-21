<?php
require 'sole.php';
require 'lib/Reg.php';
require_once 'tech.php';
$select = new Reg();
if(empty($_SESSION['auth']) || $_SESSION['auth'] == false || !isset($_SESSION['auth'])){
if (!empty($_COOKIE['login']) && !empty($_COOKIE['key'])) {

    $login  = $_COOKIE['login'];
    $key = $_COOKIE['key'];
    $user = $select->findUserRemeber($login, $key);
    if(Tech::$tech == 1 && $user['status'] != 1){
        header('Location:tech_obs.php');
    }
    if(!empty($user)){
        session_start();
        $_SESSION['auth'] = true;

        $_SESSION['login'] = $user['login'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['status'] = $user['status'];
    }
}else {
    if(Tech::$tech == 1){
        header('Location:tech_obs.php');
    }
}
}



$salt = '';
if(isset($_POST['enter'])){

   $user = $select->findUser($_POST['login']);
   if(!empty($user)){
       if($user['password'] === $_POST['password']){
           session_start();
           $_SESSION['auth'] = true;
           $_SESSION['login'] = $user['login'];
           $_SESSION['status'] = $user['status'];
           $_SESSION['id'] = $user['id'];
               $salt = generateSalt();
               setcookie('login', $user['login'], time() + (86400 * 7));
               setcookie('key', $salt, time() + (86400 * 7));

           $select->updateSalt($salt, $_SESSION['login']);
           $select->updateIp($_SERVER['REMOTE_ADDR'],$_SESSION['login']);

       }
   }
}

?>


