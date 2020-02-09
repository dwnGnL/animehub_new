<?php


namespace Controller;

defined('_Sdef') or exit();

abstract class Controller
{
    protected  $app;
    protected  $model;
    protected  $uri;
    protected  $title;
    protected static  $instance;

    public function __construct()
    {
        $this->app = \Slim\Slim::getInstance();
        $this->uri = $this->getUri();
        $this->title = 'AnimeHub | ';

    }

    public function getInstance($prefix, $dir = 'Controller'){

        $class = $dir.'\\'.ucfirst($prefix).'Controller';


        if (self::$instance instanceof $class){

            return self::$instance;
        }

        if(class_exists($class)){
            self:self::$instance = new $class;
        }else{
            throw  new \Exception('Class not found - '.$class);
        }
        return self::$instance;
    }

    public function execute($param = []){
        return true;
    }

    protected  function getUri(){

        $env = $this->app->environment;


        if (isset($env['slim.url_scheme']) && $env['slim.url_scheme'] == 'https'){
            $https = 's://';
        }else{
            $https = '://';
        }

        if (!empty($env['HTTP_HOST'])){
            $theURI = 'http'.$https.$env['HTTP_HOST'];

        }
        if (!empty($env['SCRIPT_NAME'])){
            $theURI .= $env['SCRIPT_NAME'];
        }

        $theURI = str_replace(["'", '"', '<', '>'],['%27','%22','%3C','%3E'],$theURI);
        $theURI = str_replace('index.php','', $theURI);
        $theURI .= '/';
        return $theURI;
    }



    protected function debug($string){
        echo '<pre>';
        var_dump($string);
        echo '</pre>';
        exit();
    }

    protected function clear_str($var){

        return strip_tags(trim($var));
    }
    public function generateSalt($saltLength = 8)
    {
        $salt = '';
        for($i=0; $i<$saltLength; $i++) {
            $salt .= chr(mt_rand(33,126)); //символ из ASCII-table
        }
        return $salt;
    }

    abstract protected function getMenu();
    abstract protected function getSidebar();

    abstract protected function display();
}