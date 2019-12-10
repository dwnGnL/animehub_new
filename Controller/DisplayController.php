<?php


namespace Controller;
use Lib\Helper;

defined('_Sdef') or  exit();

abstract  class DisplayController extends Controller
{

    protected function getMenu()
    {
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
                                                            ]);


        // TODO: Implement getMenu() method.
    }

    protected function getSidebar()
    {
        $newSerii = $this->model->getNewSeria();
        $articles = $this->model->getPostL10('articles', 5);
        $comments = $this->model->getCommentL(5);

        return $this->app->view()->fetch('sidebar.tpl.php', [
            'app' => $this->app,
            'uri' => $this->uri,
            'newSerii' => $newSerii,
            'helper' => Helper::getInstance(),
            'articles' => $articles,
            'comments' => $comments
        ]);
        // TODO: Implement getSidebar() method.
    }
    protected function display()
    {

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
            'helper' => Helper::getInstance(),
        ]);

        // TODO: Implement display() method.
    }
}