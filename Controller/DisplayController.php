<?php


namespace Controller;
use Lib\Helper;

defined('_Sdef') or  exit();

abstract  class DisplayController extends Controller
{

    protected function getSlider(){
        $slider = $this->model->getSlider();
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
        $favorites = $this->model->getCountFavorites($_SESSION['id']);
        $years = $this->model->getGodWip();
        $pages = $this->model->getPages();
        $categories = $this->model->getCategories();
        $user = $this->model->getUser($_SESSION['login']);
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
        $quest = $this->model->getQuestions();
        $answer = $this->model->getAnswers($quest['id_questions']);
        foreach ($answer as $key => $value){
            $votedUser = $this->model->getVotedUserQA($_SESSION['id'], $answer[$key]['id_answers']);
            $total = $this->model->getTotalVoted($answer[$key]['id_answers']);
            $answer[$key]['total'] = $total['total'];
            if (!empty($votedUser)){
                $vote = $votedUser;
                $answer[$key]['voted'] = $votedUser['id_voting'];
            }
        }
        $newSerii = $this->model->getNewSeria();
        $articles = $this->model->getPostL10('articles', 5);
        $comments = $this->model->getCommentL(5);
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
        ]);
        // TODO: Implement getSidebar() method.
    }
    protected function display()
    {

        $this->keywords = 'аниме, онлайн, anime, online, бесплатно, без регистрации, русская озвучка, дорамы, внутренный трафик, таджикский';
        $this->description = 'Аниме портал Таджикистана! Дорамы смотреть онлайн, полностью внутренный трафик';
        $menu = $this->getMenu();
        $sidebar = $this->getSidebar();


        $this->app->render('index.tpl.php',[
            'app' => $this->app,
            'uri' => $this->uri,
            'menu' => $menu,
            'sidebar' => $sidebar,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'main' => $this->main,
            'helper'=> Helper::getInstance(),

        ]);
        // TODO: Implement display() method.
    }
}