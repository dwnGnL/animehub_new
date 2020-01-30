<?php


namespace Model;

class Slider extends Model
{
    public function getSlider(){
        $sql = 'SELECT lite_slider.img, lite_post.id, lite_post.alias FROM lite_slider, lite_post 
                WHERE lite_slider.id_post = lite_post.id';
        return $this->driver->row($sql);
    }
    public function getSliderForDashboard($last = ''){
        $sql = 'SELECT lite_slider.id AS id_slider, lite_slider.img, lite_post.id, lite_post.alias, lite_post.title, lite_tv.title AS tv 
                FROM lite_slider, lite_post, lite_tv
                WHERE lite_slider.id_post = lite_post.id
                AND lite_tv.id = lite_post.id_tv '.$last;
        return $this->driver->row($sql);
    }

    public function updateSlide($id_post, $img, $id_slider){
        $sql = 'Update lite_slider SET id_post = :id_post, img = :img WHERE id = :id_slider';
        $params = [
            'id_post' => $id_post,
            'img' => $img,
            'id_slider' => $id_slider
        ];
        return $this->driver->query($sql,$params);
    }

    public function addSlide($id_post, $img){
        $sql = 'INSERT INTO lite_slider(id_post,img) VALUES(:id_post, :img)';
        $params = [
            'id_post' => $id_post,
            'img' => $img
        ];
        return $this->driver->query($sql, $params);
    }
    public function deleteSlide($id){
        $sql = 'DELETE FROM lite_slider WHERE id = :id';
        $params = [
            'id' => $id
        ];
        return $this->driver->query($sql,$params);
    }

}