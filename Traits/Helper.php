<?php

namespace Traits;
trait Helper
{
    private function getSrc($text)
    {
        $matches = [];
        preg_match('/file:""*?(?<uri>.+?)"/', $text, $matches);
        $uri = !empty($matches['uri']) ? $matches['uri'] : '';
        return $uri;
    }

    function is_url($url) {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }
}
