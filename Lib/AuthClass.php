<?php


namespace Lib;
defined('_Sdef') or exit();

class AuthClass
{
    public $driver;
    static public $instance;

    protected function __construct($driver)
    {
        $this->driver = $driver;
    }

    public static function getInstance($driver){
        if (self::$instance instanceof self){
            return self::$instance;
        }

        return new self($driver);
    }

    public function isUserLogin(){
        if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
                if (isset($_COOKIE['key'])  && !empty($_COOKIE['key'])){
                    $params = [
                        'id' => $_COOKIE['id'],
                        'salt' => $_COOKIE['key'],
                    ];
                    $sql = 'SELECT * FROM lite_users WHERE id = id: AND salt = :salt';
                    $user =  $this->driver->column($sql,$params);
                    if (!empty($user)){

                        return $user;
                    }
                    return false;
                }
                return false;
        }
        return false;
    }

}