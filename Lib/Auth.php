<?php


namespace Lib;


use Model\User;
use Slim\Slim;

class Auth
{

    public static  function auth($login, $password)
    {
        $userDB = new User();
        $password = MD5($password);
        $result = $userDB->getUserLoginPass($login,$password);
        if (!$result){
            return false;
        }
        $_SESSION['auth'] = true;
        $_SESSION['login'] = $result['login'];
        $_SESSION['status'] = $result['status'];
        $_SESSION['id'] = $result['id'];
        $salt = generateSalt();
        $slim = Slim::getInstance();
        $slim->setEncryptedCookie('key', $salt, '30 days');
        $slim->setEncryptedCookie('id', $result['id'], '30 days');
        $userDB->userLogin($salt,$result['id']);
        $userDB->updateIp($_SERVER['REMOTE_ADDR'],$result['id']);
        return  true;
    }

}
