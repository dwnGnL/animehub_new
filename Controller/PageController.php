<?php


namespace Controller;
defined('_Sdef') or exit();

use Lib\Helper;
use Model\Anime;
use Model\Cat;
use Model\Comment;
use Model\Favorite;
use Model\Post;
use Model\Rating;
use Model\Stud;
use Model\View;


class PageController extends DisplayController
{
    protected $page;
    protected $alias;
    protected $index;
    public function chat(){

        $this->index = $this->app->view()->fetch('template.tpl.php',[
            'uri' => $this->uri,
        ]);

        $this->display();
    }
    public function search($title){
        if (iconv_strlen(trim($title)) > 3){
            $postDB = new Post();
            $cat = new Cat();
            $post =  $postDB->search($title);
            if (empty($post)){
                $this->app->notFound();
            }
            $i = 0;
            foreach ($post as $item){
                $post[$i]['cats'] = $cat->getCatPostL2($item['id']);
                if (strripos($post[$i]['image'], 'public/images/post') !== false){
                    $post[$i]['image'] = $this->uri.$item['image'];
                }
                $i++;
            }
            $search = $this->getSearch();
            $this->index = $this->app->view()->fetch('page.tpl.php', [
                'uri' => $this->uri,
                'app' => $this->app,
                'items' => $post,
                'navigation' => '',
                'helper' => Helper::getInstance(),
                'title' => Helper::getTitle($this->alias),
                'search' => $search,
            ]);

          $this->display();

        }else{
            $this->app->notFound();
        }

    }


    public function post($param = []){
        $postDB = new  Post();
        $ratingDB = new Rating();
        $favoriteDB = new Favorite();
        $view = new View();
        $catDB = new Cat();
        $anime = new Anime();
        $stud = new Stud();
        $commentDB = new Comment();
        preg_match('#\d+#', $param['page'], $matches);
        $like = $ratingDB->getLikeCount($matches[0], 1);
        $disLike = $ratingDB->getLikeCount($matches[0], 0);
        $post = $postDB->getPost($matches[0],$param['alias']);
        $this->title = $post['title'].' - AnimeHub.tj';
        $postStud = $stud->getStud($post['title']);
        $favorite = $favoriteDB->favoritePost($matches[0], $_SESSION['id']);
        if (empty($favorite)){
            $favorite['title'] = 'Добавить в избанное';
        }else{
            $favorite['title'] = 'Удалить из избранного';
            $favorite['class'] = 'choose';
        }
        if (!isset($_COOKIE[$matches[0]]) OR $_COOKIE[$matches[0]] != $matches[0]){
            $view->updateView($post['id_post']);
            $this->app->setCookie($matches[0], $matches[0],time() + 1440);
        }
        if (empty($post)){
            $this->app->notFound();
        }

        $cat = $catDB->getCatPost($post['id_post']);
        $similar = $postDB->getSimilarPosts($cat[1]['id'],$param['alias'],$matches[0]);
        $rating = [
            'like' => $like['total'],
            'disLike' =>$disLike['total']
        ];
        foreach ($similar as $key => $val){
            $similar[$key]['cats'] = $catDB->getCatPostL2($similar[$key]['id']);
            if (strripos($similar[$key]['image'], 'public/images/post') !== false){
                $similar[$key]['image'] = $this->uri.$similar[$key]['image'];
            }
        }
        if (strripos($post['image'], 'public/images/post') !== false){
            $post['image'] = $this->uri.$post['image'];
        }

        $orderPosts = $postDB->getOrderPosts($post['title']);
        $player = $anime->getSeria($post['id_tv'], $post['title']);
        $comments = $commentDB->getComments($post['id_post']);
        $this->index = $this->app->view()->fetch('post.tpl.php',[
            'uri' => $this->uri,
            'cat' => Helper::renderCat($cat),
            'post' => $post,
            'similar' => $similar,
            'player' => $player,
            'comments' => $comments,
            'helper' => Helper::getInstance(),
            'orderPosts' => $orderPosts,
            'rating' => $rating,
            'alias' => $param['alias'],
            'favorite' => $favorite,
            'stud' => $postStud,
        ]);
           $this->display();
    }

    public function allPost($param = []){
        $postDB = new Post();
        $catDB = new Cat();
        $anime = new Anime();
        $page = $param['page'];
        $search = $this->getSearch();
        $this->page = $page ? $page : 1;
        $this->alias = $param['alias'];
        $path = $this->app->request->getPath();
        preg_match('#/\d+#', $path, $mathces);
        $path = str_replace($mathces[0], '', $path);
        if ($param['url'] == 'year'){
            preg_match('#/\d+#', $path, $mathces);
            $path = str_replace($mathces[0], '', $path);
            $path .= '/'.$param['alias'];
        }
        $items = $postDB->getItems($this->page,$path,$this->alias,$param['url']);
        if (empty($items['items'])){
            $this->app->notFound();
        }
        $i = 0;
        foreach ($items['items'] as $item){
            $row[] = $item;
            $row[$i]['cats'] = $catDB->getCatPostL2($row[$i]['id']);
            $row[$i]['seria'] = $anime->lastAddSeria($row[$i]['title'],$row[$i]['id_tv']);
            if (strripos($row[$i]['image'], 'public/images/post') !== false){
                $row[$i]['image'] = $this->uri.$row[$i]['image'];
            }
            $i++;
        }
        $items['items'] = $row;
        $this->index = $this->app->view()->fetch('page.tpl.php', [
            'uri' => $this->uri,
            'app' => $this->app,
            'items' => $items['items'],
            'navigation' => $items['navigation'],
            'helper' => Helper::getInstance(),
            'title' => Helper::getTitle($this->alias),
            'search' => $search,
        ]);
     $this->display();

    }

    protected function display()
    {
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }
}