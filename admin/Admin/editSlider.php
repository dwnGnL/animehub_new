<?php
require_once 'lib/Model.php';
$model = new Model();
$slider = $model->getSliderWithId($_GET['editSlider']);
?>
<main class="pt-5 mx-lg-5">

    <div class="container-fluid">

        <div class="container-fluid mt-5">
            <div class="card mb-4 wow fadeIn">
                <div class="card-body d-sm-flex justify-content-between">

                    <form   action="upload.php" method="post" name="sliderForm" id="sliderForm" enctype="multipart/form-data">
                        <input id="editTitleSlider" value="<?=$slider['title']?>" type="text" class="form-control mr-2 zapolnen" name="sliderTitle" placeholder="Название аниме" >
                        <input id="editSliderTv" value="<?=$slider['tv']?>" type="text" class=" form-control mt-2" name="sliderTv" placeholder="Сезон" >
                        <input type="file" id="file" name="file" class=" mt-2">
                        <input type="button" id="editSliderSave" class="btn btn-primary my-2 mr-sm-0 waves-effect" data-id="<?=$_GET['editSlider']; ?>" value="Сохранить">
                    </form>

                   <div id="load"></div>
                </div>

            </div>
        </div>

    </div>
</main>
