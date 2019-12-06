<?php


namespace Controller;


class AjaxController extends DisplayController
{
    public function execute($param = [])
    {
        echo 'Hello World';
    }

    public function addComment()
    {
            $comment = json_decode($this->app->request->post('comment'));
        if ($_SESSION['token'] == $comment('token')) {
            if (!empty($this->app->request->post('comment'))) {

                $this->model->addComment($comment['id_post'], $_SESSION['id'], $comment['body']);

            }

        }
    }
}