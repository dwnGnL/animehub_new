<?php


namespace Controller;




use Clue\React\Buzz\Browser;
use Model\Anime;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Factory;
require_once 'lib/phpQuery.php';

class ParserController
{
    protected $loop;
    protected $client;
    protected $content;

    public function __construct()
    {
        $this->loop = Factory::create();
        $this->client = new Browser($this->loop);
    }

    public function getContent($site){
        $loop = Factory::create();
        $client = new Browser($loop);
        $client->get($site)
            ->then(function(ResponseInterface $response) use ($loop){
            $this->content = $response->getBody();
                $loop->stop();
            });
        $loop->run();

        return $this->content;
    }
    public function index($site = 'https://manga-online.biz/genre/all'){
        $doc = \phpQuery::newDocument($this->getContent($site));
        $href = $doc->find('.genres .genre:eq(0)')->attr('href');
        $newSrc = 'https://manga-online.biz'.$href;
        $newDoc = \phpQuery::newDocument($this->getContent($newSrc));
        $html = $newDoc->find('.chapters .list .item .header')->attr('href');
        echo $html;
    }

    public function changeSrc(){
        $animeDB = new Anime();
        $anime = $animeDB->getAnimeForCorrect('1');
        foreach ($anime as $val){
            if (($src = $this->autoCorrectMix($val['rly_path'])) != false){
                    $animeDB->updateSrc($val['id'],$src);
            }
        }
    }

    public function autoCorrectMix($href){

            $href = explode('/', $href);
            $embed = $this->getContent('http://mix.tj/embed/'. $href[2]);
            $embed = \phpQuery::newDocument($embed);
            $src = '';
            if($embed->find('script')) {
                $vid = $embed->find('script')->text();
                $vid = substr($vid, 65,120);
                $delimetr = '"';
                $vid = explode($delimetr, $vid,3 );
                $src = $vid[1];
            }
            if(!empty($src)){
                return $src;

            }else{

                return false;
            }


    }


}