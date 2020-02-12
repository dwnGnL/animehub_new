<link rel="stylesheet" href="<?=$uri?>/templates/css/film-page.css?<?=filemtime('templates/css/film-page.css')?>">
<link rel="stylesheet" href="<?=$uri?>/templates/css/modal.css?<?=filemtime('templates/css/modal.css')?>">

<div id="film-content">

  <?=$search?>

  <div class="film-discription-block">
    <div class="img-film-discription">
      <img src="<?=$uri.$product['img_product']?>">
    </div>

    <div class="film-discription">
      <div class="film-discription-header"><?=$product['name_product']?></div>

      <ul class="distinctio-list">
          <li>
              <span class="distinctio-list-left">Цена доставки:</span>
              <span class="distinctio-list-right">20с для Душанбе</span>
          </li>
          <?php foreach ($attrs as $attr): ?>
        <li>
          <span class="distinctio-list-left"><?=$attr['name_attr']?>:</span>
          <span class="distinctio-list-right"><?=$attr['val_attr']?></span>
        </li>
          <?php endforeach; ?>
        <li>
          <span class="distinctio-list-left"></span>
          <span class="distinctio-list-right"><a href="#modal" data-toggle="#modal" data-target="#exampleModalLive" for="modal" class="btn-buy modal-button"><label class="modal-button" for="modal"><?=$product['price_product']?>c </label></a></span>
        </li>
      </ul>
    </div>
  </div>


  <input id="modal" type="checkbox">
  <label class="modal-background" for="modal"></label>

  <div class="modal-content">
  <label class="modal-close" for="modal">&#10005;</label>
  <h2>Sweet Modal</h2>
  <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
  <label class="modal-content-button" for="modal">OK</label>
</div>

  <div class="main-discription">
    <div class="discription-header">Описание <span>Манга/Книга</span> <span>«<?=$product['name_product']?>»</span></div>

    <div class="discription-text"><?=$product['text_product']?></div>

    <div class="show-all-text">Развернуть</div>
  </div>


    
  <div class="all-anime-block">
    <div class="head">
      <div class="left-head">Похожие товары:</div>
    </div>

    <div class="films">
      <?php foreach ($similar as $value):?>

        <div class="film-item">
          <a href="/shop/product/<?=$helper::renderUrl($value['id_product'],$value['name_product'])?>">
            <div class="background-film-item">
              <img src="<?=$uri.$value['img_product']?>">
              <div class="over-back-film-item">
              </div>
            </div>
          </a>
          <div class="discription">
            <div class="film-name"><a href="/shop/alias/<?=$helper::renderUrl($value['id_product'], $value['name_product'])?>"><?=$value['name_product']?></a></div>
            <div class="film-gener"><?=($value['cat_name'])?></div>
          </div>
        </div>

      <?php endforeach; ?>

    </div>
  </div>




  </div>
<script src="<?=$uri?>/templates/js/comment.js?<?=filemtime('templates/js/comment.js')?>"></script>
<script src="<?=$uri?>/templates/js/show-hide-text.js?<?=filemtime('templates/js/show-hide-text.js')?>"></script>
<script src="<?=$uri?>/templates/js/video.js?<?=filemtime('templates/js/video.js')?>"></script>
