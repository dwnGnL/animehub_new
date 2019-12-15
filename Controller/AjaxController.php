<?php


namespace Controller;
defined('_Sdef') or exit();

use Lib\Helper;


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
                $this->model->saveVip('color: '.$_POST['color'], $_POST['uved'], $_POST['status'],$_POST['font'],$id_vip['id']);
                $response = 'success';
                echo json_encode($response);
                exit();
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
                   exit();
            }

        }

    }else{
            $response = ['status' => '403'];
            echo json_encode($response);
            exit();
        }
    }

    public function saveProfile(){
        if (isset($_SESSION['auth'])){
            if (hash_equals($_POST['token'],$_SESSION['token']) ){
                $this->model->saveProfile($_POST['age'],$_POST['id_pol'],$_POST['name'],$_POST['city'],$_POST['image'],$_SESSION['id']);
                $profile = $this->model->getProfile($_SESSION['id']);
                echo json_encode($profile);
                exit();
            }
        }
    }
    public function rating(){
        if (isset($_SESSION['auth'])){
            if (hash_equals($_POST['token'],$_SESSION['token']) ){

               $voted = $this->model->getVotedUser($_SESSION['id'],$_POST['id_post']);
                if (empty($voted)){
                    $this->model->addRating($_POST['id_post'], $_SESSION['id'], $_POST['type']);
                    // Если успешно
                    echo json_encode(['status' => '1']);
                    exit();
                }
                // Если проголосовал уже
                echo json_encode(['status' => '0']);
                exit();
            }
        }
        //Если не авторизован
        echo json_encode(['status' => '403']);
        exit();
    }

    public function searchAjax()
    {
        if ($_POST['token'] == $_SESSION['token']){
            if ((isset($_POST['title'] )) && (iconv_strlen(trim($_POST['title']))) > 3){
                $title = explode(' ',$_POST['title'] );
                $result = $this->model->searchAjax($title);
                foreach ($result as $key => $value){
                    $result[$key]['title'] = $result[$key]['title'].' '.$result[$key]['tv'];
                    $result[$key]['src'] ='/anime/'.Helper::renderUrl($result[$key]['id'],$result[$key]['alias']);
                }
                $result[0]['count'] = count($result);
                echo json_encode($result);
                exit();
            }
        }
        return false;
    }

    public function addVoted(){
        $error = [];
        if (isset($_SESSION['auth'])){
        if ($_POST['token'] == $_SESSION['token']){
            $voted = $this->model->votedUserQA($_SESSION['id'], $_POST['id_quest']);
            if (!empty($voted)){
                // если уже голосовал
                $error = ['status' => '500'];
            }
        }
        }else{
            $error = ['status' => '501'];
        }
        if (empty($error)){
            $this->model->addVote($_SESSION['id'], $_POST['id_answer']);
            // если успешно проголосовал
            echo json_encode(['status' => '200']);
        }else{
            // если не авторизован
           echo json_encode($error);
        }
    }

}