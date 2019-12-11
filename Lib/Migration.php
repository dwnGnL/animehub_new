<?php


namespace Lib;
use Model\Driver;

class Migration
{
    protected $db;
    public function __construct()
    {
        if ($this->db instanceof Driver){
            return $this->db;
        }
      return  $this->db = new Driver();
    }


    public function moveWrite($writer = [], $reader = [])
    {
        $sql = 'SELECT ';
        $keyReader = key($reader);
        $from = ' FROM '.$keyReader;
        $countReader = count($reader[$keyReader]);
        for ($i  = 0; $i < $countReader; $i++){
            if (($i + 1) == $countReader){
                $sql .= $reader[$keyReader][$i];
            }else{
                $sql .= $reader[$keyReader][$i].',';
            }
        }
        $query = $sql.$from;

        $result = $this->db->row($query);

       $table = key($writer);
        $insert = 'INSERT INTO '.$table.'(';
       for ($i = 0; $i < count($writer[$table]); $i++){
           if (($i + 1) == count($writer[$table])){
               $insert .= $writer[$table][$i].')';
           }else{
               $insert .= $writer[$table][$i].',';
           }
       }
       $insert .= ' VALUES(';
        $temp = '';
        $row = '';
       foreach ($result as $value){
            for ($i = 0; $i < $countReader; $i++){
                if (($i+ 1) == $countReader){
                    $temp .=  $value[$reader[$keyReader][$i]].')';
                }else{
                    $temp .=  $value[$reader[$keyReader][$i]].',';
                }
               $row = $insert.$temp;

            }
           $this->db->row($row);
            $temp = '';
        $row = '';
       }
    }
}

