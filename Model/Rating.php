<?php


namespace Model;


class Rating extends Model
{
    public function addRating($id_post,$id_user,$type){
        $sql = 'INSERT INTO lite_rating(id_post,id_user,type) VALUES (:id_post,:id_user,:pe)';
        $params  = [
            'id_post' =>$id_post,
            'id_user'=>$id_user,
            'pe'=>$type,
        ];
        $this->driver->query($sql,$params);
    }

    public function getVotedUser($id_user, $id_post){
        $sql = 'SELECT id FROM lite_rating WHERE id_user = :id_user AND id_post = :id_post';
        $params = [
            'id_user' =>$id_user,
            'id_post' =>$id_post,
        ];
        return $this->driver->column($sql,$params);
    }

    public function getLikeCount($id_post, $type){
        $sql =  'SELECT COUNT(id) AS total FROM lite_rating WHERE id_post = :id_post AND type = :type';
        $params = [
            'id_post' => $id_post,
            'type' => $type
        ];
        return  $this->driver->column($sql, $params);
    }

    public function deleteRatingPost($id_post){
        $sql = 'DELETE FROM lite_rating WHERE id_post = :id_post';
        $params = [
            'id_post' => $id_post
        ];
        return $this->driver->query($sql,$params);
    }


}