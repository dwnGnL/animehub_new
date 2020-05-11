<?php


namespace Model;


class GodWip extends Model
{
    protected $table = 'lite_god_wip';
    protected $primary_key = 'id';

    public function getGodWip(){
        $sql = 'SELECT * FROM lite_god_wip ORDER BY lite_god_wip.title DESC';
        return $this->driver->row($sql);
    }

}