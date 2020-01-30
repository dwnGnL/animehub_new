<?php


namespace Model;


class Anime extends Model
{
    public function getSeria($id_tv, $title){
        $sql = 'SELECT lite_anime.id, lite_anime.src, lite_anime.seria, lite_stud.title AS stud, lite_kach.title AS kach 
        FROM lite_anime, lite_kach, lite_stud, lite_title
        WHERE lite_anime.id_stud = lite_stud.id
        AND lite_anime.id_kach = lite_kach.id
        AND lite_anime.id_title = lite_title.id
        AND lite_title.title = :title
        AND lite_anime.id_tv = :id_tv
        ORDER BY lite_anime.seria ASC';

        $params = [
            'title' => $title,
            'id_tv' => $id_tv
        ];

        return $this->driver->row($sql,$params);

    }


    public function getNewSeria(){
        $sql = 'SELECT lite_anime.seria, lite_type_post.title_type_post AS type, lite_post.id, lite_post.alias, lite_post.title, lite_anime.date, lite_tv.title AS tv
                FROM lite_title, lite_post, lite_anime, lite_tv, lite_type_post
                WHERE lite_anime.id_title = lite_title.id
                AND  lite_title.title = lite_post.title
                AND lite_tv.id = lite_post.id_tv
                AND lite_tv.id = lite_anime.id_tv
                AND lite_type_post.id_type_post = lite_post.id_type_post
                ORDER BY lite_anime.date DESC LIMIT 5';
        return  $this->driver->row($sql);
    }

    public function lastAddSeria($title_post){
        $sql = 'SELECT lite_anime.seria FROM lite_anime, lite_title 
                WHERE lite_title.id = lite_anime.id_title
                AND lite_title.title = :title ORDER BY lite_anime.id DESC LIMIT 1';
        $params = [
            'title' => $title_post
        ];
     return  $this->driver->column($sql,$params);
    }

    public function delete($id_post){
        $sql = 'DELETE FROM lite_anime WHERE lite_anime.id_title = 
                (SELECT lite_title.id FROM lite_title, lite_post 
                WHERE lite_title.title = lite_post.title AND lite_post.id = :id_post)
                AND lite_anime.id_tv = (SELECT lite_post.id_tv FROM lite_post WHERE lite_post.id = :id_post)';
        $params = [
            'id_post' => $id_post,
        ];
        return $this->driver->query($sql, $params);
    }

}