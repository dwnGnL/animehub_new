<?php


namespace Model;
defined('_Sdef') or exit();
use PDO;
class Driver
{
    static protected $db = false;
    public function __construct()
    {
        return self::connect();

    }

   public static function connect(){
        if (self::$db instanceof \PDO){
            return self::$db;
        }

        self::$db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);

        if (self::$db->errorCode()){
            throw new \Exception("Error connection ". self::$db->errorInfo());
        }

        self::$db->exec("set names utf8");
        
        return self::$db;
   }

    public function query($sql, $params = []) {
        if (!empty($sql)){
            $stmt = self::$db->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $val) {
                    if (is_int($val)) {
                        $type = PDO::PARAM_INT;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    $stmt->bindValue(':'.$key, $val,$type);
                }
            }
            $stmt->execute();
            return $stmt;
        }

    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function lastInsertId() {
        return self::$db->lastInsertId(PDO::FETCH_ASSOC);
    }

}