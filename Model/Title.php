<?php


namespace Model;


class Title extends Model
{
    public function check($title){
        $sql = 'SELECT id FROM lite_title WHERE title = :title';
        $params  = [
            'title' => $title
        ];
        return $this->driver->column($sql,$params);
    }

    public function addTitle($title){
        $sql = 'INSERT INTO lite_title(title) VALUES (:title)';
        $params = [
            'title' => $title
        ];
        if ($this->driver->query($sql,$params)){
            return $this->driver->lastInsertId();
        }
        return false;
    }
}