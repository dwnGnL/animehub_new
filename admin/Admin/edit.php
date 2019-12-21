<?php
if(isset($_GET['edit']))
{
    require 'lib/Model.php';
    $model = new Model();

?>

    <main class="pt-5 mx-lg-5">

        <div class="container-fluid">

            <div class="container-fluid mt-5">
                <div class="card mb-4 wow fadeIn">
                    <div class="card-body d-sm-flex justify-content-between">


                        <?php
                        if($_SESSION['status'] == 'Админ'){
                        $post = $model->getPostForId($_GET['edit']);
                        $godWip = $model->getGodWip($post['id_god_wip']);
                        $getPostTv = $model->getPostTv($post['id_tv']);
                        $catPost = $model->getCatPost($post['id']);
                        }elseif ($_SESSION['status'] == '2'){
                            $post = $model->getPostForIdModer($_GET['edit'],$_SESSION['status']);
                            $godWip = $model->getGodWip($post['id_god_wip']);
                            $getPostTv = $model->getPostTv($post['id_tv']);
                            $catPost = $model->getCatPost($post['id']);
                        }
                        if(!empty($post)){


                        ?>
                        <form   action="" method="post" name="postFormEdit" id="postForm">
                            <input id="postTitle" value="<?=$post['title'];?>" type="text" class="form-control mr-2 zapolnen" name="postTitleEdit" placeholder="Название аниме" >
                            <input id="postAlias" value="<?=$post['alias'];?>" type="text" class="form-control mt-2 zapolnen" name="postAliasEdit" placeholder="Альтернативное название аниме" >
                            <input id="postTv" value="<?=$getPostTv['title'];?>" type="text" class=" form-control mt-2" name="postTvEdit" placeholder="Сезон" >
                            <input id="postImg" value="<?=$post['image'];?>" type="text" class=" form-control mt-2" name="postImgEdit" placeholder="Картинка" >
                            <input id="postPrichina" value="<?=$post['prichina'];?>" type="text" class=" form-control mt-2" name="postPrichinaEdit" placeholder="Причина обновления" >
                            <input id="postJanr" value="<?php
                            $count = count($catPost);
                            $i = 0;
                            foreach ($catPost as $getCat) {
                                $cat = $model->getCat($getCat['id_cat']);
                                if($i == $count-1){
                                    echo $cat['title'];
                                }else {
                                    echo $cat['title'] . ',';
                                    $i++;
                                }
                            }
                            ?>" type="text" class=" form-control mt-2" name="postJanrEdit" placeholder="Жанр: Приключение,Фэнтези,Экшн..." >
                            <div class="form-inline mt-2">
                                <input id="postGodWip" value="<?=$godWip['title'];?>" type="text" class="form-control mr-2" name="postGodWipEdit" placeholder="Год выпуска">
                                <input id="postType" value="<?=$post['id_type'];?>" type="text" class="form-control mr-2" name="postType" placeholder="статус">
                                <label>Айди Пост не трогать ></label>
                                <input id="idPostEdit" value="<?=$post['id'];?>" type="text" class="form-control mr-2" name="postIdEdit" placeholder="Айди пост" >
                            </div>
                            <textarea id="postOpisanie" name="postOpisanieEdit" class="form-control mt-2" cols="100" rows="5" placeholder="Описание"><?=$post['body'];?></textarea>

                            <input type="button" id="postSave" class="btn btn-primary my-2 mr-sm-0 waves-effect" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>

    
    </main>
    <script>
        var elems=document.querySelectorAll('input[type="text"]');
        for (var i = 0; i < elems.length; i++) {
		    if (elems[i].value==" "){
		        elems[i].value="";
		    }
	    }
    </script>


<?php }?>
<?php }?>