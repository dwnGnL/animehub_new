<?php
require_once 'BD_info.php';

    Class Model
    {
        private $pdo;

        public function __construct()
        {
            try {
                $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
                $this->pdo->exec("set names utf8");
            } catch (Exception $e) {
                echo 'Ошибка при подключении бд';
            }
        }

        public function getTitleNonAlias(){
            $query = 'SELECT lite_post.id, lite_post.title, lite_tv.title AS tv FROM lite_post, lite_tv 
                      WHERE lite_post.id_tv = lite_tv.id AND lite_post.alias = "" ';
            $post =   $this->pdo->query($query);
            return $post->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateAlias($alias, $id){
            $query = 'Update lite_post SET alias = ? WHERE id = ?';
            $post = $this->pdo->prepare($query);
            return $post->execute([$alias,$id]);

        }



        public function getGo($dat){
            $query = 'INSERT INTO test(data) VALUES (?)';
            $data = $this->pdo->prepare($query);
            return  $data->execute([$dat]);

        }

        //Аякс поиск

        public function searchAnime($title){
            $query = 'SELECT * FROM lite_post WHERE title LIKE ?';
            $select = $this->pdo->prepare($query);
            $select->execute(["%$title%"]);
            return $select->fetchAll(PDO::FETCH_ASSOC);

        }

        public function removeParseSer($id_parse){
            $query = 'Delete from lite_parse WHERE id = ?';
            $parse = $this->pdo->prepare($query);
            return $parse->execute([$id_parse]);
        }

        public function getAutoPlayChange($id){
            $query = 'SELECT player FROM lite_users WHERE id = ?';
            $player = $this->pdo->prepare($query);
            $player->execute([$id]);
            return $player->fetch(PDO::FETCH_ASSOC);
        }
        public function autoPlayChange($change, $id){
            $query = 'Update lite_users SET player = ? WHERE id = ?';
            $users = $this->pdo->prepare($query);
           return $users->execute([$change,$id]);

        }
         public function clearChat(){
            $query = 'TRUNCATE TABLE lite_chat';
            $chat = $this->pdo->query($query);
            return $chat->execute();
    }
        public function deleteRaspisanie($id){
            $query = 'DELETE FROM lite_raspisanie WHERE id = ?';
            $den = $this->pdo->prepare($query);
            return $den->execute([$id]);
        }

        public function getPonedelnik(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "1"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getVtornik(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "2"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getSreda(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "3"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getChetverg(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "4"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getPyatnisa(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "5"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getSubbota(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "6"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getVoskresenie(){
            $query = 'SELECT * FROM lite_raspisanie WHERE id_den = "7"';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addRaspisanie($id_den, $title_anime){
            $query = 'INSERT INTO lite_raspisanie(id_den, title_anime) VALUES(?,?)';
            $ras = $this->pdo->prepare($query);
            return $ras->execute([$id_den,$title_anime]);

        }
        public function getDen(){
            $query = 'Select * FROM lite_den';
            $den = $this->pdo->query($query);
            return $den->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateTech($number){
            $query = 'UPDATE lite_tech SET tech = ? WHERE id = "1"';
            $tech = $this->pdo->prepare($query);
            return $tech->execute([$number]);
        }

        public function updateViews($id_post)
        {
            $query = 'Update lite_post Set views = views + 1 WHERE id = ?';
            $post = $this->pdo->prepare($query);
            return $post->execute([$id_post]);
        }

        public function updateViewsNews($id_news)
        {
            $query = 'Update lite_news Set views = views + 1 WHERE id = ?';
            $post = $this->pdo->prepare($query);
            return $post->execute([$id_news]);
        }

        public function deleteParseWhithLink($rly_path){
            $query = 'Delete from lite_parse WHERE rly_path = ?';
            $link = $this->pdo->prepare($query);
            return $link->execute([$rly_path]);
        }
        public function insertParse($rly_path, $title, $src, $size, $date)
        {
            $query = 'INSERT INTO lite_parse (rly_path, title, src, size, date ) VALUES(?,?,?,?,?)';
            $post = $this->pdo->prepare($query);
            return $post->execute(array($rly_path,$title, $src, $size, $date));
        }

        public function insertParseFirst($rly_path, $title, $src, $size, $date, $status)
        {
            $query = 'INSERT INTO lite_parse (rly_path, title, src, size, date, status) VALUES(?,?,?,?,?,?)';
            $post = $this->pdo->prepare($query);
            return $post->execute(array($rly_path,$title, $src, $size, $date, $status));
        }

        public function selectDate($title)
        {
            $query = 'SELECT date FROM lite_parse WHERE title LiKE ? ORDER BY id ASC;';
            $select = $this->pdo->prepare($query);
            $select->execute(["%$title%"]);
            return $select->fetch(PDO::FETCH_ASSOC);
        }

        public function addAnime($rly_path, $id_stud, $id_kach, $id_tv, $id_title, $src, $seria, $mix_title, $img)
        {
            $query = 'INSERT INTO lite_anime(rly_path,id_stud,id_kach, id_tv, id_title, src, seria, mix_title, img)VALUES (?,?,?,?,?,?,?,?,?)';
            $anime = $this->pdo->prepare($query);
            return $anime->execute(array($rly_path, $id_stud, $id_kach, $id_tv, $id_title, $src, $seria, $mix_title, $img));

        }

        public function getAnimeSrc($name)
        {
            $query = 'SELECT * FROM lite_anime WHERE name LIKE ?';
            $animesrc = $this->pdo->prepare($query);
            $animesrc->execute(["%$name%"]);
            return $animesrc->fetchAll(PDO::FETCH_ASSOC);

        }

        public function addTitleAnime($title)
        {
            $query = 'INSERT INTO lite_title(title) VALUES (?)';
            $title = $this->pdo->prepare($query);
            return $title->execute([$title]);
        }


        public function getAnimeForSort($title)
        {
            $query = 'SELECT * FROM lite_parse WHERE title LIKE ? ORDER BY id ASC';
            $animesrc = $this->pdo->prepare($query);
            $animesrc->execute(["%$title%"]);
            return $animesrc->fetchAll(PDO::FETCH_ASSOC);
        }

        ///////// Модель Базы данных для добавление в поста //////////

        public function proExistsPost($id)
        {
            $query = 'SELECT COUNT(*) FROM lite_post WHERE id = ?';
            $post = $this->pdo->prepare($query);
            $post->execute([$id]);
            return $post->fetch(PDO::FETCH_ASSOC);
        }

        public function proExistsNews($id)
        {
            $query = 'SELECT COUNT(*) FROM lite_news WHERE id = ?';
            $post = $this->pdo->prepare($query);
            $post->execute([$id]);
            return $post->fetch(PDO::FETCH_ASSOC);
        }

        public function addPrichinaForPost($prichina, $title, $id_tv)
        {
            $query = 'UPDATE lite_post SET prichina = ? WHERE title = ? and id_tv = ?';
            $post = $this->pdo->prepare($query);
            return $post->execute([$prichina, $title, $id_tv]);
        }

        public function updateTimePost($title, $id_tv)
        {
            $time = time();
            $query = 'UPDATE lite_post SET date = ? WHERE title = ? and id_tv = ?';
            $post = $this->pdo->prepare($query);
            return $post->execute([$time, $title, $id_tv]);
        }

        public function addPostCat($id_post, $id_cat)
        {
            $query = 'INSERT INTO lite_cat_post(id_post, id_cat) VALUES (?,?)';
            $catPost = $this->pdo->prepare($query);
            return $catPost->execute([$id_post, $id_cat]);
        }

        public function deletePostCat($id_post)
        {
            $query = 'Delete FROM lite_cat_post WHERE id_post = ?';
            $catPost = $this->pdo->prepare($query);
            return $catPost->execute([$id_post]);

        }

        public function addPost($id_god_wip, $image, $title, $body, $id_tv, $id_user,$id_type_post)
        {
            $time = time();
            $query = 'INSERT INTO lite_post(id_god_wip, image, title, date, body, id_tv, id_user,id_type_post) VALUES(?,?,?,?,?,?,?,?)';
            $post = $this->pdo->prepare($query);
            return $post->execute([$id_god_wip, $image, $title, $time, $body, $id_tv, $id_user, $id_type_post]);
        }

        public function getUserId($login)
        {
            $query = 'Select id from lite_users where login = ?';
            $user = $this->pdo->prepare($query);
            $user->execute([$login]);
            return $user->fetch(PDO::FETCH_ASSOC);
        }

        // Обновление поста
        public function updateEditPost($id_god_wip, $image, $title, $body, $id_tv, $prichina, $id, $id_type)
        {
            $query = 'UPDATE lite_post SET id_god_wip = ?, image=?, title=?, body=?, id_tv=?, prichina = ?, id_type = ? WHERE id = ?';
            $post = $this->pdo->prepare($query);
            return $post->execute([$id_god_wip, $image, $title, $body, $id_tv, $prichina, $id_type, $id]);
        }

        public function updatePostCat($id_post, $id_cat, $id)
        {
            $query = 'Update lite_cat_post SET id_post=?, id_cat=? WHERE id = ?';
            $catPost = $this->pdo->prepare($query);
            return $catPost->execute([$id_post, $id_cat]);
        }


        public function getIdPostCat($id_post, $id_cat)
        {
            $query = 'SELECT id FROM lite_cat_post WHERE id_post = ? and id_cat = ?';
            $post = $this->pdo->prepare($query);
            $post->execute([$id_post, $id_cat]);
            return $post->fetch(PDO::FETCH_ASSOC);
        }

//////////////////////////////////////////////////////////////////////////////
    public function getIdPost($title, $id_tv)
    {
        $query = 'SELECT id FROM lite_post WHERE title = ? and id_tv = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$title, $id_tv]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function proCatExists($cat)
    {
        $query = 'SELECT COUNT(*) FROM lite_cat WHERE title = ?';
        $catcount = $this->pdo->prepare($query);
        $catcount->execute([$cat]);
        return $catcount->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdCat($tv)
    {
        $query = 'SELECT id FROM lite_cat WHERE title = ?';
        $tvid = $this->pdo->prepare($query);
        $tvid->execute([$tv]);
        return $tvid->fetch(PDO::FETCH_ASSOC);
    }

    public function addIdCat($tv)
    {
        $query = 'INSERT INTO lite_cat(title) VALUES(?)';
        $addtv = $this->pdo->prepare($query);
        return $addtv->execute([$tv]);

    }

    public function proGodExists($cat)
    {
        $query = 'SELECT COUNT(*) FROM lite_god_wip WHERE title = ?';
        $catcount = $this->pdo->prepare($query);
        $catcount->execute([$cat]);
        return $catcount->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdGod($tv)
    {
        $query = 'SELECT id FROM lite_god_wip WHERE title = ?';
        $tvid = $this->pdo->prepare($query);
        $tvid->execute([$tv]);
        return $tvid->fetch(PDO::FETCH_ASSOC);
    }

    public function addIdGod($tv)
    {
        $query = 'INSERT INTO lite_god_wip(title) VALUES(?)';
        $addtv = $this->pdo->prepare($query);
        return $addtv->execute([$tv]);

    }

    //////////////////////////////////////////////////////////////

    public function proTvExists($tv)
    {
        $query = 'SELECT COUNT(*) FROM lite_tv WHERE title = ?';
        $tvcount = $this->pdo->prepare($query);
        $tvcount->execute([$tv]);
        return $tvcount->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdTv($tv)
    {
        $query = 'SELECT id FROM lite_tv WHERE title = ?';
        $tvid = $this->pdo->prepare($query);
        $tvid->execute([$tv]);
        return $tvid->fetch(PDO::FETCH_ASSOC);
    }

    public function addIdTv($tv)
    {
        $query = 'INSERT INTO lite_tv(title) VALUES(?)';
        $addtv = $this->pdo->prepare($query);
        return $addtv->execute([$tv]);

    }


    public function proTitleExists($title)
    {
        $query = 'SELECT COUNT(*) FROM lite_title WHERE title = ?';
        $titleCount = $this->pdo->prepare($query);
        $titleCount->execute([$title]);
        return $titleCount->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdTitle($title)
    {
        $query = 'SELECT id FROM lite_title WHERE title = ?';
        $titleId = $this->pdo->prepare($query);
        $titleId->execute([$title]);
        return $titleId->fetch(PDO::FETCH_ASSOC);
    }

    public function addIdTitle($title)
    {
        $query = 'INSERT INTO lite_title(title) VALUES(?)';
        $addtitle = $this->pdo->prepare($query);
        return $addtitle->execute([$title]);

    }


    public function checkTotalAnime($anime)
    {
        $query = 'SELECT COUNT(*) FROM lite_parse WHERE title LIKE ?';
        $total = $this->pdo->prepare($query);
        $total->execute(["%$anime%"]);
        return $total->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteAnimeExcess($src)
    {
        $query = 'DELETE FROM lite_parse WHERE title = ? and status = "0"';
        $excess = $this->pdo->prepare($query);
        return $excess->execute([$src]);
    }

    public function deleteAnimeExcessWithTitle($title)
    {
        $query = 'DELETE FROM lite_parse WHERE title LIKE ? and status = "0"';
        $excess = $this->pdo->prepare($query);
        return $excess->execute(["%$title%"]);
    }
    public function deleteAnimeTvM(){
            $query = 'DELETE FROM `lite_anime` WHERE id_tv = "80"';
            return $del = $this->pdo->query($query);
    }
    public function updateAnimeStatusFirst($date)
    {
        $query = 'UPDATE lite_parse set status = 0 WHERE date LIKE ? and status = "1"';
        $excess = $this->pdo->prepare($query);
        return $excess->execute(["%$date%"]);
    }


    public function updateAnimeStatusFirstChannel($title)
    {
        $query = 'UPDATE lite_parse set status = 0 WHERE title LIKE ? and status = "1"';
        $excess = $this->pdo->prepare($query);
        return $excess->execute(["%$title%"]);
    }

    public function excessCheckAnime($rly_path)
    {
        $query = 'SELECT COUNT(*) FROM lite_parse WHERE  rly_path = ?';
        $total = $this->pdo->prepare($query);
        $total->execute( [$rly_path]);
        return $total->fetch(PDO::FETCH_ASSOC);
    }

    public function getPost($limit, $offset)
    {
        $query = 'Select * from lite_post ORDER BY date DESC LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $limit, PDO::PARAM_INT);
        $post->bindParam(2, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getTypePost($id)
    {
        $query = 'SELECT * FROM lite_type WHERE id = ?';
        $type = $this->pdo->prepare($query);
        $type->execute([$id]);
        return $type->fetch(PDO::FETCH_ASSOC);
    }

    public function getPostViews($type_post,$limit, $offset)
    {
        $query = 'Select * from lite_post WHERE id_type_post = ? ORDER BY views DESC LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $type_post, PDO::PARAM_STR);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPostForSlider($limit)
    {
        $query = 'SELECT lite_post.id, lite_post.title, lite_tv.title AS tv FROM lite_cat_post, lite_cat, lite_post, lite_tv WHERE lite_tv.id = lite_post.id_tv and lite_post.id = lite_cat_post.id_post and lite_cat_post.id_cat = lite_cat.id AND lite_cat.title = "Онгоинг" ORDER  BY lite_post.views DESC Limit ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $limit, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);


    }


    public function getCountPostForPageNavigation($id_type_post)
    {
        $query = 'SELECT COUNT(*) FROM lite_post WHERE id_type_post = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_type_post]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountPostForPageNavigationAll()
    {
        $query = 'SELECT COUNT(*) FROM lite_post';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }
    public function getCountPostProstoy()
    {
        $query = 'SELECT COUNT(*) FROM lite_post';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountNewsForPageNavigation()
    {
        $query = 'SELECT COUNT(*) FROM lite_news';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function searchCountPostForPageNavigation($title)
    {
        $query = 'SELECT COUNT(*) FROM lite_post where title LIKE ?';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%"]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }
    public function searchCountNewsForPageNavigation($title)
    {
        $query = 'SELECT COUNT(*) FROM lite_news where title LIKE ?';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%"]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }


    public function getCountUserPostForPageNavigation($id_user)
    {
        $query = 'SELECT COUNT(*) FROM lite_post WHERE id_user = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_user]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountUserNewsForPageNavigation($id_user)
    {
        $query = 'SELECT COUNT(*) FROM lite_news WHERE id_user = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_user]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function searchCountUserPostForPageNavigation($id_user, $title)
    {
        $query = 'SELECT COUNT(*) FROM lite_post WHERE id_user = ? and title LIKE ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_user, "%$title%"]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function searchCountUserNewsForPageNavigation($id_user, $title)
    {
        $query = 'SELECT COUNT(*) FROM lite_news WHERE id_user = ? and title LIKE ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_user, "%$title%"]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }


    public function getCountCommentsForPageNavigation()
    {
        $query = 'SELECT COUNT(*) FROM lite_comment';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getPostForIdModer($id,$id_user)
    {
        $query = 'Select * from lite_post where id = ? AND id_user = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id,$id_user]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }
    public function getPostForId($id)
    {
        $query = 'Select * from lite_post where id = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }


    public function getPostTv($id_tv)
    {
        $query = 'Select * from lite_tv where id = ?';
        $tv = $this->pdo->prepare($query);
        $tv->execute([$id_tv]);
        return $tv->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserForId($id_user)
    {
        $query = 'Select login from lite_users where id = ?';
        $tv = $this->pdo->prepare($query);
        $tv->execute([$id_user]);
        return $tv->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFromUserUpdate($id_post)
    {
        $query = 'UPDATE lite_post SET id_user_update = "0" WHERE id = ?';
        $tv = $this->pdo->prepare($query);
        return $tv->execute([$id_post]);
    }

    public function getCatPost($id)
    {
        $query = 'Select * from lite_cat_post where id_post = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCat($id)
    {
        $query = 'Select * from lite_cat where id = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getGodWip($id)
    {
        $query = 'Select * from lite_god_wip where id = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getKach($id)
    {
        $query = 'Select * from lite_kach where id = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getStud($id)
    {
        $query = 'Select * from lite_stud where id = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllAnimeForWatch($id_stud, $id_kach, $id_title, $id_tv)
    {
        $query = 'SELECT * FROM lite_anime WHERE lite_anime.id_stud = ? and lite_anime.id_kach = ? and lite_anime.id_title = ? and lite_anime.id_tv = ? ORDER BY seria ASC';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_stud, $id_kach, $id_title, $id_tv]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllAnimeForWatchNotStud($id_kach, $id_title, $id_tv)
    {
        $query = 'SELECT * FROM lite_anime WHERE lite_anime.id_kach = ? and lite_anime.id_title = ? and lite_anime.id_tv = ? ORDER BY seria ASC';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_kach, $id_title, $id_tv]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAnimeForWatchNotKach($id_Stud, $id_title, $id_tv)
    {
        $query = 'SELECT * FROM lite_anime WHERE lite_anime.id_stud = ? and lite_anime.id_title = ? and lite_anime.id_tv = ? ORDER BY seria ASC';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_Stud, $id_title, $id_tv]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAnimeForWatchNotAll($id_title, $id_tv)
    {
        $query = 'SELECT * FROM lite_anime WHERE lite_anime.id_title = ? and lite_anime.id_tv = ? ORDER BY seria ASC';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_title, $id_tv]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostForSearch($title, $limit, $offset)
    {
        $query = 'Select * from lite_post WHERE title LIKE ? LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $title = '%' . $title . '%';
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $title, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostForCat($title, $limit, $offset)
    {
        $query = 'Select lite_post.id, lite_post.title, lite_cat.title AS cat, lite_post.id_god_wip, lite_post.image, lite_post.body, lite_post.id_tv, lite_post.rating, lite_post.id_user, lite_post.id_user_update, lite_post.id_type, lite_post.prichina  from lite_cat, lite_post, lite_cat_post WHERE lite_post.id = lite_cat_post.id_post AND lite_cat.id = lite_cat_post.id_cat and lite_cat.title = ? LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $title, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountForSearch($title)
    {
        $query = 'Select COUNT(*) from lite_post WHERE title LIKE ?';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%"]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountForCat($title)
    {
        $query = 'Select COUNT(*) from lite_post, lite_cat, lite_cat_post WHERE lite_post.id = lite_cat_post.id_post AND lite_cat.id = lite_cat_post.id_cat and lite_cat.title = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$title]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }


    // Плейр

    public function getSrcAnimeForWatch($id_stud, $id_kach, $id_title, $id_tv, $seria)
    {
        $query = 'SELECT * FROM lite_anime WHERE lite_anime.id_stud = ? and lite_anime.id_kach = ? and lite_anime.id_title = ? and lite_anime.id_tv = ? and lite_anime.seria = ? ORDER BY seria ASC';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_stud, $id_kach, $id_title, $id_tv, $seria]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getSeriaSrcAnime($id){
            $query = 'SELECT src FROM lite_anime WHERE id = ?';
            $seria = $this->pdo->prepare($query);
            $seria->execute([$id]);
            return $seria->fetch(PDO::FETCH_ASSOC);
    }

    public function getSrcAnimeForWatchNotStud($id_kach, $id_title, $id_tv, $seria)
    {
        $query = 'SELECT * FROM lite_anime WHERE lite_anime.id_kach = ? and lite_anime.id_title = ? and lite_anime.id_tv = ? and lite_anime.seria = ? ORDER BY seria ASC';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_kach, $id_title, $id_tv, $seria]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    // Comment This
    public function addComment($id_post, $id_user, $body, $date)
    {
        $query = 'INSERT INTO lite_comment(id_post, id_user,body, date) VALUES (?,?,?,?)';
        $comment = $this->pdo->prepare($query);
        return $comment->execute([$id_post, $id_user, $body, $date]);

    }

    public function addCommentForNews($id_news, $id_user, $body, $date)
    {
        $query = 'INSERT INTO lite_comment(id_news, id_user,body, date) VALUES (?,?,?,?)';
        $comment = $this->pdo->prepare($query);
        return $comment->execute([$id_news, $id_user, $body, $date]);

    }
    public function getComment($id_post, $id_user)
    {
        $query = 'SELECT lite_users.login, lite_comment.body, lite_comment.date FROM lite_users, lite_comment, lite_post WHERE lite_comment.id_user = lite_users.id AND lite_comment.id_post = lite_post.id AND lite_comment.id_post = ? AND lite_comment.id_user = ?';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post, $id_user]);
        return $comment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentAll($id_post)
    {
        $query = 'SELECT lite_users.login, lite_users.id AS id_user, lite_users.img, lite_users.status, lite_status.title, lite_comment.body, lite_comment.date FROM lite_users, lite_comment, lite_post, lite_status WHERE lite_status.id = lite_users.status AND lite_comment.id_user = lite_users.id AND lite_comment.id_post = lite_post.id AND lite_comment.id_post = ? ORDER BY lite_comment.id DESC';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVipka($id_user){
            $query = 'Select * from lite_vip WHERE lite_vip.id_user = ?';
            $user = $this->pdo->prepare($query);
            $user->execute([$id_user]);
            return $user->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommentAllForNews($id_post)
    {
        $query = 'SELECT lite_users.login, lite_users.id AS id_user, lite_users.img, lite_users.status, lite_status.title, lite_comment.body, lite_comment.date FROM  lite_users, lite_comment, lite_news, lite_status WHERE  lite_status.id = lite_users.status AND lite_comment.id_user = lite_users.id AND lite_comment.id_news = lite_news.id AND lite_comment.id_news = ? ORDER BY lite_comment.id DESC';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentOne($id_post)
    {
        $query = 'SELECT lite_users.login, lite_users.img, lite_comment.body, lite_status.title,lite_users.status, lite_comment.date FROM lite_users, lite_comment, lite_status, lite_post WHERE lite_users.status = lite_status.id AND lite_comment.id_user = lite_users.id AND lite_comment.id_post = lite_post.id AND lite_comment.id_post = ? ORDER BY lite_comment.id DESC';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetch(PDO::FETCH_ASSOC);
    }
    public function getCommentOneVip($id_post)
    {
        $query = 'SELECT lite_users.login,lite_vip.vip_status, lite_vip.login_color, lite_vip.back_fon, lite_users.img, lite_comment.body, lite_status.title,lite_users.status, lite_comment.date FROM lite_vip, lite_users, lite_comment, lite_status, lite_post WHERE lite_vip.id_user = lite_users.id AND lite_users.status = lite_status.id AND lite_comment.id_user = lite_users.id AND lite_comment.id_post = lite_post.id AND lite_comment.id_post = ? ORDER BY lite_comment.id DESC';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommentOneNews($id_post)
    {
        $query = 'SELECT lite_users.login, lite_users.img, lite_comment.body, lite_status.title,lite_users.status, lite_comment.date FROM lite_users, lite_comment, lite_status, lite_news WHERE  lite_users.status = lite_status.id AND lite_comment.id_user = lite_users.id AND lite_comment.id_news = lite_news.id AND lite_comment.id_news = ? ORDER BY lite_comment.id DESC';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetch(PDO::FETCH_ASSOC);
    }
    public function getCommentOneForNews($id_news)
    {
        $query = 'SELECT lite_users.login,lite_vip.login_color, lite_vip.back_fon, lite_users.img, lite_comment.body,lite_status.title, lite_users.status, lite_comment.date FROM lite_vip, lite_users, lite_comment, lite_status, lite_news WHERE lite_vip.id_user = lite_user.id AND lite_users.status = lite_status.id AND lite_comment.id_user = lite_users.id AND lite_comment.id_news = lite_news.id AND lite_comment.id_news = ? ORDER BY lite_comment.id DESC';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_news]);
        return $comment->fetch(PDO::FETCH_ASSOC);
    }

    // like this

    public function addRating($id_post, $id_user, $type)
    {
        $query = 'INSERT INTO lite_rating(id_post, id_user, type) VALUES (?,?,?);';
        $rating = $this->pdo->prepare($query);
        return $rating->execute([$id_post, $id_user, $type]);
    }

    public function proVotedUser($id_post, $id_user)
    {
        $query = 'SELECT COUNT(*) FROM lite_rating WHERE id_post = ? AND id_user = ?';
        $rating = $this->pdo->prepare($query);
        $rating->execute([$id_post, $id_user]);
        return $rating->fetch(PDO::FETCH_ASSOC);
    }

    public function getLikeRating($id_post)
    {
        $query = 'SELECT COUNT(*) FROM lite_rating WHERE id_post = ? AND type = "1";';
        $rating = $this->pdo->prepare($query);
        $rating->execute([$id_post]);
        return $rating->fetch(PDO::FETCH_ASSOC);
    }

    public function getDisLikeRating($id_post)
    {
        $query = 'SELECT COUNT(*) FROM lite_rating WHERE id_post = ? AND type = "0";';
        $rating = $this->pdo->prepare($query);
        $rating->execute([$id_post]);
        return $rating->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRating($id, $rating)
    {
        $query = 'UPDATE lite_post SET rating = ? WHERE id = ?';
        $update = $this->pdo->prepare($query);
        return $update->execute([$rating, $id]);

    }

    // Для редоктирование и удаление поста

    public function getAllPostForViews($limit, $offset)
    {
        $query = 'SELECT lite_post.id, lite_post.title, lite_tv.title AS tv, lite_post.views, lite_post.rating, lite_post.date FROM lite_post, lite_tv WHERE lite_post.id_tv = lite_tv.id ORDER BY lite_post.date DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $limit, PDO::PARAM_INT);
        $post->bindParam(2, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllNewsForViews($limit, $offset)
    {
        $query = 'SELECT * FROM lite_news ORDER BY date DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $limit, PDO::PARAM_INT);
        $post->bindParam(2, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchAllPostForViews($limit, $offset, $title)
    {
        $title = '%' . $title . '%';
        $query = 'SELECT lite_post.id, lite_post.title, lite_tv.title AS tv, lite_post.views, lite_post.rating, lite_post.date FROM lite_post, lite_tv WHERE lite_post.id_tv = lite_tv.id and lite_post.title LIKE ? ORDER BY lite_post.date DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $title, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchAllNewsForViews($limit, $offset, $title)
    {
        $title = '%' . $title . '%';
        $query = 'SELECT * FROM lite_news WHERE title LIKE ? LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $title, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsWhithId($id){
            $query = 'SELECT * FROM lite_news WHERE id = ?';
            $news = $this->pdo->prepare($query);
            $news->execute([$id]);
            return $news->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserPostForViews($limit, $offset, $user_id)
    {
        $query = 'SELECT lite_post.id, lite_post.title, lite_tv.title AS tv, lite_post.views, lite_post.rating, lite_post.date FROM lite_post, lite_tv WHERE lite_post.id_tv = lite_tv.id and id_user = ? ORDER BY lite_post.date DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $user_id, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserNewsForViews($limit, $offset, $user_id)
    {
        $query = 'SELECT * FROM lite_news WHERE id_user = ? ORDER BY lite_news.date  DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $user_id, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }


    public function searchUserPostForViews($limit, $offset, $user_id, $title)
    {
        $title = '%' . $title . '%';
        $query = 'SELECT lite_post.id, lite_post.title, lite_tv.title AS tv, lite_post.views, lite_post.rating, lite_post.date FROM lite_post, lite_tv WHERE lite_post.id_tv = lite_tv.id and lite_post.id_user = ? and lite_post.title LIKE ? ORDER BY lite_post.date DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(3, $limit, PDO::PARAM_INT);
        $post->bindParam(4, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $user_id, PDO::PARAM_STR);
        $post->bindParam(2, $title, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchUserNewsForViews($limit, $offset, $user_id, $title)
    {
        $title = '%' . $title . '%';
        $query = 'SELECT * FROM lite_news WHERE id_user = ? AND title LIKE ?  ORDER BY lite_news.date DESC LIMIT ? OFFSET ? ';
        $post = $this->pdo->prepare($query);
        $post->bindParam(3, $limit, PDO::PARAM_INT);
        $post->bindParam(4, $offset, PDO::PARAM_INT);
        $post->bindParam(1, $user_id, PDO::PARAM_STR);
        $post->bindParam(2, $title, PDO::PARAM_STR);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllCommentsForViews($limit, $offset)
    {
        $query = 'SELECT lite_comment.id, lite_post.id AS postID, lite_post.title, lite_tv.title AS tv, lite_users.login, lite_comment.body, lite_comment.date FROM lite_post, lite_comment, lite_users, lite_tv WHERE lite_comment.id_post = lite_post.id AND lite_comment.id_user = lite_users.id AND lite_post.id_tv = lite_tv.id ORDER BY lite_comment.id DESC LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $limit, PDO::PARAM_INT);
        $post->bindParam(2, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComment($id)
    {
        $query = 'Delete from lite_comment WHERE  id = ?';
        $comment = $this->pdo->prepare($query);
        return $comment->execute([$id]);
    }

    public function deleteCommentWhithIdPost($id_post)
    {
        $query = 'Delete from lite_comment WHERE  id_post = ?';
        $comment = $this->pdo->prepare($query);
        return $comment->execute([$id_post]);
    }

    public function deleteRatingWhithIdPost($id_post)
    {
        $query = 'Delete from lite_rating WHERE  id_post = ?';
        $comment = $this->pdo->prepare($query);
        return $comment->execute([$id_post]);
    }

    public function deleteCatWhithIdPost($id_post)
    {
        $query = 'Delete from lite_cat WHERE  id_post = ?';
        $comment = $this->pdo->prepare($query);
        return $comment->execute([$id_post]);
    }

    public function getCountCommentsForNewsViews($id_post)
    {
        $query = 'SELECT COUNT(lite_comment.id_post) FROM lite_comment WHERE lite_comment.id_news = ?';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountCommentsForPostViews($id_post)
    {
        $query = 'SELECT COUNT(lite_comment.id_post) FROM lite_comment WHERE lite_comment.id_post = ?';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_post]);
        return $comment->fetch(PDO::FETCH_ASSOC);
    }

    // controls AllPost Edit delete

    public function deletePostWithId($id_post)
    {
        $query = 'Delete From lite_post WHERE id = ?';
        $post = $this->pdo->prepare($query);
        return $post->execute([$id_post]);
    }

    public function updatePostAuthor($id_user_update, $title, $id_tv)
    {
        $query = 'UPDATE lite_post SET id_user_update = ? WHERE title = ? and id_tv = ?';
        $post = $this->pdo->prepare($query);
        return $post->execute([$id_user_update, $title, $id_tv]);
    }

    // this Voprosi
    public function selectFirstIdCaptcha()
    {
        $query = 'Select id from captcha ';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function selectEndIdCaptcha()
    {
        $query = 'Select id from captcha ORDER  BY id DESC';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getVoprosi($id)
    {
        $query = 'SELECT * FROM captcha WHERE id = ?';
        $vopros = $this->pdo->prepare($query);
        $vopros->execute([$id]);
        return $vopros->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountUsersLoginOrEmail($login, $email)
    {
        $query = 'SELECT COUNT(*) FROM lite_users WHERE login = ? OR email = ?';
        $users = $this->pdo->prepare($query);
        $users->execute([$login, $email]);
        return $users->fetch(PDO::FETCH_ASSOC);
    }

    public function addNewUser($login, $email, $password, $ip)
    {
        $time = time();
        $img = "http://animehub.tj/images/avatar/2.png";
        $query = "INSERT INTO lite_users(login, email, password, date, ip,img) VALUES(?,?,?,?,?,?)";
        $users = $this->pdo->prepare($query);
        return $users->execute([$login, $email, $password, $time, $ip, $img]);
    }

    // Канал

    public function getChannel()
    {
        $query = 'SELECT * FROM lite_channel';
        $channel = $this->pdo->query($query);
        return $channel->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addChannel($title)
    {
        $query = 'INSERT INTO lite_channel(title) VALUES(?)';
        $channel = $this->pdo->prepare($query);
        $channel->execute([$title]);
        return $channel->fetchAll(PDO::FETCH_ASSOC);
    }

    public function proExistsChannel($title)
    {
        $query = 'Select COUNT(*) FROM lite_channel WHERE title = ?';
        $channel = $this->pdo->prepare($query);
        $channel->execute([$title]);
        return $channel->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPostForChangeSrc($title)
    {
        $query = 'SELECT lite_anime.id, lite_anime.src, lite_anime.seria, lite_anime.mix_title, lite_anime.rly_path, lite_tv.title AS tv, lite_title.title, lite_stud.title AS stud, lite_kach.title AS kach FROM lite_anime, lite_stud, lite_tv, lite_title, lite_kach	 WHERE lite_anime.id_stud = lite_stud.id AND lite_anime.id_tv = lite_tv.id AND lite_anime.id_title = lite_title.id AND lite_anime.id_kach = lite_kach.id AND lite_title.title LIKE ? ORDER BY seria DESC ';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%"]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPostForChangeSrcTv($title, $tv)
    {
        $query = 'SELECT lite_anime.id, lite_anime.src, lite_anime.seria, lite_anime.mix_title, lite_anime.rly_path, lite_tv.title AS tv, lite_title.title, lite_stud.title AS stud, lite_kach.title AS kach FROM lite_anime, lite_stud, lite_tv, lite_title, lite_kach	 WHERE lite_anime.id_stud = lite_stud.id AND lite_anime.id_tv = lite_tv.id AND lite_anime.id_title = lite_title.id AND lite_anime.id_kach = lite_kach.id AND lite_title.title LIKE ? AND lite_tv.title = ? ORDER BY seria DESC ';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%", $tv]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCountForChangeSrcTv($title, $tv)
    {
        $query = 'SELECT COUNT(*) FROM lite_anime, lite_stud, lite_tv, lite_title, lite_kach WHERE lite_anime.id_stud = lite_stud.id AND lite_anime.id_tv = lite_tv.id AND lite_anime.id_title = lite_title.id AND lite_anime.id_kach = lite_kach.id AND lite_title.title LIKE ? AND lite_tv.title = ? ORDER BY seria DESC ';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%", $tv]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPostForChangeSrcForScript($src)
    {
        $query = 'SELECT lite_anime.id, lite_anime.rly_path FROM lite_anime WHERE lite_anime.src LIKE ? AND lite_anime.rly_path != "" OR lite_anime.src = "" AND lite_anime.rly_path != "" ';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$src%"]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPostForChangeSrcTopVideoForScript($src)
    {
        $query = 'SELECT lite_anime.id, lite_anime.rly_path FROM lite_anime WHERE lite_anime.src LIKE ? AND lite_anime.rly_path != ""';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$src%"]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPostForChangeImgForScript($img)
    {
        $query = 'SELECT lite_anime.id, lite_anime.rly_path, lite_anime.mix_title FROM lite_anime WHERE lite_anime.img LIKE ? OR lite_anime.img = "" AND lite_anime.rly_path != "" AND lite_anime.mix_title != ""';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$img%"]);
        return $post->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveChangeSrc($id, $src)
    {
        $query = 'Update lite_anime SET src = ? WHERE id = ?';
        $anime = $this->pdo->prepare($query);
        return $anime->execute([$src, $id]);
    }

    public function saveChangeImg($id, $img)
    {
        $query = 'Update lite_anime SET img = ? WHERE id = ?';
        $anime = $this->pdo->prepare($query);
        return $anime->execute([$img, $id]);
    }

    public function getCountOngoinForPost($id_post)
    {
        $query = 'SELECT COUNT(*) FROM lite_post, lite_cat_post, lite_cat WHERE lite_post.id = lite_cat_post.id_post AND lite_cat_post.id_cat = lite_cat.id AND lite_cat.title = "Онгоинг" AND lite_post.id = ?';
        $post = $this->pdo->prepare($query);
        $post->execute([$id_post]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommentPost($id_user, $id_post){
    $query = 'SELECT lite_users.login, lite_users.id AS id_user, lite_users.img, lite_users.status, lite_post.title, lite_post.id, lite_tv.title AS tv FROM  lite_users, lite_post, lite_tv WHERE lite_users.id  = ? AND lite_post.id = ? AND lite_post.id_tv = lite_tv.id;';
    $comment = $this->pdo->prepare($query);
    $comment->execute([$id_user, $id_post]);
    return $comment->fetch();
}
    public function getCommentNews($id_user, $id_post){
        $query = 'SELECT lite_users.login, lite_users.id AS id_user, lite_users.status,  lite_users.img, lite_news.title, lite_news.id FROM  lite_users, lite_news WHERE  lite_users.id  = ? AND lite_news.id = ?';
        $comment = $this->pdo->prepare($query);
        $comment->execute([$id_user, $id_post]);
        return $comment->fetch();
    }

    public function getLastComments()
    {
        $query = 'SELECT * FROM lite_comment ORDER BY date DESC LIMIT 5';
        $post = $this->pdo->query($query);
        return $post->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getAllCat()
    {
        $query = 'SELECT * FROM lite_cat ORDER BY lite_cat.title';
        $cat = $this->pdo->query($query);
        return $cat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderViews($title)
    {
        $query = 'SELECT lite_tv.title AS tv, lite_post.id, lite_post.title, lite_god_wip.title AS god FROM lite_tv, lite_post, lite_god_wip WHERE lite_tv.id = lite_post.id_tv AND lite_post.title = ? AND lite_post.id_god_wip = lite_god_wip.id ORDER BY lite_god_wip.title ASC';
        $order = $this->pdo->prepare($query);
        $order->execute([$title]);
        return $order->fetchAll(PDO::FETCH_ASSOC);

    }

    // for slider
    public function getIdPostForSlider($title, $tv)
    {
        $query = 'Select lite_post.id from lite_post, lite_tv  WHERE lite_post.title LIKE ? AND lite_tv.id = lite_post.id_tv AND lite_tv.title = ?';
        $post = $this->pdo->prepare($query);
        $post->execute(["%$title%", $tv]);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function addPostForSlider($id_post, $img)
    {
        $query = 'INSERT into lite_slider(id_post, img) VALUES(?,?)';
        $post = $this->pdo->prepare($query);
        return $post->execute([$id_post, $img]);

    }

    public function getSlider()
    {
        $query = 'Select * from lite_slider;';
        $slider = $this->pdo->query($query);
        return $slider->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSliderForEdit()
    {
        $query = 'SELECT lite_post.title, lite_slider.img, lite_slider.id FROM lite_post, lite_slider WHERE lite_slider.id_post = lite_post.id';
        $slider = $this->pdo->query($query);
        return $slider->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteSlider($id)
    {
        $query = 'Delete from lite_slider WHERE id = ?';
        $slider = $this->pdo->prepare($query);
        return $slider->execute([$id]);
    }

    public function updateSlider($id_post, $img, $id)
    {
        $query = 'Update lite_slider SET id_post = ?, img = ? WHERE id = ?';
        $slider = $this->pdo->prepare($query);
        return $slider->execute([$id_post, $img, $id]);
    }

    public function getSliderWithId($id)
    {
        $query = 'SELECT lite_post.title, lite_tv.title AS tv, lite_slider.img, lite_slider.id FROM lite_tv, lite_post, lite_slider WHERE lite_slider.id_post = lite_post.id AND lite_slider.id = ? AND lite_tv.id = lite_post.id_tv';
        $slider = $this->pdo->prepare($query);
        $slider->execute([$id]);
        return $slider->fetch(PDO::FETCH_ASSOC);
    }


    // stol zakazov

    public function addZakaz($id_user, $title, $description, $date)
    {
        $query = 'INSERT INTO lite_stol(title, description, id_user, date) VALUES(?,?,?,?)';
        $zakaz = $this->pdo->prepare($query);
        return $zakaz->execute([$title, $description, $id_user, $date]);
    }

    public function getZakaz($limit, $offset)
    {
        $query = 'Select lite_users.login, lite_users.status,  lite_users.id AS id_user, lite_stol.id, lite_stol.title, lite_stol.description, lite_stol.status from lite_stol, lite_users where lite_stol.id_user = lite_users.id ORDER BY lite_stol.date DESC LIMIT ? OFFSET ?';
        $stol = $this->pdo->prepare($query);
        $stol->bindParam(1, $limit, PDO::PARAM_INT);
        $stol->bindParam(2, $offset, PDO::PARAM_INT);
        $stol->execute();
        return $stol->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countZakaz($id_user)
    {
        $query = 'SELECT COUNT(*) FROM lite_stol WHERE id_user = ?';
        $stol = $this->pdo->prepare($query);
        $stol->execute([$id_user]);
        return $stol->fetch(PDO::FETCH_ASSOC);
    }

    public function getDateZakaz($id_user)
    {
        $query = 'SELECT date FROM lite_stol WHERE id_user = ? ORDER BY date DESC ';
        $stol = $this->pdo->prepare($query);
        $stol->execute([$id_user]);
        return $stol->fetch(PDO::FETCH_ASSOC);
    }

    public function updateZakaz($id, $status)
    {
        $query = 'Update lite_stol SET status = ? WHERE id = ?';
        $stol = $this->pdo->prepare($query);
        return $stol->execute([$status, $id]);

    }

    public function getZakazOne()
    {
        $query = 'Select lite_users.login, lite_stol.id, lite_stol.title, lite_stol.description, lite_stol.status from lite_stol, lite_users where lite_stol.id_user = lite_users.id ORDER BY lite_stol.date DESC LIMIT 1';
        $stol = $this->pdo->query($query);
        return $stol->fetch(PDO::FETCH_ASSOC);
    }

    public function countAllZakaz()
    {
        $query = 'SELECT COUNT(*) FROM lite_stol';
        $stol = $this->pdo->query($query);
        $stol->execute();
        return $stol->fetch(PDO::FETCH_ASSOC);
    }

    public function addGolos($id_user, $id_zakaz)
    {
        $query = 'INSERT INTO lite_golos(id_user,id_zakaz) VALUES(?,?)';
        $golos = $this->pdo->prepare($query);
        return $golos->execute([$id_user, $id_zakaz]);

    }

    public function getGolos($id_zakaz)
    {
        $query = 'Select COUNT(*) from lite_golos WHERE id_zakaz = ?';
        $golos = $this->pdo->prepare($query);
        $golos->execute([$id_zakaz]);
        return $golos->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountGolosUser($id_user, $id_zakaz)
    {
        $query = 'Select COUNT(*) FROM lite_golos WHERE id_user = ? and id_zakaz = ?';
        $golos = $this->pdo->prepare($query);
        $golos->execute([$id_user, $id_zakaz]);
        return $golos->fetch(PDO::FETCH_ASSOC);
    }

    // news

    public function addNews($title, $img, $content, $date, $id_user)
    {
        $query = 'INSERT INTO lite_news(title,img,content,date,id_user) VALUES(?,?,?,?,?)';
        $news = $this->pdo->prepare($query);
        return $news->execute([$title, $img, $content, $date, $id_user]);
    }

    public function UpdateEditNews($title, $img, $content, $id)
    {
        $query = 'Update lite_news SET title = ?, img = ?, content = ? WHERE id = ?';
        $news = $this->pdo->prepare($query);
        return $news->execute([$title, $img, $content, $id]);
    }

    public function getNews($limit, $offset)
    {
        $query = 'Select * from lite_news ORDER BY date DESC LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $limit, PDO::PARAM_INT);
        $post->bindParam(2, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPostAllForType($id_type_post,$limit, $offset)
    {
        $query = 'Select * from lite_post WHERE id_type_post = ? ORDER BY date DESC LIMIT ? OFFSET ?';
        $post = $this->pdo->prepare($query);
        $post->bindParam(1, $id_type_post, PDO::PARAM_STR);
        $post->bindParam(2, $limit, PDO::PARAM_INT);
        $post->bindParam(3, $offset, PDO::PARAM_INT);
        $post->execute();
        return $post->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getNewsForSlider($limit){
            $query = 'Select * from lite_news ORDER BY date DESC LIMIT ?';
            $news = $this->pdo->prepare($query);
            $news->bindParam(1, $limit, PDO::PARAM_INT);
            $news->execute();
            return $news->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountNewsPostForPageNavigation()
    {
        $query = 'SELECT COUNT(*) FROM lite_news';
        $post = $this->pdo->query($query);
        return $post->fetch(PDO::FETCH_ASSOC);
    }

    public function getNewsContent($id){
            $query = 'SELECT * FROM lite_news WHERE id = ?';
            $news = $this->pdo->prepare($query);
            $news->execute([$id]);
            return $news->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteNews($id){
            $query = 'Delete From lite_news WHERE id = ?';
            $news = $this->pdo->prepare($query);
            return $news->execute([$id]);
    }

    // profile
    public function findUserWithLogin($login){
            $query = 'SELECT * FROM lite_users WHERE login = ? AND status = "0"';
            $user = $this->pdo->prepare($query);
            $user->execute([$login]);
            return $user->fetch(PDO::FETCH_ASSOC);
    }
    public function findAllUserVipWhithIp($id_user){
            $query = 'SELECT * FROM lite_vip WHERE lite_vip.id_user = ?';
            $user = $this->pdo->prepare($query);
            $user->execute([$id_user]);
            return $user->fetch(PDO::FETCH_ASSOC);
    }
    public function addVipForUser($login){
            $query = 'Update lite_users SET status = "4" WHERE login = ?';
            $user = $this->pdo->prepare($query);
            return $user->execute([$login]);
    }

    public function onVipSettingForUser($id_user){
            $query = 'INSERT INTO lite_vip(id_user) VALUES(?)';
            $vip = $this->pdo->prepare($query);
            return $vip->execute([$id_user]);
    }

    public function onVipAllSettingForUser($id_user, $login_color, $back_fon, $update_anime,$vip_status, $font){
        $query = 'INSERT INTO lite_vip(id_user, login_color, back_fon, update_anime,vip_status, font) VALUES(?,?,?,?,?,?)';
        $vip = $this->pdo->prepare($query);
        return $vip->execute([$id_user,$login_color,$back_fon,$update_anime,$vip_status, $font]);
    }
    public function startVipTime($time,$id_user){
            $query = 'UPDATE lite_vip SET date_vip = ? WHERE id_user = ?';
            $user = $this->pdo->prepare($query);
            return $user->execute([$time,$id_user]);

    }
    public function userBilVip($id_user){
        $query = 'SELECT * FROM lite_vip WHERE id_user = ?';
        $user = $this->pdo->prepare($query);
        $user->execute([$id_user]);
        return $user->fetch(PDO::FETCH_ASSOC);
    }

    public function userBilVipLogin($login){
        $query = 'SELECT * FROM lite_vip, lite_users WHERE lite_vip.id_user = lite_users.id AND lite_users.login = ?';
        $user = $this->pdo->prepare($query);
        $user->execute([$login]);
        return $user->fetch(PDO::FETCH_ASSOC);
    }
    public function findUserVip($login){
            $query = 'SELECT lite_users.login, lite_vip.vip_status,lite_vip.font, lite_users.id_pol, lite_users.nameUser, lite_users.city, lite_vip.update_anime, lite_users.img, lite_users.date, lite_users.age, lite_vip.login_color, lite_vip.back_fon, lite_status.title, lite_pol.title AS pol FROM lite_vip, lite_users, lite_status, lite_pol WHERE lite_users.id = lite_vip.id_user AND lite_users.id_pol = lite_pol.id AND lite_status.id = lite_users.status AND lite_users.login = ?';
            $users = $this->pdo->prepare($query);
            $users->execute([$login]);
            return $users->fetch(PDO::FETCH_ASSOC);
    }

    public function findUser($login){
        $query = 'SELECT lite_users.login,lite_users.id_pol, lite_users.nameUser, lite_users.city, lite_users.img, lite_users.date, lite_users.age,  lite_status.title, lite_pol.title AS pol FROM lite_users, lite_status, lite_pol WHERE lite_users.id_pol = lite_pol.id AND lite_status.id = lite_users.status AND lite_users.login = ?';
        $users = $this->pdo->prepare($query);
        $users->execute([$login]);
        return $users->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserId($id){
        $query = 'SELECT lite_users.login, lite_users.img, lite_users.date, lite_users.age, lite_users.login_color, lite_users.back_fon, lite_users.update_anime, lite_status.title, lite_pol.title AS pol FROM lite_users, lite_status, lite_pol WHERE lite_users.id_pol = lite_pol.id AND lite_status.id = lite_users.status AND lite_users.id = ?';
        $users = $this->pdo->prepare($query);
        $users->execute([$id]);
        return $users->fetch(PDO::FETCH_ASSOC);
    }

    public function userProfile($id){
            $query = 'SELECT lite_users.login, lite_users.nameUser, lite_users.city, lite_users.id AS id_user, lite_users.img, lite_users.date, lite_users.age,  lite_status.title, lite_pol.title AS pol FROM lite_users, lite_status, lite_pol WHERE  lite_users.id_pol = lite_pol.id AND lite_status.id = lite_users.status AND lite_users.id = ? ';
        $users = $this->pdo->prepare($query);
        $users->execute([$id]);
        return $users->fetch(PDO::FETCH_ASSOC);
    }

    public function editProfileUser( $age, $id_pol, $name, $city, $id){
            $query = 'Update lite_users SET age = ?, id_pol = ?, nameUser = ?, city = ?  WHERE id = ?';
            $user = $this->pdo->prepare($query);
            return $user->execute([$age,$id_pol,$name,$city,$id]);
    }

    public function addUved($title, $description, $date){
            $query = 'INSERT INTO lite_uved(title,description,date) VALUES(?,?,?)';
            $profile = $this->pdo->prepare($query);
            return $profile->execute([$title,$description,$date]);
    }
    public function getUsersVip(){
            $query = 'SELECT id FROM lite_users WHERE STATUS != "0"';
            $users = $this->pdo->query($query);
            return $users->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUsersAll(){
        $query = 'SELECT id FROM lite_users';
        $users = $this->pdo->query($query);
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addIdUserAndIdUved($id_user, $id_uved){
            $query = 'INSERT INTO lite_uved_id_user(id_user, id_uved) VALUES(?,?)';
            $uved = $this->pdo->prepare($query);
            return $uved->execute([$id_user,$id_uved]);

    }
    public function getUvedId($date,$title, $description){
            $query = 'SELECT id FROM lite_uved WHERE date = ? AND title = ? AND description = ?';
            $uved = $this->pdo->prepare($query);
            $uved->execute([$date,$title,$description]);
            return $uved->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserUved(){
            $query = 'SELECT lite_users.id FROM lite_users, lite_vip WHERE lite_vip.id_user = lite_users.id AND status != "0" AND update_anime = "1" ';
            $user = $this->pdo->query($query);
            return $user->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllUved($id_user){
            $query = 'SELECT * FROM lite_uved, lite_uved_id_user WHERE lite_uved_id_user.id_uved = lite_uved.id AND lite_uved_id_user.id_user = ? ORDER BY date DESC ';
            $uved = $this->pdo->prepare($query);
            $uved->execute([$id_user]);
            return $uved->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addVipSettingUser($login_color, $fon, $uved,$vip_status, $id_user, $font){
            $query = 'Update lite_vip SET login_color = ?, back_fon = ?, update_anime = ?, vip_status = ?, font = ? WHERE id_user = ?';
            $user = $this->pdo->prepare($query);
            return $user->execute([$login_color, $fon, $uved,$vip_status,$font,$id_user]);
    }

    public function getCountUved($id_user){
            $query = 'SELECT COUNT(*) FROM lite_uved_id_user WHERE view = "0"  AND id_user = ?';
            $count = $this->pdo->prepare($query);
            $count->execute([$id_user]);
            return $count->fetch(PDO::FETCH_ASSOC);
    }

    public function getCountUvedForDelete($id_user){
        $query = 'SELECT COUNT(*) FROM lite_uved_id_user WHERE id_user = ?';
        $count = $this->pdo->prepare($query);
        $count->execute([$id_user]);
        return $count->fetch(PDO::FETCH_ASSOC);
    }


    public function updateUvedView($id_uved, $id_user){
            $query = 'Update lite_uved_id_user SET view = "1" WHERE id_nag = ? AND id_user = ?';
            $update = $this->pdo->prepare($query);
            return $update->execute([$id_uved, $id_user]);
    }

    public function updateAva($id_user, $img){
            $query = 'UPDATE lite_users SET img = ? WHERE id = ?';
            $user = $this->pdo->prepare($query);
            return $user->execute([$img, $id_user]);
    }

    public function getType_Post(){
            $query = 'SELECT * FROM lite_type_post';
            $type = $this->pdo->query($query);
            return $type->fetchAll(PDO::FETCH_ASSOC);
}

    public function getStudFromContent(){
            $query = 'SELECT * FROM lite_stud WHERE title != "Unknown"';
            $stud = $this->pdo->query($query);
            return $stud->fetchAll(PDO::FETCH_ASSOC);

    }

    // Favorites
    public function countFavorites($id_post, $id_user){
            $query = 'SELECT COUNT(*) FROM lite_favorites WHERE id_post = ? AND id_user = ?';
            $favorite = $this->pdo->prepare($query);
            $favorite->execute([$id_post, $id_user]);
            return $favorite->fetch(PDO::FETCH_ASSOC);
    }

    public function insertFavorite($id_post, $id_user){
            $query = 'INSERT INTO lite_favorites(id_post,id_user) VALUES(?,?)';
            $favorite = $this->pdo->prepare($query);
            return   $favorite->execute([$id_post,$id_user]);

    }

    public function deleteFavorite($id_post, $id_user){
        $query = 'Delete from lite_favorites WHERE id_post = ? AND id_user = ? ';
        $favorite = $this->pdo->prepare($query);
        return   $favorite->execute([$id_post,$id_user]);

    }

    public function getFavorites($id_user, $limit,$offset){
            $query = 'Select lite_favorites.id AS id_fav, lite_favorites.id_user AS id_fav_user, lite_post.id, lite_post.title, lite_post.id_god_wip, lite_post.image, lite_post.body, lite_post.id_tv, lite_post.rating, lite_post.id_user, lite_post.id_user_update, lite_post.id_type, lite_post.prichina FROM lite_favorites, lite_post WHERE lite_favorites.id_post = lite_post.id AND lite_favorites.id_user = ? LIMIT ? OFFSET ? ';
            $fav = $this->pdo->prepare($query);
            $fav->bindParam(2, $limit, PDO::PARAM_INT);
            $fav->bindParam(3, $offset, PDO::PARAM_INT);
            $fav->bindParam(1, $id_user, PDO::PARAM_STR);
            $fav->execute();
            return $fav->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFavoritesCount($id_user){
        $query = 'SELECT COUNT(*) FROM lite_favorites WHERE id_user = ?';
        $fav = $this->pdo->prepare($query);
        $fav->execute([$id_user]);
        return $fav->fetch(PDO::FETCH_ASSOC);
    }

    public function getFilmsCount(){
        $query = 'SELECT COUNT(*) FROM lite_post, lite_tv WHERE lite_post.id_tv = lite_tv.id AND lite_tv.title LIKE "%Film%" OR lite_post.id_tv = lite_tv.id AND lite_tv.title LIKE "%Фильм%"';
        $fav = $this->pdo->query($query);
        return $fav->fetch(PDO::FETCH_ASSOC);
    }

    public function getFilms($limit,$offset){
        $query = 'SELECT lite_tv.id AS id_tv, lite_tv.title AS tv_title, lite_post.id, lite_post.title, lite_post.id_god_wip, lite_post.image, lite_post.body, lite_post.id_tv, lite_post.rating, lite_post.id_user, lite_post.id_user_update, lite_post.id_type, lite_post.prichina  FROM lite_post, lite_tv WHERE lite_post.id_tv = lite_tv.id AND lite_tv.title LIKE "%Film%" OR lite_post.id_tv = lite_tv.id AND lite_tv.title LIKE "%Фильм%" ORDER BY lite_post.id DESC  LIMIT ? OFFSET ? ';
        $fav = $this->pdo->prepare($query);
        $fav->bindParam(1, $limit, PDO::PARAM_INT);
        $fav->bindParam(2, $offset, PDO::PARAM_INT);
        $fav->execute();
        return $fav->fetchAll(PDO::FETCH_ASSOC);
    }

    // Запись просмотр серии

    public function getViews($id_user, $id_title){
            $query = 'SELECT lite_views.id_ser, lite_views.id_user FROM lite_views, lite_anime WHERE lite_views.id_ser = lite_anime.id AND lite_views.id_user = ? AND lite_anime.id_title  = ?';

    }

    //

    public function editTitleSer($id_title, $id_tv, $old_id_title, $old_id_tv){
            $query = 'Update lite_anime SET id_title = ?, id_tv = ? WHERE id_title = ? AND id_tv = ?';
            $anime = $this->pdo->prepare($query);
            return $anime->execute([$id_title,$id_tv,$old_id_title,$old_id_tv]);
    }

    public function getTech(){
            $query = 'SELECT * FROM lite_tech';
            $tech = $this->pdo->query($query);
            return $tech->fetch(PDO::FETCH_ASSOC);
    }

    // удаление уведомлений

    public function deleteUved($id_user, $id_uved){
            $query = 'DELETE FROM lite_uved_id_user WHERE id_user = ? AND id_nag = ?';
            $uved = $this->pdo->prepare($query);
            return $uved->execute([$id_user,$id_uved]);
    }

    public function addMessage($id_user,$text){
            $query = 'Insert into lite_chat(id_user,text) VALUES (?,?)';
            $chat = $this->pdo->prepare($query);
            return $chat->execute([$id_user,$text]);

    }

    public function getMessage(){
            $query = 'SELECT DATE_FORMAT(lite_chat.date,"%H:%i:%s") AS time, lite_users.id, lite_users.login, lite_users.status, lite_users.img, lite_chat.text, lite_chat.id_chat FROM lite_chat, lite_users WHERE lite_chat.id_user = lite_users.id ORDER BY lite_chat.id_chat DESC LIMIT 40';
            $chat = $this->pdo->query($query);
            return $chat->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMessageWhithId($id){
            $query = 'SELECT DATE_FORMAT(lite_chat.date,"%H:%i:%s") AS time, lite_users.id, lite_users.login, lite_users.status, lite_users.img, lite_chat.text, lite_chat.id_chat FROM lite_chat, lite_users WHERE lite_chat.id_user = lite_users.id AND lite_chat.id_chat = ? ORDER BY lite_chat.id_chat DESC';
            $message = $this->pdo->prepare($query);
            $message->execute([$id + 1]);
            return $message->fetch(PDO::FETCH_ASSOC);
    }



}

?>