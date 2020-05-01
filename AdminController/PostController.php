<?php


namespace AdminController;


use Clue\React\Buzz\Browser;
use Lib\Helper;
use Model\Anime;
use Model\Cat;
use Model\Comment;
use Model\Post;
use Model\PostType;
use Model\Rating;
use Model\View;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Factory;
require_once 'Lib/phpQuery.php';
class PostController extends AdminController
{
    protected $postDB;
    public function __construct()
    {
        $this->postDB = new Post();
        parent::__construct();
    }

    public function index($page){
        $page = $page ? $page : 1;
        $posts = $this->postDB->getPostsList($page,'/dashboard/post');
        foreach ($posts['items'] as $key => $val){
            $disLike = $this->postDB->getDisLike($posts['items'][$key]['id']);
            $posts['items'][$key]['postLike'] =  $posts['items'][$key]['postLike'] - $disLike['dis'];
        }
        $this->index = $this->app->view()->fetch('dashboard/posts.tpl.php', [
            'posts' => $posts,
            'helper' => Helper::getInstance(),
            'uri' => $this->getUri(),
        ]);

        $this->display();

    }

    public function add(){
        $cat = new Cat();
        $typeBD = new PostType();
        $types = $typeBD->getPostType();
        $cats = $cat->getCategories();
        $this->index = $this->app->view()->fetch('dashboard/addPost.tpl.php',[
            'cats' => $cats,
            'types' => $types
        ]);
        $this->display();
    }

    protected function display(){
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }

    public function searchAjax(){
      $posts = $this->postDB->searchPostsList($_POST['title']);
        foreach ($posts as $key => $val){
            $disLike = $this->postDB->getDisLike($posts[$key]['id']);
            $posts[$key]['postLike'] =  $posts[$key]['postLike'] - $disLike['dis'];
        }
        $result = '';
        $i = 0;
        foreach ($posts as $post){
            $result .= $this->app->view()->fetch('dashboard/table.tpl.php', [
                'post' => $post,
                'helper' => Helper::getInstance(),
                'uri' => $this->getUri(),
                'i' => $i++
            ]);
        }
        echo $result;
        exit();

    }

    public function edit($params){
        $post = $this->postDB->getPost($params['post'], $params['alias']);
        $animeDB = new Anime();
        $post['type'] = $params['alias'];
        $anime = $animeDB->getSeria($post['id_tv'],$post['title']);
        $this->index = $this->app->view()->fetch('dashboard/editPost.tpl.php', [
            'post' => $post,
            'anime' => $anime
        ]);
        $this->display();
    }

    public function delete(){
        $animeDB = new Anime();
        $comment = new Comment();
        $views = new View();
        $rating = new Rating();
        if ($animeDB->delete($_POST['id'])){
           if ( $comment->deleteCommentsPost($_POST['id'])){
               if ($views->deleteViewsPost($_POST['id'])){
                    if ($rating->deleteRatingPost($_POST['id'])){
                        $this->postDB->deletePost($_POST['id']);
                        echo json_encode(['status' => 200]);
                        exit();
                    }
               }
           }
        }
        echo json_encode(['status' => 500]);
        exit();
    }

    public function editSeria(){
        if ($_POST['type'] == 1){
            $seria = json_decode($_POST['seria']);
            $animeDB = new Anime();
            $animes =  $animeDB->getAnimeIn($seria);
            $countCorrect =  $this->changeSrc($animes);
            echo json_encode(['status' => 200, 'countCorrect' => $countCorrect, 'type' => 1]);
        }


    }

    public function changeSrc( array $anime){
        $animeDB = new Anime();
        $i = 0;
        foreach ($anime as $val){
            if (($src = $this->autoCorrectMix($val['rly_path'], $val['src'])) != false){
                $animeDB->updateSrc($val['id'],$src);
                $i++;
            }
        }
        return $i;
    }

    public function autoCorrectMix($href, $oldSrc){

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
            if ($oldSrc != $src){
                return $src;
            }
            return  false;

        }else{

            return false;
        }


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
}