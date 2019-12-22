<?php


namespace Lib;

require_once '../../Lib/Helper.php';
class Log
{
    public static function writeLog($data, $user){
        $fd = fopen(__DIR__.'\logs\parser.txt', 'a') or die("не удалось открыть файл");
        $date = Helper::getWatch(time());
        $str = '['.$date.'] - '.$data.' - '.$user."\n";
        fwrite($fd, $str);
        fclose($fd);
    }
}