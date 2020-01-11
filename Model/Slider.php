<?php


namespace Model;

class Slider extends Model
{
    public function getSlider(){
        $sql = 'SELECT lite_slider.img, lite_post.id, lite_post.alias FROM lite_slider, lite_post 
                WHERE lite_slider.id_post = lite_post.id';
        return $this->driver->row($sql);
    }
}