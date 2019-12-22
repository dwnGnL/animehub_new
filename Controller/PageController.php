<?php


namespace Controller;
defined('_Sdef') or exit();

use Lib\Helper;
use Lib\Migration;



class PageController extends DisplayController
{
    protected $page;
    protected $alias;
    protected $index;
    public function search($title){
        if (iconv_strlen(trim($title)) > 3){
            $post =  $this->model->search($title);
            if (empty($post)){
                $this->app->notFound();
            }
            $i = 0;
            foreach ($post as $item){
                $post[$i]['cats'] = $this->model->getCatPostL2($item['id']);
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
        preg_match('#\d+#', $param['page'], $matches);
        $like = $this->model->getLikeCount($matches[0], 1);
        $disLike = $this->model->getLikeCount($matches[0], 0);
        $post = $this->model->getPost($matches[0],$param['alias']);
        $favorite = $this->model->favoritePost($matches[0], $_SESSION['id']);
        if (empty($favorite)){
            $favorite['title'] = 'Добавить в избанное';
        }else{
            $favorite['title'] = 'Удалить из избранного';
            $favorite['class'] = 'choose';
        }
        if (!isset($_COOKIE[$matches[0]]) OR $_COOKIE[$matches[0]] != $matches[0]){
            $this->model->updateView($post['id_post']);
            $this->app->setCookie($matches[0], $matches[0],time() + 1440);
        }
        if (empty($post)){
            $this->app->notFound();
        }

        $cat = $this->model->getCatPost($post['id_post']);
        $similar = $this->model->getSimilarPosts($cat[1]['id'],$param['alias'],$matches[0]);
        $rating = [
            'like' => $like['total'],
            'disLike' =>$disLike['total']
        ];
        foreach ($similar as $key => $val){
            $similar[$key]['cats'] = $this->model->getCatPostL2($similar[$key]['id']);
        }
        $orderPosts = $this->model->getOrderPosts($post['title']);
        $player = $this->model->getSeria($post['id_tv'], $post['title']);
        $comments = $this->model->getComments($post['id_post']);
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
        ]);
           $this->display();
    }

    public function allPost($param = []){
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
        $items = $this->model->getItems($this->page,$path,$this->alias,$param['url']);
        if (empty($items['items'])){
            $this->app->notFound();
        }
        $i = 0;
        foreach ($items['items'] as $item){
            $row[] = $item;
            $row[$i]['cats'] = $this->model->getCatPostL2($row[$i]['id']);
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