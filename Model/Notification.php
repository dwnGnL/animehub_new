<?php


namespace Model;


class Notification extends  Model
{

    public function getNotifications($id_user){
        $sql = 'SELECT lite_uved_id_user.view, lite_uved_id_user.id_nag AS id, lite_uved.title, lite_uved.date, lite_uved.description, lite_users.login 
                FROM lite_uved, lite_uved_id_user, lite_users
                WHERE lite_uved_id_user.id_uved = lite_uved.id
                AND lite_users.id = lite_uved.id_author
                AND lite_uved_id_user.id_user = :id_user
                ORDER BY date DESC';
        $params = [
            'id_user' => $id_user
        ];
        return $this->driver->row($sql, $params);
    }

    public function deleteNotification($id_user, $id_uved){
        $sql = 'DELETE FROM lite_uved_id_user 
                WHERE lite_uved_id_user.id_user = :id_user 
                AND lite_uved_id_user.id_nag = :id_uved';
        $params = [
            'id_user' => $id_user,
            'id_uved' => $id_uved
        ];
        $this->driver->query($sql,$params);
    }

    public function deleteNotifications($id_user){
        $sql = 'DELETE FROM lite_uved_id_user 
                WHERE lite_uved_id_user.id_user = :id_user ';
        $params = [
            'id_user' => $id_user,
        ];
        $this->driver->query($sql,$params);
    }
    public function updateViewNotification($id_not, $id_user){
        $sql = 'UPDATE lite_uved_id_user SET view = 1 WHERE id_nag = :id_nag AND id_user = :id_user';
        $params = [
            'id_nag' => $id_not,
            'id_user' => $id_user
        ];
        $this->driver->query($sql,$params);
    }


}