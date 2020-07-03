<?php


namespace Controller;


use Model\Chat;

class ChatController extends DisplayController
{

    public function onConnect()
    {
        $chat = new Chat();
        $offset = $_POST['page'] * 25;
        $messages = $chat->getAllMessages($offset);
        echo json_encode(['status' => 200, 'messages' => $messages]);
    }

    public function onListener()
    {
        if ($_SESSION['id_message'] != $_POST['id_message']) {
            $chat = new Chat();
            $message = $chat->getNewMessage($_POST['id_message']);
            $_SESSION['id_message'] = $message['id_chat'];
            echo json_encode(['status' => 200, 'messages' => $message]);
            exit();
        }
    }

    public function onSave()
    {
        $chat = new Chat();
        $message = $this->clearMessage($_POST['message']);
        if (!empty($message)){
            $chat->addMessage($_SESSION['id'], $message);
            echo json_encode(['status' => 200]);
            exit();
        }
        exit();
    }

    public function onMessage()
    {
        $chat = new Chat();
        $result = $chat->getMessages($_POST['id_chat']);
        echo json_encode(['status' => 200, 'messages' => $result]);
    }
}
