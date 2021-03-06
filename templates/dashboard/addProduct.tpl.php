<style>
    .disable-click {
        pointer-events: none;
    }
</style>
<link href="<?=$uri?>/templates/dashboard/css/chosen.css?<?=filemtime('templates/dashboard/css/chosen.css')?>" rel="stylesheet" type="text/css">
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Добавление Товара</h1>

    <form action="<?= isset($product)? $action.'/'.$product['id_product'] : $action?>" method="post" enctype="multipart/form-data">
        <input hidden type="text" value="<?=\Lib\Helper::generateToken()?>" name="token">
        <label><span class="label-item">Выбрать тип:</span>
            <select id="cat" name="cat">
                <?php foreach ($cats as $val): ?>
                    <?php if ($val['id_cat_pr'] == $product['id_cat_pr']): ?>
                        <option value="<?=$val['id_cat_pr']?>" selected><?=$val['name_cat']?></option>
                    <?php else: ?>
                    <option value="<?=$val['id_cat_pr']?>"><?=$val['name_cat']?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </label>
        <label><span class="label-item">Название:</span><input type="text" name="title" placeholder="Название" value="<?=$product['name_product']?>"></label>
        <div id="attr">

            <?php foreach ($attr as $value): ?>
                <?php require 'templates/dashboard/attr.tpl.php'?>
            <?php endforeach; ?>
        </div>
        <label><span class="label-item">Цена:</span><input type="number" name="price" placeholder="Цена" value="<?=$product['price_product']?>"></label>
        <label><span class="label-item">Описание:</span><textarea name="text" placeholder="Описание"><?=$product['text_product']?></textarea></label>

        <div class="row mx-5 ">
            <div class="col-md-4">
                <div>
                    <img src="<?=$uri.$product['img_product']?>" class="fileSelect1">
                </div>
                <input name="img1"  accept="image/*" id="fileElem" class="fileElem disable-click" style="display: none" type="file">
            </div>
            <div class="col-md-4">
                <div>
                    <img src="<?=$uri?>templates/dashboard/img/addAnother.png" class="fileSelect1">
                </div>
                <input name="img2"  accept="image/*" id="fileElem" class="fileElem disable-click" style="display: none" type="file">
            </div>
            <div class="col-md-4">
                <div>
                    <img src="<?=$uri?>templates/dashboard/img/addAnother.png" class="fileSelect1">
                </div>
                <input name="img3"  accept="image/*" id="fileElem" class="fileElem disable-click" style="display: none" type="file">
            </div>

        </div>

        <input type="submit" class="btn btn-primary mt-5"  name="save" value="Сохранить">
    </form>
</div>

<script src="<?= $uri ?>/templates/dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?= $uri ?>/templates/dashboard/js/preview.js?<?=filemtime('templates/dashboard/js/preview.js') ?>"></script>
<script src="<?= $uri ?>/templates/dashboard/js/shop.js?<?=filemtime('templates/dashboard/js/shop.js') ?>"></script>

