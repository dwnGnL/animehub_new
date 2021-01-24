<?php


namespace Model;


class User extends Model
{

    public function getUserLoginPass($login,$password){

        $sql = 'SELECT lite_users.login,lite_status.title AS status,lite_users.id 
                FROM lite_users, lite_status 
                WHERE login = :login AND password = :password AND lite_users.status = lite_status.id';
        $params = [
            'login' => $login,
            'password' => $password,
        ];
        return $this->driver->column($sql,$params);

    }

    public function userLogin($salt, $id){
        $sql = 'Update lite_users SET salt = :salt WHERE id = :id';
        $params = [
            'salt' => $salt,
            'id' => $id,
        ];
        $this->driver->query($sql,$params);
    }

    public function updateIp($ip, $id){
        $sql = 'UPDATE lite_users SET ip = :ip WHERE id = :id';
        $params = [
            'ip' => $ip,
            'id' => $id,
        ];

        $this->driver->query($sql,$params);
    }

    public function getUser($login){
        $sql = 'SELECT lite_users.login,lite_status.title AS status, lite_users.id, lite_users.date, lite_users.age, lite_users.img, lite_users.nameUser, lite_users.city, lite_vip.login_color, lite_vip.back_fon, lite_vip.update_anime, lite_vip.vip_status, lite_vip.font, lite_pol.title AS pol
                FROM `lite_users`
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                LEFT JOIN lite_pol ON lite_pol.id = lite_users.id_pol
                LEFT JOIN lite_status ON lite_users.status = lite_status.id
                WHERE lite_users.login = :login';
        $params = [
            'login' => $login
        ];
        return $this->driver->column($sql,$params);
    }

    public function saveProfile($age, $pol,$userName, $city,$image,$id_user){
        $sql = 'Update lite_users 
                SET age = :age, id_pol = :id_pol, nameUser = :userName, city = :city, img = :image
                WHERE id = :id_user';
        $params = [
            'age'=>$age,
            'id_pol'=>$pol,
            'userName'=>$userName,
            'city' =>$city,
            'image' => $image,
            'id_user'=>$id_user
        ];
        $this->driver->query($sql,$params);
    }

    public function getProfile($id_user){
        $sql = 'SELECT lite_users.login, lite_users.nameUser, lite_users.city, lite_users.id 
                AS id_user, lite_users.img, lite_users.date, lite_users.age,  lite_status.title, lite_pol.title 
                AS pol FROM lite_users, lite_status, lite_pol 
                WHERE  lite_users.id_pol = lite_pol.id 
                AND lite_status.id = lite_users.status 
                AND lite_users.id = :id_user ';
        $params = [
            'id_user' => $id_user
        ];
        return $this->driver->column($sql,$params);
    }

    public function getCountUsersLoginOrEmail($login, $email){
        $sql = 'SELECT COUNT(*) FROM lite_users WHERE login = :login OR email = :email';
        $params = [
            'login' =>$login,
            'email' =>$email
        ];

        return $this->driver->column($sql,$params);
    }

    public function addNewUser($login,$email,$password,$date,$ip,$uri){
        $img = $uri.'templates/images/avatar/2.png';
        $query = "INSERT INTO lite_users(login, email, password, date, ip,img) VALUES(:login,:email,MD5(:password),:date,:ip,:img)";
        $params = [
            'login' =>$login,
            'email'=>$email,
            'password' =>$password,
            'date' =>$date,
            'ip' =>$ip,
            'img' =>$img
        ];

       $this->driver->query($query,$params);
    }


    public function getUsersProperties($salt, $id){
        $sql = 'SELECT lite_users.img,lite_users.id, lite_status.color, lite_status.title 
                AS status, lite_users.login, lite_vip.login_color,  lite_vip.vip_status, lite_vip.font
                FROM lite_users
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                WHERE lite_users.salt = :salt AND lite_users.id = :id';
        $params = [
            'salt' => $salt,
            'id' => $id
        ];

        return $this->driver->column($sql, $params);
    }

}
