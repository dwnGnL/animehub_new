<?php
namespace Lib;
class Curl
{
    public $proxy;
    public function __construct($proxy = '')
    {
        $this->proxy = $proxy;
    }

    public function curl_get($url, $referer = 'http://www.google.com'){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36');
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($proxy)){
            curl_setopt($ch,CURLOPT_PROXY, $this->proxy);
            curl_setopt($ch,CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        }
        $data = curl_exec($ch);
        return $data;
    }

  }





?>
