<?php


namespace Controller;
use Lib\Helper;
use Lib\Migration;

defined('_Sdef') or exit();

class IndexController extends DisplayController
{
    protected $page;
    public function execute($param = [])
    {

        return $this->display();
    }

    protected function display()
    {
        $this->title .= 'Таджикский аниме портал !';
        $posts =  $this->model->getPostL10('anime',10);
        foreach ($posts as $key => $val){
            $posts[$key]['cats'] = $this->model->getCatPostL2($posts[$key]['id']);
        }

        $newPosts = $this->model->getPostL5();
        foreach ($newPosts as $key => $val){
            $newPosts[$key]['cats'] = $this->model->getCatPostL2($newPosts[$key]['id']);
        }
        $dorams =  $this->model->getPostL10('dorams',5);
        foreach ($dorams as $key => $val){
            $dorams[$key]['cats'] = $this->model->getCatPostL2($dorams[$key]['id']);
        }
        $articles =  $this->model->getPostL10('articles',6);
        $search = $this->getSearch();
        $slider = $this->getSlider();
        $this->main = $this->app->view()->fetch('indexbar.tpl.php',[
            'app' => $this->app,
            'uri' => $this->uri,
            'posts' => $posts,
            'helper' => Helper::getInstance(),
            'newPosts' => $newPosts,
            'dorams' => $dorams,
            'articles' => $articles,
            'slider' => $slider,
            'search' => $search,


        ]);
        parent::display(); // TODO: Change the autogenerated stub
    }

}