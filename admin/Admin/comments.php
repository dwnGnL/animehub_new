<?php
require_once 'lib/Model.php';
require 'lib/Support.php';
if($_SESSION['status'] == 1){
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
    <div class="container-fluid mt-5">
        <h4 class="">Список постов</h4>
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">

                <table >
                    <tr>
                        <td>Post</td>
                        <td>User</td>
                        <td>Comment</td>
                        <td>Date</td>
                        <td>delete</td>
                    </tr>
                    <?php
                    $page = isset($_GET['page']) ? $_GET['page']: 1;
                    $limit = 20;
                    $offset = $limit * ($page - 1);
                    $posts = $model->getAllCommentsForViews($limit,$offset);
                    foreach ($posts as $post){
                        ?>
                        <tr id="<?=$post['id']; ?>">

                            <td class="comAdmin"><a href="../index.php?post=<?=$post['postID']; ?>"><?php echo $post['title'].' '.$post['tv'];?></a></td>
                            <td><?=$post['login']?></td>
                            <td class="comment"><?=$post['body'];?></td>
                            <td class="comAdmin"><?=$post['date'];?></td>
                            <td class="comAdmin"><button type="button" id="deleteComment" data-toggle="modal" data-target="#exampleModalCenter"  delete-id="<?=$post['id'];?>"  class="btn-red float-right ">Delete</button></td>

                        </tr>
                    <?php }?>
                </table>


            </div>
        </div>
    </div>
    <?php
    $pageNav = $model->getCountCommentsForPageNavigation();
    $pageCount = $pageNav['COUNT(*)'] / $limit;
    $pageCount = ceil($pageCount);
    $disabled = '';
    $href = 'index.php?comments=comments&page=';
    $active = '';
    $hrefNumb = 'index.php?comments=comments&page=';
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
    <?php include 'lib/nav.php' ?>


</main>
<?php }?>