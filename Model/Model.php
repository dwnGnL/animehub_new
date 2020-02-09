<?php

namespace Model;
defined('_Sdef') or exit();

class Model
{
    public $driver;
    protected $table;

    public function __construct()
    {
        $this->driver = new \Model\Driver;
    }

    public function one($fields, array $params = [])
    {
        $where = '';
        if (!empty($params)) {
            $where = ' WHERE ';
            foreach ($params as $key => $val) {
                $where .= $key . ' = :' . $key;
            }
        }

        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . $where.' LIMIT 1';
        return $this->driver->column($sql, $params);
    }

    public function row($fields, array $params = [])
    {
        $where = '';
        if (!empty($params)) {
            $where = ' WHERE ';
            foreach ($params as $key => $val) {
                $where .= $key . ' = :' . $key;
            }
        }

        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . $where;
        return $this->driver->row($sql, $params);
    }

}

















































