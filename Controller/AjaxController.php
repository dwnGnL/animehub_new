<?php


namespace Controller;


use Lib\Helper;
use function FastRoute\TestFixtures\empty_options_cached;

class AjaxController extends DisplayController
{
    public function execute($param = [])
    {
        echo 'Hello World';
    }

    public function like(){

    }

    public function addComment()
    {
        if (isset($_SESSION['auth'])){
        if (isset($_POST['comment'])){
            $post = $_POST['comment'];
            if(hash_equals($post['token'],$_SESSION['token'] ))
               if (!empty(trim($post['body'])) && !empty(trim($post['id_post'])) ){
                   $this->model->addComment($post['id_post'],$_SESSION['id'],$post['body']);
                   $id_comment = $this->model->driver->lastInsertId();
                   $response = $this->model->getComment($id_comment);
                   $response[0]['date'] = Helper::getWatch($response['0']['date']);
                   echo json_encode($response[0]);
            }

        }

    }else{
            $response = ['status' => '403'];
            echo json_encode($response);
        }
    }
}