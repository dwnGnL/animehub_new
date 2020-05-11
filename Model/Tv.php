<?php
namespace Model;


class Tv extends Model
{
    protected $table = 'lite_tv';
    protected $primary_key = 'id';

    public function check($title){
        $sql = 'SELECT id FROM lite_tv WHERE title = :title';
        $params  = [
            'title' => $title
        ];
        return $this->driver->column($sql,$params);
    }

    public function addTitle($title){
        $sql = 'INSERT INTO lite_tv(title) VALUES (:title)';
        $params = [
            'title' => $title
        ];
        if ($this->driver->query($sql,$params)){
            return $this->driver->lastInsertId();
        }
        return false;
    }
}