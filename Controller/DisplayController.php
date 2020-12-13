<?php


namespace Controller;

use Lib\Cache;
use Lib\Helper;
use Model\Anime;
use Model\Answer;
use Model\Cat;
use Model\Comment;
use Model\Favorite;
use Model\GodWip;
use Model\Notification;
use Model\Post;
use Model\Question;
use Model\Slider;
use Model\Top;
use Model\User;
use Model\Vote;

defined('_Sdef') or exit();

abstract class DisplayController extends Controller
{


    protected $template = 'index.tpl.php';

    protected function getSlider()
    {
        $db = new Slider();
        $cache = new Cache();

        if ($cache->exists('slider')) {
            $slider = $cache->get('slider');
        } else {
            $slider = $db->getSlider();
            $cache->save('slider', $slider);
        }

        return $this->app->view()->fetch('slider.tpl.php', [
            'slider' => $slider,
            'uri' => $this->uri,
            'helper' => Helper::getInstance(),
        ]);
    }

    protected function getSearch($type = 'Пост')
    {
        return $this->app->view()->fetch('search.tpl.php', [
            'uri' => $this->getUri(),
            'type' => $type
        ]);
    }


    protected function getMenu()
    {
        $fav = new Favorite();
        $godWip = new GodWip();
        $post = new Post();
        $cat = new Cat();
        $userDB = new User();
        $cache = new Cache();


        $favorites = $fav->getCountFavorites($_SESSION['id']);


        if ($cache->exists('years')){
            $years = $cache->get('years');
        }else{
            $years = $godWip->getGodWip();
            $cache->save('years', $years);
        }

        if ($cache->exists('pages')){
            $pages = $cache->get('pages');
        }else{
            $pages = $post->getPages();
            $cache->save('pages', $pages);
        }

        if ($cache->exists('categories')){
            $categories = $cache->get('categories');
        }else{
            $categories = $cat->getCategories();
            $cache->save('categories', $categories);
        }


        $user = $userDB->getUser($_SESSION['login']);
        $rep = '  ';
        return $this->app->view()->fetch('menu.tpl.php', [
            'pages' => $pages,
            'app' => $this->app,
            'uri' => $this->uri,
            'categories' => $categories,
            'years' => $years,
            'user' => $user,
            'favorites' => $favorites['total']
        ]);


        // TODO: Implement getMenu() method.
    }

    protected function getSidebar()
    {
        $top = new Top();
        $question = new Question();
        $answerDB = new Answer();
        $voteDB = new Vote();
        $anime = new Anime();
        $post = new Post();
        $commentDB = new Comment();
        $cache = new Cache();




        if ($cache->exists('quest')){
            $quest = $cache->get('quest');
        }else{
            $quest = $question->getQuestions();
            $cache->save('quest', $quest);
        }

        if ($cache->exists('answer')){
            $answer = $cache->get('answer');
        }else{
            $answer = $answerDB->getAnswers($quest['id_questions']);
            foreach ($answer as $key => $value) {
                $votedUser = $voteDB->getVotedUserQA($_SESSION['id'], $answer[$key]['id_answers']);
                $total = $voteDB->getTotalVoted($answer[$key]['id_answers']);
                $answer[$key]['total'] = $total['total'];
                if (!empty($votedUser)) {
                    $vote = $votedUser;
                    $answer[$key]['voted'] = $votedUser['id_voting'];
                }
            }
            $cache->save('answer', $answer);
        }


        if ($cache->exists('topAnime')){
            $topAnime = $cache->get('topAnime');
        }else{
            $topAnime = $top->getTopAnime();
            $cache->save('topAnime', $topAnime);
        }

        $articles = [];

        if ($cache->exists('newSerii')){
            $newSerii = $cache->get('newSerii');
        }else{
            $newSerii = $anime->getNewSeria();
            $cache->save('newSerii', $newSerii);
        }

        if ($cache->exists('comments')){
            $comments = $cache->get('comments');
        }else{
            $comments = $commentDB->getCommentL(5);
            $cache->save('comments', $comments);
        }
        return $this->app->view()->fetch('sidebar.tpl.php', [
            'app' => $this->app,
            'uri' => $this->uri,
            'newSerii' => $newSerii,
            'helper' => Helper::getInstance(),
            'articles' => $articles,
            'comments' => $comments,
            'questions' => $quest,
            'answer' => $answer,
            'votedUser' => $vote,
            'topAnime' => $topAnime,
        ]);
        // TODO: Implement getSidebar() method.
    }

    protected function display()
    {
        $notifacation = new Notification();
        $menu = $this->getMenu();
        $sidebar = $this->getSidebar();
        $notifications = $notifacation->getNotifications($_SESSION['id']);
        $this->app->render($this->template, [
            'app' => $this->app,
            'uri' => $this->uri,
            'menu' => $menu,
            'sidebar' => $sidebar,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'main' => $this->main,
            'helper' => Helper::getInstance(),
            'notifications' => $notifications,

        ]);
        // TODO: Implement display() method.
    }
}
