<?php


namespace Model;


class Cat extends Model
{
    protected $table = 'table';
    protected $primary_key = 'id';
    public function getCategories(){
        $sql = 'SELECT * FROM lite_cat ORDER BY title ASC';

        if($this->driver instanceof Driver){
            $result = $this->driver->row($sql);
        }
        if (!$result){
            return false;
        }

        return $result;
    }

    public function getCatPost($id_post){
        $sql = 'SELECT lite_cat.*
                FROM lite_cat, lite_cat_post
                WHERE lite_cat.id = lite_cat_post.id_cat
                AND lite_cat_post.id_post = :id';
        $params = [
            'id' =>$id_post
        ];
        return  $this->driver->row($sql,$params);
    }

    public function getCatPostL2($id_post){
        $sql = 'SELECT lite_cat.*
                FROM lite_cat, lite_cat_post
                WHERE lite_cat.id = lite_cat_post.id_cat
                AND lite_cat_post.id_post = :id LIMIT 2';
        $params = [
            'id' =>$id_post
        ];
        return  $this->driver->row($sql,$params);
    }
    public function deleteCatPost($id_post){
        $sql = 'DELETE FROM lite_cat_post WHERE id_post = :id_post';
        $params = [
            'id_post' => $id_post
        ];
        return $this->driver->query($sql, $params);
    }


}