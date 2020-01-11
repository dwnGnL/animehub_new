<?php


namespace Model;


class Favorite extends Model
{
    public function getCountFavorites($id){
        $sql = 'SELECT COUNT(lite_favorites.id) AS total FROM `lite_favorites` WHERE lite_favorites.id_user = :id';
        $params = [
            'id' => $id
        ];

        return $this->driver->column($sql,$params);
    }

    public function favoritePost($id_post, $id_user){
        $sql = 'SELECT id FROM lite_favorites WHERE id_post = :id_post AND id_user = :id_user';
        $params = [
            'id_post' => $id_post,
            'id_user' => $id_user
        ];

        return $this->driver->column($sql, $params);
    }

    public function addFavorite($id_post, $id_user){
        $sql = 'INSERT INTO lite_favorites(id_post, id_user) VALUES(:id_post, :id_user)';
        $params = [
            'id_post' => $id_post,
            'id_user' => $id_user
        ];
        $this->driver->query($sql,$params);
    }

    public function deleteFavorite($id_post, $id_user){
        $sql = 'DELETE FROM lite_favorites WHERE id_post = :id_post AND id_user = :id_user';
        $params = [
            'id_post' => $id_post,
            'id_user' => $id_user
        ];
        $this->driver->query($sql,$params);
    }

}