<?php


namespace Controller;


use Model\Chat;

class ChatController extends DisplayController
{

    public function onConnect(){
            $chat = new Chat();
            $messages = $chat->getAllMessages();
            echo json_encode(['status' => 200, 'messages' => $messages]);
    }

    public function onListener(){
                if ($_SESSION['id_message'] != $_POST['id_message']){
                    $chat = new Chat();
                    $message = $chat->getNewMessage($_POST['id_message']);
                    $_SESSION['id_message'] = $message['id_chat'];
                    echo json_encode(['status' => 200, 'messages' => $message]);
                    exit();
                }
    }

    public function onSave(){
                $chat = new Chat();
                $chat->addMessage($_SESSION['id'], $_POST['message']);
                echo json_encode(['status' => 200]);
                exit();
    }

    public function onMessage(){
        $chat = new Chat();
       $result = $chat->getMessages($_POST['id_chat']);
        echo json_encode(['status' => 200, 'messages' => $result]);
    }
}
