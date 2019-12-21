<?php


class Support
{

    public static function getWatch ($dateWithBase, $number = 5){
        $offset = 3600;
        $offset *= $number;
        return $dateWithBase + $offset;
    }

    public function navigationPage($limit, $offset, $countPage){


    }
}