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

    public function getPages(){
        $sql = 'SELECT * FROM '.PREF.'pages';

        if($this->driver instanceof Driver){
            $result = $this->driver->row($sql);
        }
        if (!$result){
            return false;
        }

        return $result;
    }


    public function getCategories(){
        $sql = 'SELECT * FROM '.PREF.'cat';

        if($this->driver instanceof Driver){
            $result = $this->driver->row($sql);
        }
        if (!$result){
            return false;
        }

        return $result;
    }

    public function getNews(){
        $sql = 'SELECT * FROM '.PREF.'post';

        if($this->driver instanceof Driver){
            $result = $this->driver->row($sql);
        }
        if (!$result){
            return false;
        }

        return $result;
    }

    /**
     * @param $page
     * @param bool $alias
     * @return array
     */
    public function getItems($page,$alias = false){


            $params = [];
            $where = '';
            $from = '';
            $fields = '';
        if ($alias){
            $params = [
                'alias' => $alias
                ];
            $fields = 'lite_post.id, lite_type_post.title_type_post, lite_post.title, lite_post.image, lite_tv.title AS tv_title, lite_post.views ';
            $from = 'lite_post, lite_tv, lite_type_post';
            $where = 'lite_post.id_tv = lite_tv.id AND lite_type_post.id_type_post = lite_post.id_type_post AND lite_type_post.title_type_post = :alias ORDER BY date DESC';
            $sql = 'SELECT '.$fields.' 
                    FROM '.$from.'  
                    WHERE '.$where;
        }else{
            $fields = ' lite_post.id , lite_post.title, lite_post.image,lite_tv.title AS tv_title, lite_post.views ';
            $where = 'lite_post.id_tv = lite_tv.id ORDER BY date DESC';
            $from = 'lite_post, lite_tv';
            $sql = 'SELECT '.$fields.'  FROM '.$from.' WHERE '.$where;
        }



        $pager = new \Lib\Pager(
                                $page,
                                $fields,
                                $from,
                                $where,
                                QUANTITY,
                                QUANTITY_LINKS,
                                $this->driver,
                                $params
                                );

        $result = [];
        $result['items'] = $pager->get_posts();
        $result['navigation'] = $pager->render();
        return $result;

    }

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
        $sql = 'UPDATE lite_users SET ip = :ip WHERE ip = "" AND id = :id';
        $params = [
            'ip' => $ip,
            'id' => $id,
        ];

        $this->driver->query($sql,$params);
    }




}