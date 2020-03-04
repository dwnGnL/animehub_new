<?php


namespace Lib;


class  Helper
{
    protected static $instance;
    public function __construct()
    {

    }

    public static function relPath($url){
      $pos =  strpos($url,'/');
      return substr($url,$pos);
    }
    public static function getInstance(){
        if (self::$instance instanceof self){
            return self::$instance;
        }
        return new self;
    }

    public static function renderUrl($id,$alias){
        $id = $id.'-';
        $alias = str_replace(' ', '-', $alias);
        return $id.$alias;
    }

    public static function renderCat($catPost){
        $count = count($catPost);
        $result = '';
        $i = 0;
        foreach ($catPost as $cat) {
            if($i == $count-1){
                $result .= $cat['title'];
            }else{
                $result .= $cat['title'].', ';
            }
            $i++;
        }
        return $result;
    }

    public static function getWatch ($dateWithBase, $number = DATE){
        $offset = 3600;
        $offset *= $number;
        $result = $dateWithBase + $offset;
        return date('d.m.Y H:i:s', $result);

    }

    public static  function generateToken(){
        if (isset($_SESSION['token'])){
            return $_SESSION['token'];
        }
        $_SESSION['token'] =  md5(self::generateSalt(16));
        return $_SESSION['token'];
    }

    public static function generateSalt($saltLength = 8)
    {
        $salt = '';
        for($i=0; $i<$saltLength; $i++) {
            $salt .= chr(mt_rand(33,126)); //символ из ASCII-table
        }
        return $salt;
    }

    public static function getTitle($alias){
        switch ($alias){
            case 'anime':
                  $alias = 'Аниме';
                  break;
            case 'dorams':
                $alias = 'Дорамы';
                break;
            case 'articles':
                $alias = 'Статьи и новости';
                break;
            case 'donate':
                $alias = 'Помощь';
                break;
            case 'ongoings':
               $alias = 'Онгоинги';
        }
        return $alias;
    }
}