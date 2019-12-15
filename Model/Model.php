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
        $sql = 'SELECT * FROM lite_pages ORDER BY order_menu';

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

    /**
     * @param $page
     * @param bool $alias
     * @return array
     */
    public function getItems($page,$route, $alias, $url = false){

        if ($url != false){
            switch ($url){
                case 'category':
                    $from = 'lite_post,lite_views, lite_tv, lite_type_post, lite_cat_post, lite_cat';
                    $where = 'lite_post.id_tv = lite_tv.id 
                            AND lite_type_post.id_type_post = lite_post.id_type_post 
                            AND lite_type_post.id_type_post = "1" 
                            AND lite_post.id = lite_cat_post.id_post
                            AND lite_views.id_post = lite_post.id 
                            AND lite_cat_post.id_cat = lite_cat.id
                            AND lite_cat.title = :alias 
                            ORDER BY lite_post.date DESC';
                    break;
                case 'year':
                    $from = 'lite_post, lite_tv,lite_views, lite_type_post, lite_god_wip';
                    $where = 'lite_post.id_tv = lite_tv.id 
                              AND lite_type_post.id_type_post = lite_post.id_type_post 
                              AND lite_views.id_post = lite_post.id 
                              AND lite_god_wip.id = lite_post.id_god_wip 
                              AND lite_god_wip.title = :alias
                              ORDER BY date DESC';
                    break;
                case 'type':
                    if ($alias == 'film'){
                        $concat = ' OR  lite_post.id_tv = lite_tv.id
                                    AND lite_type_post.id_type_post = lite_post.id_type_post
                                    AND lite_views.id_post = lite_post.id 
                                    AND lite_tv.title LIKE "%Фильм%"';
                    }
                    $from = 'lite_post, lite_tv,lite_views, lite_type_post';
                    $where = 'lite_post.id_tv = lite_tv.id
                    AND lite_views.id_post = lite_post.id 
                    AND lite_type_post.id_type_post = lite_post.id_type_post
                    AND lite_tv.title LIKE :alias '.$concat.'
                     ORDER BY date DESC';

                    $alias = '%'.$alias.'%';

            }

        }elseif ($alias == 'ongoings') {
            $from = 'lite_post, lite_tv,lite_views, lite_type_post, lite_cat_post, lite_cat';
            $where = 'lite_post.id_tv = lite_tv.id 
                            AND lite_type_post.id_type_post = lite_post.id_type_post 
                            AND lite_type_post.id_type_post = "1" 
                            AND lite_post.id = lite_cat_post.id_post
                            AND lite_views.id_post = lite_post.id 
                            AND lite_cat_post.id_cat = lite_cat.id
                            AND lite_cat.title = :alias 
                            ORDER BY lite_post.date DESC';
            $alias = 'Онгоинг';
        }else {
            $from = 'lite_post, lite_tv,lite_views, lite_type_post';
            $where = 'lite_post.id_tv = lite_tv.id
                      AND lite_views.id_post = lite_post.id 
                      AND lite_type_post.id_type_post = lite_post.id_type_post 
                      AND lite_type_post.title_type_post = :alias 
                      ORDER BY date DESC';
        }
        $fields = 'lite_post.id, lite_post.alias, lite_type_post.title_type_post, lite_post.title, lite_post.image, lite_tv.title AS tv_title, lite_views.views ';
        $params = [
            'alias' => $alias
        ];
        $sql = 'SELECT '.$fields.' 
                    FROM '.$from.'  
                    WHERE '.$where;

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

    public function getPost($id,$alias){
        $sql = 'SELECT  lite_users.id AS id_user, lite_post.id_tv As id_tv, lite_post.id AS id_post, lite_post.title, lite_post.image, lite_post.alias, lite_post.date, lite_post.body,
                lite_tv.title AS tv, lite_god_wip.title AS god, lite_users.login
                FROM lite_post, lite_god_wip, lite_tv, lite_users, lite_type_post
                WHERE lite_post.id_tv = lite_tv.id 
                AND lite_users.id = lite_post.id_user 
                AND lite_god_wip.id = lite_post.id_god_wip
                AND lite_type_post.id_type_post = lite_post.id_type_post
                AND lite_type_post.title_type_post = :alias
                AND lite_post.id = :id';
        $params = [
            'alias' => $alias,
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

    public function getCatPostL2($id_post){
        $sql = 'SELECT lite_cat.*
                FROM lite_cat, lite_cat_post
                WHERE lite_cat.id = lite_cat_post.id_cat
                AND lite_cat_post.id_post = :id LIMIT 2';
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
        $sql = 'SELECT lite_comment.body, lite_users.img, lite_status.color, lite_status.title AS status, lite_comment.date, lite_users.login, lite_vip.login_color, lite_vip.back_fon, lite_vip.vip_status, lite_vip.font
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
        $sql = 'SELECT  lite_post.id,lite_post.alias, lite_post.title, lite_post.image,lite_tv.title AS tv_title, lite_views.views
                FROM lite_post, lite_tv, lite_cat_post, lite_type_post, lite_views
                WHERE lite_post.id_tv = lite_tv.id
                AND lite_views.id_post = lite_post.id 
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

    public function getOrderPosts($title){
        $sql = 'SELECT lite_post.id, lite_post.alias, lite_post.title, lite_tv.title AS tv, lite_god_wip.title AS god
                FROM lite_post, lite_tv, lite_god_wip
                WHERE lite_post.id_tv = lite_tv.id
                AND lite_post.id_god_wip = lite_god_wip.id
                AND lite_post.title = :title
                ORDER BY lite_god_wip.title ASC';

        $params = [
            'title' =>$title
        ];

        return $this->driver->row($sql,$params);
    }

    public function getPostL10($title, $lim){
        $sql = 'SELECT lite_post.id ,lite_post.alias,lite_type_post.title_type_post, lite_post.title, lite_post.image,lite_tv.title AS tv_title, lite_views.views
                FROM lite_post, lite_tv, lite_type_post, lite_views
                WHERE lite_post.id_tv = lite_tv.id
                AND lite_views.id_post = lite_post.id 
                AND lite_type_post.id_type_post = lite_post.id_type_post
                AND lite_type_post.title_type_post = :title
                ORDER BY lite_post.date DESC LIMIT :lim';
        $params = [
            'title' => $title,
            'lim' => $lim
        ];
        return $this->driver->row($sql,$params);
    }

    public function getPostL5(){
        $sql = 'SELECT lite_post.id ,lite_post.alias, lite_post.title, lite_post.image,lite_tv.title AS tv_title, lite_views.views
                FROM lite_post, lite_tv, lite_views
                WHERE lite_post.id_tv = lite_tv.id 
                AND lite_views.id_post = lite_post.id 
                ORDER BY lite_post.id DESC LIMIT 5';

        return $this->driver->row($sql);
    }

    public function getNewSeria(){
        $sql = 'SELECT lite_anime.seria, lite_post.id, lite_post.alias, lite_post.title, lite_anime.date
                FROM lite_title, lite_post, lite_anime
                WHERE lite_title.title = lite_post.title
                AND lite_anime.id_title = lite_title.id
                ORDER BY lite_anime.date DESC LIMIT 5';
      return  $this->driver->row($sql);
    }

    public function getGodWip(){
        $sql = 'SELECT * FROM lite_god_wip ORDER BY lite_god_wip.title DESC';
        return $this->driver->row($sql);
    }

    public function addComment($id_post, $id_user,$body){
        $sql = 'INSERT INTO lite_comment(id_post, id_user,body, date) VALUES (:id_post,:id_user,:body,'.time().')';
        $params = [
            'id_post' => $id_post,
            'id_user' => $id_user,
            'body' => $body,
        ];

     return  $this->driver->query($sql,$params);
    }
    public function getComment($id_comment){
        $sql = 'SELECT lite_comment.body,lite_users.img, lite_status.color, lite_status.title AS status, lite_comment.date, lite_users.login, lite_vip.login_color, lite_vip.back_fon, lite_vip.vip_status, lite_vip.font
                FROM lite_comment
                LEFT JOIN lite_users ON lite_users.id = lite_comment.id_user
                LEFT JOIN lite_vip ON lite_vip.id_user = lite_users.id AND lite_users.status != 0
                LEFT JOIN lite_status ON lite_status.id = lite_users.status
                WHERE lite_comment.id = :id';
        $params = [
            'id' => $id_comment
        ];
        return  $this->driver->row($sql, $params);
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

    public function getIdVip($id_user){
        $sql = 'SELECT lite_vip.id FROM lite_vip WHERE lite_vip.id_user = :id_user';
        $params = [
            'id_user' =>$id_user
        ];
       return $this->driver->column($sql,$params);

    }

    public function saveVip($login_color, $uved,$vip_status,  $font, $id_vip){

        $sql = 'Update lite_vip SET login_color = :color, update_anime = :uved, vip_status = :status, font = :font 
                WHERE lite_vip.id = :id_vip';
        $params = [
            'color' => $login_color,
            'uved' =>$uved,
            'status' => $vip_status,
            'font' => $font,
            'id_vip' => $id_vip
        ];
        $this->driver->query($sql,$params);
    }

    public  function getVip($id){
        $sql = 'SELECT lite_vip.login_color AS color, lite_vip.update_anime AS uved, lite_vip.vip_status AS status, lite_vip.font AS font
                FROM lite_vip WHERE lite_vip.id = :id ';
        $params = [
            'id' => $id
        ];
        return $this->driver->column($sql,$params);
    }


    public function getSlider(){
        $sql = 'SELECT lite_slider.img, lite_post.id, lite_post.alias FROM lite_slider, lite_post 
                WHERE lite_slider.id_post = lite_post.id';
        return $this->driver->row($sql);
    }
    public function getCommentL($lim){
        $sql = 'SELECT lite_post.id, lite_post.alias, lite_post.title, lite_tv.title AS tv, lite_comment.body, lite_users.img, lite_type_post.title_type_post AS type
               FROM lite_post, lite_comment, lite_tv, lite_users, lite_type_post
               WHERE lite_post.id_tv = lite_tv.id
               AND lite_post.id = lite_comment.id_post
               AND lite_users.id = lite_comment.id_user
               AND lite_type_post.id_type_post = lite_post.id_type_post
               ORDER BY lite_comment.date DESC LIMIT :lim';
        $params = [
            'lim' => $lim
        ];
     return  $this->driver->row($sql,$params);
    }

    public function addRating($id_post,$id_user,$type){
        $sql = 'INSERT INTO lite_rating(id_post,id_user,type) VALUES (:id_post,:id_user,:pe)';
        $params  = [
            'id_post' =>$id_post,
            'id_user'=>$id_user,
            'pe'=>$type,
        ];
         $this->driver->query($sql,$params);
    }
    public function getVotedUser($id_user, $id_post){
        $sql = 'SELECT id FROM lite_rating WHERE id_user = :id_user AND id_post = :id_post';
        $params = [
            'id_user' =>$id_user,
            'id_post' =>$id_post,
        ];
        return $this->driver->column($sql,$params);
    }

    public function getLikeCount($id_post, $type){
      $sql =  'SELECT COUNT(id) AS total FROM lite_rating WHERE id_post = :id_post AND type = :type';
        $params = [
            'id_post' => $id_post,
            'type' => $type
        ];
      return  $this->driver->column($sql, $params);
    }

    public function searchAjax($search){
        $sql = '';
        $params = [];
        foreach ($search as $key => $val){
            if ($key == 0){
                $and = '';
            }else{
                $and = ' AND ';
            }
            $sql .= $and.'lite_post.id_tv = lite_tv.id AND CONCAT(lite_post.title, lite_post.alias, lite_tv.title) LIKE :'.$key;
            $params[$key] = '%'.$val.'%';
        }
        $insert = 'SELECT lite_post.title, lite_tv.title AS tv, lite_post.id, lite_post.alias, lite_post.image AS img FROM lite_post, lite_tv
                  WHERE  '.$sql.' LIMIT 5';
        return $this->driver->row($insert,$params);
    }

    public function search($search){
        $sql = '';
        $params = [];
        if (is_array($search)){


        foreach ($search as $key => $val){
            if ($key == 0){
                $and = '';
            }else{
                $and = ' AND ';
            }
            $sql .= $and.'lite_post.id_tv = lite_tv.id
                    AND lite_views.id_post = lite_post.id 
                    AND lite_type_post.id_type_post = lite_post.id_type_post
                 	AND CONCAT(lite_post.title, lite_post.alias, lite_tv.title) LIKE :'.$key;
            $params[$key] = '%'.$val.'%';
        }
        }else{
            $sql .= 'lite_post.id_tv = lite_tv.id
                    AND lite_views.id_post = lite_post.id 
                    AND lite_type_post.id_type_post = lite_post.id_type_post
                 	AND CONCAT(lite_post.title, lite_post.alias, lite_tv.title) LIKE :var';
            $params['var'] = '%'.$search.'%';
        }

        $insert = 'SELECT lite_post.id ,lite_post.alias, lite_post.title,lite_type_post.title_type_post, lite_post.image,lite_tv.title AS tv_title, lite_views.views 
                   FROM lite_post, lite_tv, lite_type_post, lite_views
                   WHERE '.$sql.' ORDER BY lite_post.date DESC LIMIT 28';

        return $this->driver->row($insert,$params);
    }

    public function updateView($id_post){
        $sql = 'Update lite_views Set views = views + 1 WHERE id_post = :id_post';
        $params = [
            'id_post' => $id_post
        ];
        $this->driver->query($sql,$params);

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

    public function addQuestion($title){
        $sql = 'INSERT INTO lite_questions(title_questions) VALUES(:title)';
        $params = [
            'title' =>$title
        ];

        $this->driver->query($sql,$params);
        return $this->driver->lastInsertId();
    }

    public function addAnswers($id_question, $title){
        $sql = 'INSERT INTO lite_answers(id_questions, title_answers) VALUES(:id,:title)';
        $params = [
            'id' => $id_question,
            'title' =>$title
        ];

        $this->driver->query($sql,$params);
    }
    public function getVotedUserQA($id_user, $id_answer){
        $sql = 'SELECT id_voting FROM lite_voting WHERE id_user = :id_user AND id_answer = :id_answer';
        $params = [
            'id_user' =>$id_user,
            'id_answer' =>$id_answer
        ];
        return $this->driver->column($sql,$params);
    }
    public function votedUserQA($id_user,$id_questions){
        $sql = 'SELECT lite_voting.id_voting FROM lite_voting, lite_answers WHERE lite_voting.id_answer = lite_answers.id_answers AND lite_answers.id_questions = :id_quest AND lite_answers.id_user = :id_user';
        $params = [
            'id_quest' =>$id_questions,
            'id_user' => $id_user
        ];

        return $this->driver->column($sql,$params);
    }
    public function addVote($id_user, $id_answer){
        $sql = 'INSERT INTO lite_voting(id_user, id_answer) VALUES(:id_user,:id_answer)';
        $params = [
            'id_user' =>$id_user,
            'id_answer' => $id_answer
        ];
        $this->driver->query($sql,$params);
    }

    public function getQuestions(){
        $sql = 'SELECT id_questions, title_questions FROM lite_questions ORDER BY RAND() LIMIT 1';
        return  $this->driver->column($sql);
    }

    public function getAnswers($id_quest){
        $sql = 'SELECT title_answers, id_answers FROM lite_answers WHERE id_questions = :id';
        $params = [
            'id' => $id_quest
        ];
       return $this->driver->row($sql,$params);
    }

    public function getTotalVoted($id){
        $sql = 'SELECT COUNT(id_answer) AS total FROM lite_voting WHERE id_answer = :id';
        $params = [
            'id' => $id
        ];
        return $this->driver->column($sql,$params);
    }


}
