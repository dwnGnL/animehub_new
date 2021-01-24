<?php


namespace Lib;
use Model\User;
use Slim\Slim;

defined('_Sdef') or exit();

class AuthClass
{
    public $driver;
    public $app;
    static public $instance;

    protected function __construct($driver)
    {
        $this->driver = $driver;
        $this->app = \Slim\Slim::getInstance();
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
                        'id' => $this->app->getEncryptedCookie('id'),
                        'salt' => $this->app->getEncryptedCookie('key'),
                    ];
                    $sql = 'SELECT lite_users.login,lite_status.title AS status,lite_users.id 
                            FROM lite_users, lite_status
                            WHERE lite_users.status = lite_status.id AND lite_users.id = :id AND lite_users.salt = :salt ';
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
