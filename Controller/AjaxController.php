<?php


namespace Controller;


use Lib\Helper;
use function FastRoute\TestFixtures\empty_options_cached;

class AjaxController extends DisplayController
{

    public function saveVip(){
        if (isset($_SESSION['auth'])){
            if (hash_equals($_POST['token'],$_SESSION['token']) ){

                $id_vip =  $this->model->getIdVip($_SESSION['id']);
                if ($_POST['uved'] == 'false'){
                    $_POST['uved'] = 0;
                }else{
                    $_POST['uved'] = 1;
                }
                $this->model->saveVip($_POST['color'], $_POST['uved'], $_POST['status'],$_POST['font'],$id_vip);
                $response = 'success';
                echo json_encode($response);
            }
        }
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

    public function saveProfile(){
        if (isset($_SESSION['auth'])){
            if (hash_equals($_POST['token'],$_SESSION['token']) ){
                $this->model->saveProfile($_POST['age'],$_POST['id_pol'],$_POST['name'],$_POST['city'],$_POST['image'],$_SESSION['id']);
                $profile = $this->model->getProfile($_SESSION['id']);
                echo json_encode($profile);
            }
        }
    }

}