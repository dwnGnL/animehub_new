<?php


namespace Model;


class Parse extends Model
{
    protected $table = 'lite_parse';


    public function getParseWithTitle($title){
        $sql = 'SELECT date, id, title FROM lite_parse WHERE title LIKE :title';
        $params = [
            'title' => '%'.$title.'%'
        ];
        return $this->driver->row($sql, $params);
    }
    public function Update($id, $title){
        $sql = 'DELETE FROM lite_parse WHERE status = 1 AND id != :id AND title LIKE :title';
        $params = [
            'id' => $id,
            'title' => '%'.$title.'%'
        ];
        return $this->driver->query($sql,$params);
    }
    public function getParseSorte($title){
        $sql = 'SELECT lite_parse.title, lite_parse.id FROM lite_parse WHERE lite_parse.title LIKE :title AND status = 1';
        $params = [
            'title' => '%'.$title.'%'
        ];
        return $this->driver->row($sql,$params);
    }

    public function getParseSorteView($title){
        $sql = 'SELECT lite_parse.title, lite_parse.id FROM lite_parse WHERE lite_parse.title LIKE :title';
        $params = [
            'title' => '%'.$title.'%'
        ];
        return $this->driver->row($sql,$params);
    }

    public function deleteSort($id_parse){
        $sql = 'DELETE FROM lite_parse WHERE id = :id_parse';
        $params = [
            'id_parse' => $id_parse
        ];
        return $this->driver->query($sql,$params);
    }

    public function excessCheckAnime($rlyPath){
        $sql = 'SELECT id FROM lite_parse WHERE  rly_path = :rlyPath';
        $params = [
            'rlyPath' => $rlyPath
        ];
        return $this->driver->column($sql,$params);

    }

    public function DeleteParseBeforeInsert($title){
        $sql1 = 'SELECT id FROM lite_parse WHERE title LIKE :title and status = "1" LIMIT 1';
        $params = [
            'title' => '%'.$title.'%'
        ];
        $id = $this->driver->column($sql1,$params);
        $sql = 'DELETE FROM lite_parse WHERE id = '.$id['id'];

        return $this->driver->query($sql,$params);
    }

    public function updateAnimeStatusFirst($rlyPath){
        $sql = 'UPDATE lite_parse set status = 0 WHERE rly_path = :rlyPath and status = "1"';
        $params = [
            'rlyPath' => $rlyPath
        ];
        return $this->driver->query($sql,$params);
    }
    public function deleteAnimeExcess($rlyPath){
        $sql = 'DELETE FROM lite_parse WHERE rly_path = :rlyPath';
        $params = [
            'rlyPath' => $rlyPath
        ];
        return $this->driver->query($sql,$params);

    }

    public function getParseStatus1($title){
        $sql = 'SELECT id, date, rly_path FROM lite_parse WHERE title LIKE :title LIMIT 1';
        $params = [
            'title' => '%'.$title.'%',
        ];
        return $this->driver->column($sql, $params);
    }
    public function insertParse($rly_path, $title, $src, $size, $date, $status = 0){
        $sql = 'INSERT INTO lite_parse (rly_path, title, src, size, date, status) VALUES(:rlyPath,:title,:src,:size,:date,:status)';
        $params = [
            'rlyPath' => $rly_path,
            'title' => $title,
            'src' => $src,
            'size' => $size,
            'date' => $date,
            'status' => $status
        ];
        return $this->driver->query($sql,$params);
    }

    public function getParseAnime($title){
        $sql = 'SELECT id, src, size, rly_path FROM `lite_parse` WHERE title LIKE :title';
        $params = [
            'title' => '%'.$title.'%'
        ];
        return $this->driver->row($sql,$params);
    }

    public function deleteParseRdy($title){
        $sql = 'DELETE FROM lite_parse WHERE title LIKE :title and status = "0"';
        $params = [
            'title' => '%'.$title.'%'
        ];
        return $this->driver->query($sql,$params);

    }

}