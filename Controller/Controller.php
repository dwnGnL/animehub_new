<?php


namespace Controller;

use services\geo\SxGeo;

defined('_Sdef') or exit();

abstract class Controller
{
    protected  $app;
    protected  $model;
    protected  $uri;
    protected  $title;
    protected $description = 'Аниме портал Таджикистана! Дорамы смотреть онлайн, полностью внутренный трафик';
    protected $keywords = 'аниме, онлайн, anime, online, бесплатно, без регистрации, русская озвучка, дорамы, внутренный трафик, таджикский';

    protected static  $instance;

    public function __construct()
    {
//        $this->controls();
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

    public function downloadImage($url, $title, $dir = 'public/images/post/'){
        $link = $url;
        $title = str_replace(' ', '-', $title);
        $file = file_get_contents($link);
        $fileName = $dir.time().$title.'.jpg';
        if ( file_put_contents($fileName, $file)){
            return $fileName;
        }
       return  false;
    }

    public function decompileData($array){
        $newArray = [];
        foreach ($array as $value){
            $newArray[$value['name']] = $value['value'];
        }
        return $newArray;
    }

    public function deleteImage($path){
        if (file_exists($path)){
            unlink($path);
            return true;
        }
        return  false;
    }

    abstract protected function getMenu();
    abstract protected function getSidebar();

    abstract protected function display();
    protected function controls(){
        require 'data.php';
        $access = 0;
        foreach ($exceptionIp as $value){
            if ($value == $_SERVER['REMOTE_ADDR']){
                $access = 1;
                break;
            }
        }
        if ($access != 1){
            $geo = new SxGeo();
            if (strtoupper($geo->getCountry($_SERVER['REMOTE_ADDR'])) != strtoupper('TJ')){
                exit('Сай доступен для пользователей РТ.');
            }
        }
    }
//    protected function prebmatch(){
//        $domen = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/templates/Admin/js/ckeditor/plugins/hkemoji/sticker';
//        $message = '';
//        $regHtml = '/(\<(\/?[^>]+)>)/';
//        $html = 'asdasdasdasd<p>dasdasdasdasdasdasdasdasd</p>asdasdasdasdasd < href="">';
//
//        if (!preg_match('/(\<img>)/', $html) && preg_match($regHtml, $html) || strpos($html, $domen) && preg_match('/(\<img>)/', $html, $matches) && ){
//            $message = str_replace($regHtml,'',$html);
//            $this->debug($message);
//
//        }
//    }
}