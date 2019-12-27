<?php

declare(strict_types = 1);
namespace server;
require_once 'DataInterface.php';
require_once '../../config.php';


/*
* Сделал небольшую обертку для запросов.
* Здесь так же пишутся в лог события. Обертку можно еще сильно доработать :)
*/

class MySql implements \Server\DataInterface, \Server\LoggerInterface
{
    private $db;
    private $dbname;
    private $user;
    private $password;

    public function __construct($config)
    {
        try {
            $this->db = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8");
            return $this->connect = true;
        } catch(\PDOException $e) {
            return $this->connect = false;
        }
    }

/*
* Запрос для пинга в базу
*
*/
    public function ping() : string
    {
        if ($this->connect) {
            try {
                $ping = $this->db->query('SELECT 1');
                $ping->setFetchMode(\PDO::FETCH_ASSOC);
                if ($ping->fetch()) {
                    return 'Запрос к Mysql был отправлен (ПИНГ).</br>';
                }
            } catch(\PDOException $e) {
                    return 'Во время пинга Mysql возникла ошибка: '. $e->getMessage().'</br>';
            }
        } else {
            return 'Подключение к Mysql не установлено.';
        }

    }

/*
* Сохранение данных.
*
*/
    public function save($table, $arrayFields, $arrayValues)
    {
        if ($this->connect) {
            $fieldString = implode(',', $arrayFields); // превращаем массив в строку

            array_walk($arrayFields, function (&$arr) {
                $arr = ':'.$arr;
            });

            $valueString = implode(',', $arrayFields);

            try {
                $stmt = $this->db->prepare("INSERT INTO $table ($fieldString) VALUES ($valueString)");
                foreach ($arrayFields as $key => $value1) {
                    $stmt->bindParam($arrayFields[$key], $arrayValues[$key]);
                }
                $stmt->execute();
                return 'Сообщение сохранено в Mysql.</br>';
            } catch(\PDOException $e) {
                return 'Во время записи в Mysql произошла ошибка: '. $e->getMessage().'</br>';
            }
        } else {
            return 'Подключение к Mysql не установлено.';
        }
    }

/*
* Выборка из БД
*
*
*/
    public function select($table, $field, $join = NULL,  $where = NULL, $value = NULL)
    {
        if ($this->connect) {
            try {
                if (is_array($field)) {
                    $field = implode(',', $field); // превращаем массив в строку
                }

                $stmt = "SELECT $field FROM $table ";

                if ($join != NULL) {
                    $stmt.= "LEFT JOIN $join";
                }

                if ($where != NULL and $value != NULL) {
                    $stmt.= "WHERE $where = ?";
                }

                $stmt = $this->db->prepare($stmt);
                $stmt->bindValue(1, $value);

                $stmt->execute();
                $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                return $rows;
            } catch(\PDOException $e) {
                return 'Во время запроса в Mysql произошла ошибка: '. $e->getMessage().'</br>';
            }
        } else {
            return 'Подключение к Mysql не установлено.';
        }
    }

    public function getAllMessages(){
        $sql = 'SELECT lite_chat.text, lite_chat.date, lite_users.img, lite_status.color, lite_status.title 
                AS status, lite_users.login, lite_vip.login_color,  lite_vip.font
                FROM lite_chat
                LEFT JOIN lite_users ON lite_users.id = lite_chat.id_user
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                ORDER BY lite_chat.date';
        $messages =  $this->db->query($sql);
        return $messages->fetchAll(\PDO::FETCH_ASSOC);
    }
}