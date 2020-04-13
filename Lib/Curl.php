<?php
namespace Lib;
class Curl
{
   public static function curl_get($url, $referer = 'http://www.google.com'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36');
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_PROXY, '104.244.75.26:8080');
        curl_setopt($ch,CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        $data = curl_exec($ch);
        return $data;
    }

  }





?>
