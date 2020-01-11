<?php
namespace Model;
defined('_Sdef') or exit();

class Model
{
    public $driver;

    public function __construct()
    {
        $this->driver = new \Model\Driver;
    }

}

















































