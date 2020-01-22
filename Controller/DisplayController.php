<?php


namespace Controller;
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

defined('_Sdef') or  exit();

abstract  class DisplayController extends Controller
{

    protected $template = 'index.tpl.php';
    protected function getSlider(){
        $db = new Slider();
        $slider = $db->getSlider();
        return $this->app->view()->fetch('slider.tpl.php',[
            'slider' => $slider,
            'uri' => $this->uri,
            'helper' => Helper::getInstance(),
        ]);
    }

    protected function getSearch(){
       return $this->app->view()->fetch('search.tpl.php') ;
    }


    protected function getMenu()
    {
        $fav = new Favorite();
        $godWip = new GodWip();
        $post = new Post();
        $cat = new Cat();
        $userDB = new User();
        $favorites = $fav->getCountFavorites($_SESSION['id']);
        $years = $godWip->getGodWip();
        $pages = $post->getPages();
        $categories = $cat->getCategories();
        $user = $userDB->getUser($_SESSION['login']);
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
        $quest = $question->getQuestions();
        $answer = $answerDB->getAnswers($quest['id_questions']);
        foreach ($answer as $key => $value){
            $votedUser = $voteDB->getVotedUserQA($_SESSION['id'], $answer[$key]['id_answers']);
            $total = $voteDB->getTotalVoted($answer[$key]['id_answers']);
            $answer[$key]['total'] = $total['total'];
            if (!empty($votedUser)){
                $vote = $votedUser;
                $answer[$key]['voted'] = $votedUser['id_voting'];
            }
        }
        $topAnime = $top->getTopAnime();
        $newSerii = $anime->getNewSeria();
        $articles = $post->getPostL10('articles', 5);
        $comments = $commentDB->getCommentL(5);
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
        $this->keywords = 'аниме, онлайн, anime, online, бесплатно, без регистрации, русская озвучка, дорамы, внутренный трафик, таджикский';
        $this->description = 'Аниме портал Таджикистана! Дорамы смотреть онлайн, полностью внутренный трафик';
        $menu = $this->getMenu();
        $sidebar = $this->getSidebar();
        $notifications = $notifacation->getNotifications($_SESSION['id']);
        $this->app->render($this->template,[
            'app' => $this->app,
            'uri' => $this->uri,
            'menu' => $menu,
            'sidebar' => $sidebar,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'main' => $this->main,
            'helper'=> Helper::getInstance(),
            'notifications' => $notifications,

        ]);
        // TODO: Implement display() method.
    }
}