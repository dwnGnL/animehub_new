<?php


namespace Model;


class View extends Model
{
    public function updateView($id_post){
        $sql = 'Update lite_views Set views = views + 1 WHERE id_post = :id_post';
        $params = [
            'id_post' => $id_post
        ];
        $this->driver->query($sql,$params);

    }

}