<?php


namespace Controller;


use Lib\Helper;

class PageController extends DisplayController
{
    protected $page;
    protected $alias;
    protected $index;

    public function execute($param = [])
    {




    }


    public function post($param = []){

        preg_match('#\d+#', $param['page'], $matches);
        $post = $this->model->getPost($matches[0],$param['alias']);
        $cat = $this->model->getCatPost($post['id_post']);
        $similar = $this->model->getSimilarPosts($cat[1]['id'],$param['alias'],$matches[0]);
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
        ]);

        $this->display();
    }

    public function allPost($param = []){
        $page = $param['page'];

        $this->page = $page ? $page : 1;
        $this->alias = $param['alias'];
        $path = $this->app->request->getPath();
        preg_match('#/\d+#', $path, $mathces);
        $path = str_replace($mathces[0], '', $path);
        $path .= '/';
        $items = $this->model->getItems($this->page,$path,$this->alias,$param['url']);
        foreach ($items['items'] as $item){
            $row[] = $item;
        }
        $items['items'] = $row;
        $this->index = $this->app->view()->fetch('page.tpl.php', [
            'uri' => $this->uri,
            'app' => $this->app,
            'items' => $items['items'],
            'navigation' => $items['navigation'],
            'helper' => Helper::getInstance(),
        ]);
    $this->display();
    }

    protected function display()
    {
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }
}