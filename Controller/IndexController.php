<?php


namespace Controller;

use Illuminate\Database\Eloquent\Builder;
use Lib\Cache;
use Lib\Helper;
use Model\Anime;
use Model\Cat;
use Model\Post;


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
            $cache = new Cache();
        $this->title .= 'Таджикский аниме портал !';

        if ($cache->exists('posts')) {
            $posts = $cache->get('posts');
        } else {
            $posts = \App\Models\Post::post('anime')
                ->orderBy('date', 'DESC')
                ->take(10)
                ->get();
            $cache->save('posts', $posts);
        }


        if ($cache->exists('newPosts')) {
            $newPosts = $cache->get('newPosts');
        } else {
            $newPosts = \App\Models\Post::post('anime')
                ->orderBy('id', 'DESC')
                ->take(5)
                ->get();
            $cache->save('newPosts', $newPosts);
        }

        if ($cache->exists('dorams')) {
            $dorams = $cache->get('dorams');
        } else {
            $dorams = \App\Models\Post::post('dorams')->orderBy('date', 'DESC')->take(5)->get();

            $cache->save('dorams', $dorams);
        }

//        if ($cache->exists('articles')) {
//            $articles = $cache->get('articles');
//        } else {
//            $articles = \App\Models\Post::post('articles')->orderBy('date', 'DESC')->take(5)->get();
//            $cache->save('articles', $articles);
//        }

        $search = $this->getSearch();
        $slider = $this->getSlider();
        $this->main = $this->app->view()->fetch('indexbar.tpl.php', [
            'app' => $this->app,
            'uri' => $this->uri,
            'posts' => $posts,
            'helper' => Helper::getInstance(),
            'newPosts' => $newPosts,
            'dorams' => $dorams,
//            'articles' => $articles,
            'slider' => $slider,
            'search' => $search,
        ]);
        parent::display(); // TODO: Change the autogenerated stub
    }

}
