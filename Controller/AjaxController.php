<?php


namespace Controller;
defined('_Sdef') or exit();

use Lib\Cache;
use Lib\Helper;
use Model\Comment;
use Model\Favorite;
use Model\Notification;
use Model\Post;
use Model\Product;
use Model\Rating;
use Model\User;
use Model\Vip;
use Model\Vote;


class AjaxController extends DisplayController
{

    public function saveVip(){
                $vip = new Vip();
                $id_vip =  $vip->getIdVip($_SESSION['id']);
                if ($_POST['uved'] == 'false'){
                    $_POST['uved'] = 0;
                }else{
                    $_POST['uved'] = 1;
                }
                $vip->saveVip('color: '.$_POST['color'], $_POST['uved'], $_POST['status'],$_POST['font'],$id_vip['id'], $_POST['back_fon']);
                $response = 'success';
                echo json_encode($response);
                exit();
    }

    public function addComment()
    {
        if (isset($_POST['comment'])){
            $post = $_POST['comment'];
               if (!empty(trim($post['body'])) && !empty(trim($post['id_post'])) ){
                   $comment = new Comment();
                   $comment->addComment($post['id_post'],$_SESSION['id'],$this->clearMessage($post['body']));
                   $id_comment = $comment->driver->lastInsertId();
                   $response = $comment->getComment($id_comment);
                   $response[0]['date'] = Helper::getWatch($response['0']['date']);
                   $cache = new Cache();
                   $cache->delete('comments');
                   echo json_encode($response[0]);
                   exit();
            }
        }
    }


    public function saveProfile(){
                $user = new User();
                $user->saveProfile($_POST['age'],$_POST['id_pol'],$_POST['name'],$_POST['city'],$_SESSION['id']);
                $profile = $user->getProfile($_SESSION['id']);
                echo json_encode($profile);
                exit();
    }
    public function rating(){
                $rating = new Rating();
               $voted = $rating->getVotedUser($_SESSION['id'],$_POST['id_post']);
                if (empty($voted)){
                    $rating->addRating($_POST['id_post'], $_SESSION['id'], $_POST['type']);
                    // Если успешно
                    echo json_encode(['status' => '1']);
                    exit();
                }
                // Если проголосовал уже
                echo json_encode(['status' => '0']);
                exit();
    }

    public function searchAjax()
    {
            if ((isset($_POST['title'] )) && (iconv_strlen(trim($_POST['title']))) > 3){
                    $post = new Post();
                    $title = explode(' ', $_POST['title']);
                    $result = $post->searchAjax($title);
                    foreach ($result as $key => $value) {
                        $result[$key]['onlyTitle'] = $result[$key]['title'];
                        $result[$key]['onlyTv'] = $result[$key]['tv'];
                        $result[$key]['title'] = $result[$key]['title'] . ' ' . $result[$key]['tv'];
                        $result[$key]['src'] = '/' . $result[$key]['type'] . '/' . Helper::renderUrl($result[$key]['id'], $result[$key]['alias']);
                    }
                    $result[0]['count'] = count($result);
                    echo json_encode($result);
                    exit();
                }
        return false;
    }

    public function addVoted(){
        $error = [];
        $voteDB = new Vote();
            $voted = $voteDB->votedUserQA($_SESSION['id'], $_POST['id_quest']);
            if (!empty($voted)){
                // если уже голосовал
                $error = ['status' => '500'];
            }

        if (empty($error)){
            $voteDB->addVote($_SESSION['id'], $_POST['id_answer']);
            // если успешно проголосовал
            echo json_encode(['status' => '200']);
        }else{
            // если не авторизован
           echo json_encode($error);
        }
    }

    public function addFavPost(){
            $favorite = new Favorite();
          $fav =  $favorite->favoritePost($_POST['id_post'], $_SESSION['id']);
          if (empty($fav)){
                $favorite->addFavorite($_POST['id_post'], $_SESSION['id']);
                echo  json_encode(['status' => '200']);
          }
    }

    public function deleteFavPost(){
                $favorite = new Favorite();
                $fav =  $favorite->favoritePost($_POST['id_post'], $_SESSION['id']);
                if (!empty($fav)){
                    $favorite->deleteFavorite($_POST['id_post'], $_SESSION['id']);
                    echo  json_encode(['status' => '200']);
                }
    }

    public function deleteNotification(){
                $not = new Notification();
                    if ($_POST['type'] == 1){
                        $not->deleteNotification($_SESSION['id'],$_POST['id_not']);
                        echo json_encode(['status' => 200]);
                    }else{
                        $not->deleteNotifications($_SESSION['id']);
                        echo json_encode(['status' => 200]);
                    }
    }
    public function updateNot()
    {
                $not = new Notification();
                $not->updateViewNotification($_POST['id_not'], $_SESSION['id']);
                echo json_encode(['status' => 200]);
    }
}
