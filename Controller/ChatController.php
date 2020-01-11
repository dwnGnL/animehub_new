<?php


namespace Controller;


use Model\Chat;

class ChatController extends DisplayController
{

    public function onConnect(){
        if ($_SESSION['token'] == $_POST['token']){
            $chat = new Chat();
            $messages = $chat->getAllMessages();
            echo json_encode(['status' => 200, 'messages' => $messages]);
        }else{
            echo ['status' => 500];
        }
    }

    public function onListener(){
        if ($_SESSION['token'] == $_POST['token']){
                if ($_SESSION['id_message'] != $_POST['id_message']){
                    $chat = new Chat();
                    $message = $chat->getNewMessage($_POST['id_message']);
                    $_SESSION['id_message'] = $message['id_chat'];
                    echo json_encode(['status' => 200, 'messages' => $message]);
                    exit();
                }
        }else{
            echo json_encode(['status' => 500]);
        }
    }

    public function onSave(){
        if ($_SESSION['token'] == $_POST['token']){
            if(isset($_SESSION['auth'])){
                $chat = new Chat();
                $chat->addMessage($_SESSION['id'], $_POST['message']);
                echo json_encode(['status' => 200]);
                exit();
            }
            echo json_encode(['status' => 501]);
            exit();
        }
        echo json_encode(['status' => 500]);
        exit();
    }

    public function onMessage(){
        $chat = new Chat();
       $result = $chat->getMessages($_POST['id_chat']);
        echo json_encode(['status' => 200, 'messages' => $result]);
    }
}
