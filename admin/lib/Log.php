<?php

class Log{

    public static function writeLog($data, $user){
        $fd = fopen('logs\parser.txt', 'a') or die("не удалось открыть файл");
        $date = self::getWatch(time()) ;
        $str = '['.$date.'] - '.$data.' - '.$user."\n";
        fwrite($fd, $str);
        fclose($fd);
    }

    public static function getWatch ($dateWithBase, $number = 5){
        $offset = 3600;
        $offset *= $number;
        $result = $dateWithBase + $offset;
        return date('d.m.Y H:i:s', $result);

    }
}