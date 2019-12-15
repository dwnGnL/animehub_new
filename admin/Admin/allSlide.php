<?php
require_once 'lib/Model.php';
$model = new Model();
$slider = $model->getAllSliderForEdit();
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
        <h4 class="">Список слайдов</h4>
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">

    <table >
        <tr>
            <td class="comAdmin">Title</td>
            <td class="comAdmin">Img</td>
            <td class="comAdmin">Edit/delete</td>
        </tr>
        <?php foreach ($slider as $value){ ?>
        <tr id="<?=$value['id']?>">

            <td class="comAdmin"><?=$value['title']?></td>
            <td class="comAdmin"><?=$value['img']?></td>
            <td class="comAdmin"><a class="btn-yellow" href="index.php?editSlider=<?=$value['id'];?>">Edit</a> <button type="button" data-toggle="modal" data-target="#exampleModalCenter" delete-id="<?=$value['id']?>" class="btn-red float-right delete">Delete</button></td>

        </tr>
        <?php } ?>
    </table>


            </div>
        </div>
    </div>

<script type="text/javascript" src="js/slider.js"></script>

</main>