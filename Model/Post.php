<?php


namespace Model;


class Post extends Model
{

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
        }elseif ($alias == 'favorites') {
            $from = 'lite_post, lite_tv,lite_views, lite_type_post, lite_favorites';
            $where = 'lite_post.id = lite_favorites.id_post
                        AND lite_post.id = lite_views.id_post
                        AND lite_post.id_tv = lite_tv.id
                        AND lite_post.id_type_post = lite_type_post.id_type_post
                        AND lite_favorites.id_user = :alias';
            $alias = $_SESSION['id'];
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
                AND lite_post.id_type_post = 1
                AND lite_views.id_post = lite_post.id 
                ORDER BY lite_post.id DESC LIMIT 5';

        return $this->driver->row($sql);
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
            $sql .= $and.'lite_type_post.id_type_post = lite_post.id_type_post AND lite_post.id_tv = lite_tv.id AND CONCAT(lite_post.title, lite_post.alias, lite_tv.title) LIKE :'.$key;
            $params[$key] = '%'.$val.'%';
        }
        $insert = 'SELECT lite_post.title,lite_type_post.title_type_post AS type, lite_tv.title AS tv, lite_post.id, lite_post.alias, lite_post.image AS img FROM lite_type_post, lite_post, lite_tv
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







}