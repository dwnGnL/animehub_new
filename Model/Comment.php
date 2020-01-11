<?php


namespace Model;


class Comment extends Model
{
    public function getComments($id_post){
        $sql = 'SELECT lite_comment.body, lite_users.img, lite_status.color, lite_status.title AS status, lite_comment.date, lite_users.login, lite_vip.login_color, lite_vip.back_fon, lite_vip.vip_status, lite_vip.font
                FROM lite_comment
                LEFT JOIN lite_users ON lite_users.id = lite_comment.id_user
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                WHERE lite_comment.id_post = :id 
                ORDER BY lite_comment.date DESC';
        $params = [
            'id' => $id_post
        ];
        return  $this->driver->row($sql, $params);
    }

    public function addComment($id_post, $id_user,$body){
        $sql = 'INSERT INTO lite_comment(id_post, id_user,body, date) VALUES (:id_post,:id_user,:body,'.time().')';
        $params = [
            'id_post' => $id_post,
            'id_user' => $id_user,
            'body' => $body,
        ];

        return  $this->driver->query($sql,$params);
    }

    public function getComment($id_comment){
        $sql = 'SELECT lite_comment.body,lite_users.img, lite_status.color, lite_status.title AS status, lite_comment.date, lite_users.login, lite_vip.login_color, lite_vip.back_fon, lite_vip.vip_status, lite_vip.font
                FROM lite_comment
                LEFT JOIN lite_users ON lite_users.id = lite_comment.id_user
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                WHERE lite_comment.id = :id';
        $params = [
            'id' => $id_comment
        ];
        return  $this->driver->row($sql, $params);
    }

    public function getCommentL($lim){
        $sql = 'SELECT lite_comment.body, lite_users.img, lite_status.color, lite_status.title 
                AS status, lite_users.login, lite_vip.login_color,  lite_vip.vip_status, lite_vip.font, lite_post.id 
                as id_post, lite_post.title, lite_post.alias, lite_tv.title as tv, lite_type_post.title_type_post AS type
                FROM lite_comment
                LEFT JOIN lite_post ON lite_post.id = lite_comment.id_post
                LEFT JOIN lite_tv ON lite_tv.id = lite_post.id_tv
                LEFT JOIN lite_type_post ON lite_type_post.id_type_post = lite_post.id_type_post
                LEFT JOIN lite_users ON lite_users.id = lite_comment.id_user
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                ORDER BY lite_comment.date DESC LIMIT 5';
        $params = [
            'lim' => $lim
        ];
        return  $this->driver->row($sql,$params);
    }


}