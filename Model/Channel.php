<?php


namespace Model;


class Channel extends Model
{
    public function getChannels(){
        $sql = 'SELECT title FROM lite_channel';
        return $this->driver->row($sql);
    }
}