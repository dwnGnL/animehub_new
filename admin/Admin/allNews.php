<?php

require_once 'lib/Model.php';

require 'lib/Support.php';



$model = new Model();

?>

<link rel="stylesheet" href="../css/style_comments.css">

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLongTitle">Предупреждение!</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                Вы точно хотите удалить пост?

            </div>

            <div class="modal-footer">

                <button type="button" id="yes" class="btn btn-secondary btnListener" data-dismiss="modal">Да</button>

                <button type="button" id="no" class="btn btn-primary btnListener" data-dismiss="modal">Нет</button>

            </div>

        </div>

    </div>

</div>





<main class="pt-5 mx-lg-5">



    <div class="card-body d-sm-flex justify-content-between">

        <h4 class="mb-2 mb-sm-0 pt-1" id="otvet">

        </h4>



        <form method="get" name="search" action="AnimeAdmin.php" style="display: inline-flex;">

            <img src="../img/gif/Load.gif" id="load" class="invisible" alt="#">

            <input type="search" name="searchNews" class="form-control" id="titleAnime" placeholder="Поиск" style="width:90%;">

            <button id="sendSearch" type="submit" class="btn btn-primary btn-sm my-0 p" name="btn"><i class="fa fa-search" aria-hidden="true"></i></button>

        </form>



    </div>

    <div class="container-fluid mt-5">

        <h4 class="">Список постов</h4>

        <div class="card mb-4 wow fadeIn">

            <div class="card-body d-sm-flex justify-content-between">



                <table >

                    <tr>

                        <td class="comAdmin">Title</td>

                        <td class="comAdmin">Views</td>

                        <td class="comAdmin">rating</td>

                        <td class="comAdmin">comments</td>

                        <td class="comAdmin">date</td>

                        <td class="comAdmin">Edit/delete</td>

                    </tr>

                    <?php

                    $page = isset($_GET['page']) ? $_GET['page']: 1;

                    $limit = 20;

                    $offset = $limit * ($page - 1);

                    if($_SESSION['status'] == 1){

                        if(isset($_GET['searchNews'])){

                            $posts = $model->searchAllNewsForViews($limit, $offset, $_GET['searchNews']);
                            $get = '?searchNews=';

                        }else{

                            $posts = $model->getAllNewsForViews($limit,$offset);
                            $get = '?allNews';

                        }

                    }elseif ($_SESSION['status'] == 3){



                        if(isset($_GET['searchNews'])){

                            $posts = $model->searchUserNewsForViews($limit, $offset, $_SESSION['id'], $_GET['searchNews']);
                            $get = '?searchNews=';

                        }else{

                            $posts = $model->getUserNewsForViews($limit, $offset, $_SESSION['id']);
                            $get = '?allNews';
                        }

                    }



                    foreach ($posts as $post){

                        $countComments = $model->getCountCommentsForNewsViews($post['id']);

                        ?>

                        <tr id="<?=$post['id']; ?>">



                            <td class="comAdmin"><a href="../index.php?post=<?=$post['id']; ?>"><?php echo $post['title'].' '.$post['tv'];?></a></td>

                            <td class="comAdmin"><?=$post['views']; ?></td>

                            <td class="comAdmin"><?=$post['rating']; ?></td>

                            <td class="comAdmin"><?= $countComments['COUNT(lite_comment.id_post)']; ?></td>

                            <td class="comAdmin"><?=date('d.m.Y H:i:s', Support::getWatch($post['date'])); ?></td>

                            <td class="comAdmin"><a class="btn-yellow" href="Admin/editNews.php?editNews=<?=$post['id'];?>">Edit</a> <button type="button" data-toggle="modal" data-target="#exampleModalCenter" delete-id="<?=$post['id'];?>" class="btn-red float-right deleteNews">Delete</button></td>



                        </tr>

                    <?php }?>

                </table>





            </div>

        </div>

    </div>

    <?php

    if($_SESSION['status'] == 1){

        if(isset($_GET['searchPosts'])) {

            $pageNav = $model->searchCountNewsForPageNavigation($_GET['searchNews']);

        }else {

            $pageNav = $model->getCountNewsForPageNavigation();

        }



    }elseif ($_SESSION['status'] == 3){

        if(isset($_GET['searchPosts'])){

            $pageNav = $model->searchCountUserNewsForPageNavigation($_SESSION['id'], $_GET['searchNews']);

        }else{

            $pageNav = $model->getCountUserNewsForPageNavigation($_SESSION['id']);

        }

    }

    $pageCount = $pageNav['COUNT(*)'] / $limit;

    $pageCount = ceil($pageCount);

    $disabled = '';
    $href = 'index.php'.$get.$_GET['searchNews'].'&page=';

    $active = '';

    $hrefNumb = 'index.php'.$get.$_GET['searchNews'].'&page=';

    if(isset($_GET['page']) && $_GET['page'] == 1){

        $disabled = 'disabled';

        $active = 'bg-primary';

    }else{

        $disabled = '';



        if(!isset($_GET['page'])){

            $active = 'bg-primary';

        }



    }

    if(isset($_GET['page'])){



    }else{

        $disabled = 'disabled';

    }



    ?>



    <?php include 'nav.php' ?>



</main>