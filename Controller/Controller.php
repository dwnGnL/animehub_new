<?php


namespace Controller;

use Lib\Curl;
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
//        $curl = new Curl();
//        $response = $curl->curl_get('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR'].'?fields=message,countryCode,region');
//        $response = unserialize($response);
//        if ($response['countryCode'] != 'TJ'){
//            exit('Сайт доступен только для пользователей Таджикистана');
//        }

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

    protected function getUrl(){
       return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
    }


    protected function clearMessage($var){
        $pattern = $this->getUrl().'/templates/Admin/js/ckeditor/plugins/';
        $var = preg_replace('/<(?!img)\/?[a-z][^>]*(>|$)/i', '', $var);
        if (preg_match_all( "/\< *[img][^\>]*[src] *= *[\"\']{0,1}([^\"\'\ >]*)/",$var,$matches)){

            foreach ($matches as $key => $match){
                if ($key % 2 == 0){
                    if (!strpos($match[0], $pattern)){
                        return $this->clear_str($var);
                    }
                }
            }
        }
        return $var;
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
        $fileName = $dir.md5(time().$title).'.jpg';
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

}
