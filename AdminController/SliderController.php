<?php


namespace AdminController;


class SliderController extends AdminController
{
    public function index(){
        $this->index = $this->app->view()->fetch('dashboard/slider.tpl.php');
        $this->display();
    }

    protected function display()
    {
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }

}