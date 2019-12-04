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
    public function getItems($page,$route, $alias = false){


            $params = [];
            $where = '';
            $from = '';
            $fields = '';
        if ($alias){
            $params = [
                'alias' => $alias
                ];
            $fields = 'lite_post.id, lite_post.alias, lite_type_post.title_type_post, lite_post.title, lite_post.image, lite_tv.title AS tv_title, lite_post.views ';
            $from = 'lite_post, lite_tv, lite_type_post';
            $where = 'lite_post.id_tv = lite_tv.id AND lite_type_post.id_type_post = lite_post.id_type_post AND lite_type_post.title_type_post = :alias ORDER BY date DESC';
            $sql = 'SELECT '.$fields.' 
                    FROM '.$from.'  
                    WHERE '.$where;
        }else{
            $fields = 'lite_post.id ,lite_post.alias, lite_post.title, lite_post.image,lite_tv.title AS tv_title, lite_post.views ';
            $where = 'lite_post.id_tv = lite_tv.id ORDER BY date DESC';
            $from = 'lite_post, lite_tv';
            $sql = 'SELECT '.$fields.'  FROM '.$from.' WHERE '.$where;
        }



        $pager = new \Lib\Pager(
                                $fields,
                                $from,
                                $where,
                                $page,
                                $params,
                                QUANTITY,
                                QUANTITY_LINKS,
                                $this->driver
                                );

        $result = [];
        $result['items'] = $pager->get_posts();
        $result['navigation'] = $pager->render($route);
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

    public function getPost($id){
        $sql = 'SELECT  lite_users.id AS id_user, lite_post.id_tv As id_tv, lite_post.id AS id_post, lite_post.title, lite_post.image, lite_post.alias, lite_post.date, lite_post.body,
                lite_tv.title AS tv, lite_god_wip.title AS god, lite_users.login
                FROM lite_post, lite_god_wip, lite_tv, lite_users
                WHERE lite_post.id_tv = lite_tv.id 
                AND lite_users.id = lite_post.id_user 
                AND lite_god_wip.id = lite_post.id_god_wip
                AND lite_post.id = :id';
        $params = [
            'id' => $id
        ];
      return $this->driver->column($sql,$params);
    }

    public function getCatPost($id_post){
        $sql = 'SELECT lite_cat.*
                FROM lite_cat, lite_cat_post
                WHERE lite_cat.id = lite_cat_post.id_cat
                AND lite_cat_post.id_post = :id';
        $params = [
            'id' =>$id_post
        ];
     return  $this->driver->row($sql,$params);
    }

    public function getSeria($id_tv, $title){
        $sql = 'SELECT lite_anime.id, lite_anime.src, lite_anime.seria, lite_stud.title AS stud, lite_kach.title AS kach 
        FROM lite_anime, lite_kach, lite_stud, lite_title
        WHERE lite_anime.id_stud = lite_stud.id
        AND lite_anime.id_kach = lite_kach.id
        AND lite_anime.id_title = lite_title.id
        AND lite_title.title = :title
        AND lite_anime.id_tv = :id_tv
        ORDER BY lite_anime.seria ASC';

        $params = [
            'title' => $title,
            'id_tv' => $id_tv
        ];

       return $this->driver->row($sql,$params);

    }

    public function getComments($id_post){
        $sql = 'SELECT lite_comment.body,lite_status.color, lite_status.title AS status, lite_comment.date, lite_users.login, lite_vip.login_color, lite_vip.back_fon, lite_vip.vip_status, lite_vip.font
                FROM lite_comment
                LEFT JOIN lite_users ON lite_users.id = lite_comment.id_user
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                WHERE lite_comment.id_post = :id 
                ORDER BY lite_comment.date DESC';
        $params = [
            'id' => $id_post
        ];
      return  $this->driver->row($sql, $params);
    }

    public function getSimilarPosts($cat, $alias, $id){
        $sql = 'SELECT  lite_post.id,lite_post.alias, lite_post.title, lite_post.image,lite_tv.title AS tv_title, lite_post.views
                FROM lite_post, lite_tv, lite_cat_post, lite_type_post
                WHERE lite_post.id_tv = lite_tv.id
                AND lite_cat_post.id_post = lite_post.id
                AND lite_cat_post.id_cat = :cat
                AND lite_post.id_type_post =lite_type_post.id_type_post
                AND lite_type_post.title_type_post = :alias
                AND lite_post.id != :id
                ORDER BY lite_post.date DESC LIMIT 5';
        $params = [
            'cat' => $cat,
            'alias' => $alias,
            'id' => $id,
        ];

     return  $this->driver->row($sql,$params);
    }

}