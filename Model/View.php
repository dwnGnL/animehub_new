<?php


namespace Model;


class View extends Model
{
    protected $table = 'lite_views';
    protected $primary_key = 'id';
    public function updateView($id_post){
        $sql = 'Update lite_views Set views = views + 1 WHERE id_post = :id_post';
        $params = [
            'id_post' => $id_post
        ];
        $this->driver->query($sql,$params);

    }

    public function deleteViewsPost($id_post){
        $sql = 'DELETE FROM lite_views WHERE id_post = :id_post';
        $params = [
            'id_post' => $id_post
        ];
        return $this->driver->query($sql,$params);
    }

}