<?php


namespace Model;


class Stud extends Model
{
    public function getStud($title){
        $sql = 'SELECT lite_stud.title FROM lite_stud, lite_title, lite_anime
                WHERE lite_stud.id = lite_anime.id_stud
                AND lite_anime.id_title = lite_title.id
                AND lite_title.title = :title
                GROUP BY lite_stud.title';
        $params = [
            'title' => $title
        ];

      return  $this->driver->row($sql,$params);
    }
}