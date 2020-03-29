<?php


namespace Model;


class Chat extends Model
{
    public function getAllMessages($offset)
    {
        $sql = 'SELECT lite_chat.id_chat, lite_chat.text, lite_chat.date, lite_users.img, lite_status.color, lite_status.title 
                AS status, lite_users.login, lite_vip.login_color,  lite_vip.font
                FROM lite_chat
                LEFT JOIN lite_users ON lite_users.id = lite_chat.id_user
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                ORDER BY lite_chat.date DESC limit 25 OFFSET :offset';
        $params = [
            'offset' => $offset
        ];
        return $this->driver->row($sql, $params);
    }

    public function getNewMessage($id_chat)
    {
        $sql = 'SELECT lite_chat.id_chat, lite_chat.text, lite_chat.date, lite_users.img, lite_status.color, lite_status.title 
                AS status, lite_users.login, lite_vip.login_color,  lite_vip.font
                FROM lite_chat
                LEFT JOIN lite_users ON lite_users.id = lite_chat.id_user
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                WHERE lite_chat.id_chat = :id_chat
                ORDER BY lite_chat.date';
        $params = [
            'id_chat' => $id_chat
        ];
        return $this->driver->column($sql, $params);
    }

    public function addMessage($id_user, $message){
        $sql = 'INSERT INTO lite_chat(id_user, text) VALUES(:id_user, :message)';
        $params = [
            'id_user' => $id_user,
            'message' => $message
        ];
        $this->driver->query($sql,$params);
    }
    public function getMessages($id_chat){
        $sql = 'SELECT lite_chat.id_chat, lite_chat.text, lite_chat.date, lite_users.img, lite_status.color, lite_status.title 
                AS status, lite_users.login, lite_vip.login_color,  lite_vip.font
                FROM lite_chat
                LEFT JOIN lite_users ON lite_users.id = lite_chat.id_user
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                WHERE lite_chat.id_chat > :id_chat
                ORDER BY lite_chat.date';
        $params = [
            'id_chat' => $id_chat,
        ];

        return $this->driver->row($sql,$params);
    }

}

