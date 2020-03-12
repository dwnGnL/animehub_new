<?php

namespace Model;
defined('_Sdef') or exit();

class Model
{
    public $driver;
    protected $table;
    protected $foreign_key;

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

    public function add(array $params = []){
        $fields = '';
        $value = '';
        $i = 0;

        foreach ($params as $key => $val){
            $i++;
            if (count($params) == $i){
                $fields .= $key;
                $value .= ':'.$key;
            }else{
                $fields .= $key.',';
                $value .= ':'.$key.',';
            }


        }
        $sql = 'INSERT INTO '.$this->table.'('.$fields.')  VALUES('.$value.') ';
        return  $this->driver->query($sql, $params);
    }
    public function update(array $fields, $where){
        $query = 'Update '.$this->table.' SET ';
        $i = 1;
        $params = [];
        foreach ($fields as $key => $val){
            if ($i == count($fields)){
                $query .= $key.' = :'.$key;
            }else{
                $query .= $key.' = :'.$key.', ';
            }
            $params[$key] = $val;
            $i++;
        }

        $query .= ' where '.$this->foreign_key.' = :id';
        $params ['id'] = $where;
        return $this->driver->query($query, $params);
    }

    public function delete($where){
        $query = 'DELETE FROM '.$this->table.' WHERE ';
        $params = [];
        $i = 1;
        if (is_array($where)){
            foreach ($where as $key => $value){
                if ($i == count($where)){
                    $query .= $key.' = :'.$key;
                }else{
                    $query .= $key.' = :'.$key.' AND ';
                }
                $params[$key] = $value;
            }
        }else{
            $query .= $this->foreign_key.' = :id';
            $params['id'] = $where;
        }
        return $this->driver->query($query,$params);
    }

}

















































