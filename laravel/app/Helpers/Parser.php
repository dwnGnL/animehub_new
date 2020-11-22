<?php

namespace App\Helpers;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class Parser
{
    private $browser;

    public function __construct()
    {
        $this->browser = new HttpBrowser(HttpClient::create());
    }

    public function autoFixMix($uri){

      $crawler =  $this->browser->request('GET', $uri);

      if ($crawler->filter('source')->count() > 0){
            return  $crawler->filter('source')->attr('src');
      }

      if ($crawler->filter('video')->count() > 0){
            return  $crawler->filter('video')->attr('src');
      }

        $uri = str_replace('video', 'embed', str_replace('watch', 'embed',$uri));
        $crawler =  $this->browser->request('GET', $uri);
        $uri = $this->getSrc($crawler->html());
        if (!empty($uri)){
            return  $uri;
        }

      return false;
    }

    private function getSrc($text){
        $matches = [];
        preg_match('/file:""*?(?<uri>.+?)"/', $text, $matches);
        $uri = !empty($matches['uri'])?$matches['uri']:'';
        return $uri;
    }
}
