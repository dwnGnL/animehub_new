<?php
require_once 'sortStr.php';
require_once 'Parsemix.php';
$m = new Model();
$sort = new sortAnime();


// Тут просходит парсинг

if(isset($_POST['send']) && isset($_POST['site'])){

    if($_POST['site'] == 1){
        if (empty($_POST['startVideo'])){
            $_POST['startVideo'] = 1;
        }
        if (empty($_POST['endVideo'])){
            $_POST['endVideo'] = 24;
        }
        if (empty($_POST['startPage'])){
            $_POST['startPage'] = 1;
        }
        if (empty($_POST['endPage'])){
            $_POST['endPage'] = 100;
        }

        Parser($_POST['send'], $_POST['startPage'], $_POST['endPage'], $_POST['startVideo'], $_POST['endVideo']);
    }elseif ($_POST['site'] == 2){
        if (empty($_POST['startVideo'])){
            $_POST['startVideo'] = 1;
        }
        if (empty($_POST['endVideo'])){
            $_POST['endVideo'] = 20;
        }
        if (empty($_POST['startPage'])){
            $_POST['startPage'] = 1;
        }
        if (empty($_POST['endPage'])){
            $_POST['endPage'] = 100;
        }
        parseTopVideo($_POST['send'], $_POST['startPage'], $_POST['endPage'], $_POST['startVideo'], $_POST['endVideo']);
    }
}


if(isset($_POST['titnleAnimeChannel']) && $_POST['channel']){

    if (empty($_POST['videoStart'])){
        $_POST['videoStart'] = 1;
    }
    if (empty($_POST['videoEnd'])){
        $_POST['videoEnd'] = 24;
    }
    if (empty($_POST['pageStart'])){
        $_POST['pageStart'] = 1;
    }
    if (empty($_POST['pageEnd'])){
        $_POST['pageEnd'] = 1;
    }
    parseChannel($_POST['channel'],$_POST['titnleAnimeChannel'],$_POST['pageStart'],$_POST['pageEnd'], $_POST['videoStart'], $_POST['videoEnd']);
}


//Тут вывод аниме на адмике для сортировки

if (isset($_POST['sort'])) {
    $anime = $m->getAnimeForSort($_POST['sort']);
    $massive = [];
    $i = 0;

    foreach ($anime as $get) {
        $i++;
        $massive[$i] = $sort->addNumberSeries($sort->startSort($get['title']));
        $massive[$i]['title'] = $get['title'];
        $massive[$i]['id'] = $get['id'];

    }
    echo json_encode($massive);
}


    // Удаление серии из таблицы парсера
if (isset($_POST['id_parse'])){
    $m->removeParseSer($_POST['id_parse']);
}

 //Тут запись сортированного аниме
    if(isset($_POST['titleAnime'])) {
        $basAnime = $m->getAnimeForSort($_POST['rlyTitle']);
        $userId = $m->getUserId($_POST['login']);
        for($i = 0; $i < $_POST['lengthSer']; $i++){
            $num = $i + 1;
          $stud =  $sort->sortStud($basAnime[$i]['title']);
          $kach = $sort->sortKach($basAnime[$i]['size']);
          $tv = $sort->saveSortTv($_POST['tv'.$num]);
          $title = $sort->saveSortTitle($_POST['titleAnime']);
          $src = $basAnime[$i]['src'];
          $seria = $_POST['ser'.$num];
          $m->addAnime($basAnime[$i]['rly_path'],$stud,$kach,$tv['id'],$title['id'],$src,$seria,$basAnime[$i]['title'],$basAnime[$i]['img']);
          $m->updateTimePost($_POST['titleAnime'], $tv['id']);
          $m->updatePostAuthor($userId['id'], $_POST['titleAnime'], $tv['id'] );
          if(!empty($_POST['prichina'])){
                $m->addPrichinaForPost($_POST['prichina'], $_POST['titleAnime'], $tv['id']);
                if($i == 0){
                $users = $m->getUserUved();
                $idpost = $m->getIdPost($_POST['titleAnime'], $tv['id']);
                $titleForUved = $_POST['titleAnime'].' '.$_POST['tv1'];
                $description = $_POST['prichina'].' Ссылка: <a href="index.php?title_content&post='.$idpost['id'].'">'.$_POST['titleAnime'].'</a>';
                $time = time();
                $m->addUved($titleForUved,$description,$time);
                $id_uved = $m->getUvedId($time, $titleForUved,$description);
                foreach ($users as $user){
                        $m->addIdUserAndIdUved($user['id'], $id_uved['id']);
                    }
                }
          }
        }
        $m->deleteAnimeTvM();
        $m->deleteAnimeExcessWithTitle($_POST['rlyTitle']);


    }

    //Добавление поста
    if(isset($_POST['postTitle'])){
            $tv = $sort->saveSortTv($_POST['postTv']);
            $god = $sort->saveSortGod($_POST['postGodWip']);
            $userId = $m->getUserId($_POST['login']);
            $id_post =  $m->addPost($god['id'],$_POST['postImg'], $_POST['postTitle'], $_POST['postOpisanie'], $tv['id'],$userId['id'],$_POST['post_type'],$_POST['postAlias']);
            $m->addPostViews($id_post);
            $postId = $m->getIdPost($_POST['postTitle'], $tv['id']);
            $cat = $_POST['postJanr'];
            $cat = explode(',', $cat);
            for ($i = 0; $i < count($cat); $i++){
                $successCat =  $sort->saveSortCat($cat[$i]);
                $m->addPostCat( $postId['id'],$successCat['id']);
            }

}
    // вывод серии плейра

    if(isset($_POST['idKach'])&& isset($_POST['idStud']) && isset($_POST['title']) && isset($_POST['tv']))  {

        $getStud = $m->getStud($_POST['idStud']);
        $getKack = $m->getKach($_POST['idKach']);
        $idTitle = $m->getIdTitle($_POST['title']);
        $idTv = $m->getIdTv($_POST['tv']);
        $post = [];
        if($_POST['idKach'] == 0 && $_POST['idStud'] != 0){
            $post = $m->getAllAnimeForWatchNotKach($getStud['id'], $idTitle['id'] , $idTv['id']);
        }elseif ($_POST['idStud'] == 0 && $_POST['idKach'] != 0){
            $post = $m->getAllAnimeForWatchNotStud($_POST['idKach'], $idTitle['id'], $idTv['id']);
        }elseif ($_POST['idStud'] != 0 && $_POST['idKach'] != 0){
            $post = $m->getAllAnimeForWatch($getStud['id'],$getKack['id'],$idTitle['id'], $idTv['id']);
        }else{
            $post = $m->getAllAnimeForWatchNotAll($idTitle['id'], $idTv['id']);
        }


       echo json_encode($post);
    }


    if(isset($_POST['seria'])){
        $seria = $m->getSeriaSrcAnime($_POST['seria']);
        echo trim($seria['src']);
    }


// Удаление поста тут идет

    if(isset($_POST['idPostForDeletePost'])){
        $m->deletePostWithId($_POST['idPostForDeletePost']);
        $m->deleteCatWhithIdPost($_POST['idPostForDeletePost']);
        $m->deleteRatingWhithIdPost($_POST['idPostForDeletePost']);
        $m->deleteCommentWhithIdPost($_POST['idPostForDeletePost']);
    }

//Обновление поста
if(isset($_POST['postTitleEdit'])){
    $tv = $sort->saveSortTv($_POST['postTvEdit']);
    $titleId = $sort->saveSortTitle($_POST['postTitleEdit']);

    $god = $sort->saveSortGod($_POST['postGodWipEdit']);
    $postId = $m->getIdPost($_POST['postTitleEdit'], $tv['id']);
    $oldpost = $m->getPostForId($_POST['postIdEdit']);
    $oldTitle = $sort->saveSortTitle($oldpost['title']);
    $m->editTitleSer($titleId['id'],$tv['id'],$oldTitle['id'], $oldpost['id_tv']);
    $m->updateEditPost($god['id'],$_POST['postImgEdit'], $_POST['postTitleEdit'], $_POST['postOpisanieEdit'], $tv['id'],$_POST['postPrichinaEdit'], $_POST['postIdEdit'], $_POST['postType']);
    $m->deletePostCat($postId['id']);
    $cat = $_POST['postJanrEdit'];
    $cat = explode(',', $cat);
    for ($i = 0; $i < count($cat); $i++){
        $successCat =  $sort->saveSortCat($cat[$i]);
        $m->addPostCat( $postId['id'],$successCat['id']);
    }


}

// Удаление комента

 if(isset($_POST['idComment'])){
     $m->deleteComment($_POST['idComment']);
 }

 // Добавление канала

    if(isset($_POST['channelAdd'])){
        $count = $m->proExistsChannel($_POST['channelAdd']);
        if($count['COUNT(*)'] > 0){
            echo 'Такой канал уже добавлен!';
        }else{
        $m->addChannel($_POST['channelAdd']);
        echo 'Канал добавлен!';
        }
    }

    // вывод ссылок для редактора ссылок
if(isset($_POST['titleAnimeSrc'])){
    if(!empty($_POST['tvAnimeSrc'])){
        $anime = $m->getAllPostForChangeSrcTv($_POST['titleAnimeSrc'], $_POST['tvAnimeSrc']);
    }else{
        $anime = $m->getAllPostForChangeSrc($_POST['titleAnimeSrc']);
    }
    echo json_encode($anime);

}

//сохраненине редактор ссылок
if(isset($_POST['src0']) && isset($_POST['id0'])){
    for($i = 0; $i < $_POST['inputСount']; $i++){
        $m->saveChangeSrc($_POST['id'.$i], $_POST['src'.$i]);
    }
    echo 'Готово';
}



// удаление новостей

if(isset($_POST['idNewsDelete'])){
    $m->deleteNews($_POST['idNewsDelete']);
}

// Отправление уведомлений

if(isset($_POST['typeUser']) && isset($_POST['titleUved']) && isset($_POST['descUved'])){
    $time = time();
    $m->addUved($_POST['titleUved'], $_POST['descUved'], $time);
    $id_uved = $m->getUvedId($time, $_POST['titleUved'], $_POST['descUved']);
    if($_POST['typeUser'] == 1){
        $users = $m->getUsersAll();
    }else{
        $users = $m->getUsersVip();
    }

    foreach ($users as $user){
        $m->addIdUserAndIdUved($user['id'], $id_uved['id']);
    }
    echo 'Вы успешно отправили уведомление!';
}

// Вкл тех обслуживание и вык тех обслуживание

if(isset($_POST['tech'])){
    if($_POST['tech'] == 1){
        $m->updateTech('0');
    }else{
        $m->updateTech('1');
    }
   $eco = $m->getTech();
    echo $eco['tech'];
}

// Удаление уведомлений

if(isset($_POST['uvedUserId']) && isset($_POST['uvedIdForDelete'])){
    $m->deleteUved($_POST['uvedUserId'], $_POST['uvedIdForDelete']);
    $count = $m->getCountUvedForDelete($_POST['uvedUserId']);

    echo $count['COUNT(*)'];
}

// Расписание

if(isset($_POST['titleAnimeR']) && isset($_POST['id_den'])){
    $titleAnime = explode(',', $_POST['titleAnimeR']);
    for($i = 0; $i < count($titleAnime); $i++) {
        $m->addRaspisanie($_POST['id_den'], $titleAnime[$i]);
    }
}

// Удаление расписаний

if(isset($_POST['id_raspisanie'])){
    $m->deleteRaspisanie($_POST['id_raspisanie']);

}


// аякс поиск в админке
if (isset($_POST['searchAnime'])){
  $anime =  $m->searchAnime($_POST['searchAnime']);
  foreach ($anime as $value){
      echo '<li>'.$value['title'].'</li>';
  }
}
?>

