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
              <span class="distinctio-list-right">10с</span>
          </li>
          <li>
              <span class="distinctio-list-left" style="color: red">Не нашли мангу которую искали? Оставьте заявку в мессенджерах +992929982945</span>
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
                <p>Пишите сюда:</p>
                        <p>Viber: <span>+992929982945</span></p>
                        <p>WhatsApp: <span>+992929982945</span></p>
                        <p>Telegram: <span>+992929982945</span></p>
                        <p>VK: <span><a href="https://vk.com/ikromov1998">Клик</a></span></p>
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
      <?php if(isset($_SESSION['auth'])):?>
          <form class="form-comment form">
              <div class="disable"><div class="loader">Loading...</div></div>
              <!-- <textarea class="form-control" name="comment"  id="textComment" cols="80" rows="10" placeholder="Оставить коментарий..." ></textarea> -->
              <textarea id="textComment" name="comment" class="form-control" placeholder="Оставить коментарий..."></textarea>
              <button class="btn btn-outline-secondary" type="button" id="sendComment">Оставить отзыв</button>
          </form>



      <?php endif;?>
      <div class="video-comments">
          <?php if (!empty($comments)): ?>
          <?php foreach($comments as $val): ?>
              <div class="video-comment-item">
                  <div class="video-comment-user-avatar">
                      <img src="<?=$val['img']?>">
                  </div>

                  <div class="video-comment-right <?= !empty($val['back_fon'])? 'vip' : ''  ?>" style='background-image:<?=$val['back_fon']?>'>
                      <div class="comment-arrow"></div>
                      <div class="top-video-comment-item">
                          <div class="video-comment-user-name">
                              <a href="/profile/<?=$val['login']?>" style="font-family:<?=$val['font']?>;<?=$val['login_color']?>" ><?=$val['login'].' '?></a><span style ="color:<?=$val['color']?>;font-family:<?=$val['font']?>"><?=$val['status']?></span>
                          </div>
                          <div class="video-comment-date">
                              <?=$helper::getWatch($val['date'])?>
                          </div>
                      </div>
                      <div class="video-comment-text">
                          <?=$val['body']?>
                          <div class="answer-comment"><i class="fa fa-reply"></i></div>
                      </div>
                      <?=$val['vip_status']?>
                  </div>

              </div>
          <?php endforeach; ?>
          <?php endif; ?>
      </div>
  </div>




  </div>
  <script src="<?=$uri?>/templates/js/modal.js?<?=filemtime('templates/js/modal.js')?>"></script>
<script src="<?=$uri?>/templates/js/comment.js?<?=filemtime('templates/js/comment.js')?>"></script>
<script src="<?=$uri?>/templates/js/show-hide-text.js?<?=filemtime('templates/js/show-hide-text.js')?>"></script>
<script src="<?=$uri?>/templates/js/video.js?<?=filemtime('templates/js/video.js')?>"></script>
