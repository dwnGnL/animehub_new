<main class="pt-5 mx-lg-5">
    <?php
    require_once 'lib/Model.php';
    $model = new Model();
    $type = $model->getType_Post();
    ?>
    <div class="container-fluid">

        <div class="container-fluid mt-5">
            <div class="card mb-4 wow fadeIn">
                <div class="card-body d-sm-flex justify-content-between">
                    <form   action="" method="post" name="postForm" id="postForm">
                        <select name="post_type" id="post_type" class="dropdowns-select">
                            <?php foreach ($type AS $title) { ?>
                            <option value="<?=$title['id_type_post'];?>" class=" "><?=$title['title_type_post'];?></option>
                            <?php } ?>
                        </select>
                        <input id="postTitle" type="text" class="form-control mr-2 mt-2 zapolnen" name="postTitle" placeholder="Название" >
                        <input id="postAlias" type="text" class="form-control mr-2 mt-2 " name="postAlias" placeholder="Альтернативное название" >
                        <input id="postTv" type="text" class=" form-control mt-2" name="postTv" placeholder="Сезон" >
                        <input id="postImg" type="text" class=" form-control mt-2" name="postImg" placeholder="Картинка" >
                        <input id="postJanr" type="text" class=" form-control mt-2" name="postJanr" placeholder="Жанр: Приключение,Фэнтези,Экшн..." >
                        <div class="form-inline mt-2">
                            <input id="postGodWip" type="text" class="form-control mr-2" name="postGodWip" placeholder="Год выпуска">
                            <input id="login" type="text" value="<?=$_SESSION['login'];?>" class=" form-control" name="login" placeholder="Автор">
                        </div>
                        <textarea id="postOpisanie" name="postOpisanie" class="form-control mt-2" cols="100" rows="5" placeholder="Описание"></textarea>

                        <input type="button" id="postSave" class="btn btn-primary my-2 mr-sm-0 waves-effect" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>


</main>