<?php


namespace Model;


class Top extends Model
{
    public function getTopAnime(){
        $sql = 'SELECT lite_top.rating, lite_post.image, lite_post.alias, lite_post.id, lite_post.title, lite_tv.title AS tv 
                FROM lite_post, lite_top, lite_tv 
                WHERE lite_post.id = lite_top.id_post 
                AND lite_tv.id = lite_post.id_tv ORDER BY lite_top.rating DESC LIMIT 5';
      return  $this->driver->row($sql);
    }
}