<?=$slider?>
<!-- Content -->
<div id="content">

  <!-- поиск -->
  <?=$search?>
  <!-- New series -->
  <div class="new-series-block">
    <div class="head">
      <div class="left-head">Новые серии аниме</div>
      <a href="/anime"><div class="right-head">Смотреть все новинки</div></a>
    </div>

    <div class="films">
      <?php foreach ($posts as $item):?>
        <div class="film-item">
          <a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>">
            <div class="background-film-item">
              <img src="<?=$item['image']?>">
              <div class="over-back-film-item">
                <div class="circle">
                  <span class="review"><?=$item['views']?></span>
                  <span>Просмотров</span>
                </div>
              </div>
            </div>

            <!-- Ribon is here -->
            <div class="ribbon"><?=$item['seria']['seria']?></div>
          </a>
          <div class="discription">
            <div class="film-name"><a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>"><?=$item['title'].' '.$item['tv_title']?></a></div>
            <div class="film-gener"><?=$helper::renderCat($item['cats'])?></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>

    <?php if (!empty($products)): ?>
  <!-- Store of manga -->
  <div class="all-anime-block">
    <div class="head">
      <div class="left-head">Манга</div>
      <a href="/shop"><div class="right-head">Смотреть все</div></a>
    </div>

    <div class="films">
      <?php foreach ($products as $val): ?>
        <div class="film-item">
          <a href="/shop/product/<?=$helper::renderUrl($val['id_product'], $val['name_product'])?>">
            <div class="background-film-item store">
              <img src="<?=$val['img_product']?>">
              <div class="over-back-film-item">

              </div>
            </div>
          </a>
          <div class="discription">
            <div class="film-name"><a href="/shop/product/<?=$helper::renderUrl($val['id_product'], $val['name_product'])?>"><?=$val['name_product']?></a></div>
            <div class="film-gener"><?=$val['cat_name']?></div>
            <div class="buy-info"><a href="/shop/product/<?=$helper::renderUrl($val['id_product'], $val['name_product'])?>" class="btn-buy"><?=$val['price_product']?>с</a></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
    <?php endif; ?>
  <!-- All of anime -->
  <div class="all-anime-block">
    <div class="head">
      <div class="left-head">Все аниме</div>
      <a href="/anime"><div class="right-head">Смотреть все</div></a>
    </div>

    <div class="films">
      <?php foreach ($newPosts as $val): ?>
        <div class="film-item">
          <a href="/anime/<?=$helper::renderUrl($val['id'], $val['alias'])?>">
            <div class="background-film-item">
              <img src="<?=$val['image']?>">
              <div class="over-back-film-item">
                <div class="circle">
                  <span class="review"><?=$val['views']?></span>
                  <span>Просмотров</span>
                </div>
              </div>
            </div>
          </a>
          <div class="discription">
            <div class="film-name"><a href="/anime/<?=$helper::renderUrl($val['id'], $val['alias'])?>"><?=$val['title'].' '.$val['tv_title']?></a></div>
            <div class="film-gener"><?=$helper::renderCat($val['cats'])?></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>

  <div class="all-anime-block">
    <div class="head">
      <div class="left-head">Новые серии дорам</div>
      <a href="/dorams"><div class="right-head">Смотреть все</div></a>
    </div>

    <div class="films">
      <?php foreach ($dorams as $val): ?>
        <div class="film-item">
          <a href="/dorams/<?=$helper::renderUrl($val['id'], $val['alias'])?>">
            <div class="background-film-item">
              <img src="<?=$val['image']?>">
              <div class="over-back-film-item">
                <div class="circle">
                  <span class="review"><?=$val['views']?></span>
                  <span>Просмотров</span>
                </div>
              </div>
                <div class="ribbon"><?=$val['seria']['seria']?></div>
            </div>
          </a>
          <div class="discription">
            <div class="film-name"><a href="/dorams/<?=$helper::renderUrl($val['id'], $val['alias'])?>"><?=$val['title'].' '.$val['tv_title']?></a></div>
            <div class="film-gener"><?=$helper::renderCat($val['cats'])?></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
  <!-- News -->
  <?php if (!empty($articles)): ?>
    <div class="news-block">
      <div class="head">
        <div class="left-head">Свежие статьи и новости</div>
        <a href="/dorams"><div class="right-head">Читать все</div></a>
      </div>

      <div class="news">

        <?php foreach ($articles as $val): ?>
          <div class="news-item">
            <div class="background-news">
              <img src="<?=$val['image']?>">
            </div>

            <div class="right-block">
              <div class="news-discription"><?=$val['title']?></div>
              <a href="/articles"><div class="date">Статьи и Новости, <?=$helper::getWatch($val['date'])?></div></a>
            </div>
          </div>
        <?php endforeach; ?>


      </div>
    </div>
  <?php endif; ?>
</div>

<script src="<?=$uri?>/templates/js/slider.js?<?=filemtime('templates/js/slider.js')?>"></script>
