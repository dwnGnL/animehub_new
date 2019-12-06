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
        $posts = $this->model->getNews();
        return $this->app->view()->fetch('menu.tpl.php', [
                                                        'pages' => $pages,
                                                        'app' => $this->app,
                                                        'uri' => $this->uri,
                                                        'categories' => $categories,
                                                        'years' => $years,
                                                            ]);


        // TODO: Implement getMenu() method.
    }

    protected function getSidebar()
    {
        $newSerii = $this->model->getNewSeria();

        return $this->app->view()->fetch('sidebar.tpl.php', [
            'app' => $this->app,
            'uri' => $this->uri,
            'newSerii' => $newSerii,
            'helper' => Helper::getInstance(),
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
        ]);

        // TODO: Implement display() method.
    }
}