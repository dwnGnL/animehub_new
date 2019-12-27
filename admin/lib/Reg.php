<?php

require_once '../config.php';

 class Reg  {

     private $pdo;
     public function __construct()
     {
         try{
             $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
             $this->pdo->exec("set names utf8");
         }catch (Exception $e){
             echo 'Ошибка при подключении бд';
         }
     }
     public function addNewUser($login, $email, $password){
         $time = time();
         $query = 'INSERT INTO lite_users(login, email, password, date) VALUES(?,?,MD5(?),?)';
         $users = $this->pdo->prepare($query);
         return $users->execute([$login,$email,$password,$time]);
     }


     public function getCountUsersLoginOrEmail($login, $email){
         $query = 'SELECT COUNT(*) FROM lite_users WHERE login = ? OR email = ?';
         $users = $this->pdo->prepare($query);
         $users->execute([$login,$email]);
         return $users->fetch(PDO::FETCH_ASSOC);
     }
     public function findUser($login){
         $query = 'SELECT * FROM lite_users WHERE login = ?';
         $users = $this->pdo->prepare($query);
         $users->execute([$login]);
         return $users->fetch(PDO::FETCH_ASSOC);
     }

     public function findUserRemeber($login, $key){
         $query = 'SELECT * FROM lite_users WHERE login = ? and salt = ?';
         $users = $this->pdo->prepare($query);
         $users->execute([$login, $key]);
         return $users->fetch(PDO::FETCH_ASSOC);
     }

     public function updateViews($id_post){
         $query = 'UPDATE lite_post SET views = views + 1 WHERE id = ?';
         $views = $this->pdo->prepare($query);
         return $views->execute([$id_post]);

     }
     public function updateSalt($salt,$login){
         $query = 'Update lite_users SET salt = ? WHERE login = ?';
         $user = $this->pdo->prepare($query);
         return $user->execute([$salt, $login]);
     }

     public function updateIp($ip, $login){
         $query = 'UPDATE lite_users SET ip = ? WHERE ip = "0" and login = ?';
         $user = $this->pdo->prepare($query);
         return $user->execute([$ip,$login]);
     }



 }
?>
