<?php


namespace AdminController;

use Controller\Controller;
use Lib\Helper;

abstract class AdminController extends Controller
{

    protected $template = 'dashboard/layout/dashboard.tpl.php';


    protected function display()
    {

        $menu = $this->getMenu();
        $sidebar = $this->getSidebar();
        $this->main = $this->index;
        $this->app->render($this->template,[
            'app' => $this->app,
            'uri' => $this->uri,
            'nav' => $menu,
            'sidebar' => $sidebar,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'main' => $this->main,
            'helper'=> Helper::getInstance(),


        ]);

    }
    protected function getMenu()
    {
        return $this->app->view()->fetch('dashboard/nav.tpl.php', [

            'uri' => $this->uri,

        ]);
    }

    protected function getSidebar()
    {
        return $this->app->view()->fetch('dashboard/sidebar.tpl.php',[
            'app' => $this->app,
            'uri' => $this->uri
        ]);
    }


}