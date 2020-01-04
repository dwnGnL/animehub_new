<?php


namespace Controller;


class ChatController extends DisplayController
{

    public function onConnect(){
        if ($_SESSION['token'] == $_POST['token']){
            $messages = $this->model->getAllMessages();
            echo json_encode(['status' => 200, 'messages' => $messages]);
        }else{
            echo ['status' => 500];
        }
    }

    public function onListener(){
        if ($_SESSION['token'] == $_POST['token']){
                $message = $this->model->getNewMessage($_POST['id_message']);
                echo json_encode(['status' => 200, 'messages' => $message]);
        }else{
            echo json_encode(['status' => 500]);
        }
    }

    public function onSave(){
        if ($_SESSION['token'] == $_POST['token']){
            if(isset($_SESSION['auth'])){
                $this->model->addMessage($_SESSION['id'], $_POST['message']);
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
       $result = $this->model->getMessages($_POST['id_chat']);
        echo json_encode(['status' => 200, 'messages' => $result]);
    }
}
