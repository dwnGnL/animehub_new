<?php


namespace Lib;


class  Helper
{
    protected static $instance;
    public function __construct()
    {

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

    public static function renderCat($catPost,$count){
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
}