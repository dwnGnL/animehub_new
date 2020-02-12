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
          <span class="distinctio-list-right"><a href="#modal" data-modal="#modal2"  class="btn-buy modal__trigger"><label class="modal-button" for="modal"><?=$product['price_product']?>c </label></a></span>
        </li>
      </ul>
    </div>
  </div>


  <div id="modal2" class="modal modal__bg" role="dialog" aria-hidden="true">
		<div class="modal__dialog">
			<div class="modal__content">
				<h1>Как купить?</h1>
  <p>НИКАК!</p>
				<!-- modal close button -->
				<a href="" class="modal__close demo-close">
					<svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
				</a>
			</div>
		</div>
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
  <script src="<?=$uri?>/templates/js/modal.js?<?=filemtime('templates/js/modal.js')?>"></script>
<script src="<?=$uri?>/templates/js/comment.js?<?=filemtime('templates/js/comment.js')?>"></script>
<script src="<?=$uri?>/templates/js/show-hide-text.js?<?=filemtime('templates/js/show-hide-text.js')?>"></script>
<script src="<?=$uri?>/templates/js/video.js?<?=filemtime('templates/js/video.js')?>"></script>
