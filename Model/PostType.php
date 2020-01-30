<?php


namespace Model;


class PostType extends Model
{
    public function getPostType(){
        $sql = 'SELECT id_type_post AS id_type, title_type_post AS title_type FROM lite_type_post';
        return $this->driver->row($sql);
    }
}