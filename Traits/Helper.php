<?php


trait Helper
{
    private function getSrc($text)
    {
        $matches = [];
        preg_match('/file:""*?(?<uri>.+?)"/', $text, $matches);
        $uri = !empty($matches['uri']) ? $matches['uri'] : '';
        return $uri;
    }
}
