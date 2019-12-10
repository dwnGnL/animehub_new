<link rel="stylesheet" href="<?=$uri?>/templates/css/slider.css?<?=filemtime('templates/css/slider.css')?>">

<style>
  @media screen and (min-width: 992px) {
    #menu > li:nth-child(1) {
      background: #D81C27;
      cursor: pointer;
    }

    #menu > li:nth-child(1) a  span {
      color: #fff !important;
    }
  }
</style>

<div id="slider">
  <div class="arrows">
    <div class="arrow-item s-next"><img src="<?=$uri?>/templates/images/arrow.png" alt=""></div>
    <div class="arrow-item s-prev"><img src="<?=$uri?>/templates/images/arrow.png" alt=""></div>
  </div>

  <div class="background-slider"></div>

  <div class="slide-wrapper">
    <?php foreach ($slider as $slide):?>
      <a href="/anime/<?=$helper::renderUrl($slide['id'], $slide['alias'])?>" >  <div class="slide"><img src="<?=$uri.$slide['img']?>"> </div></a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Content -->
<div id="content">

  <!-- поиск -->


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
          </a>
          <div class="discription">
            <div class="film-name"><a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>"><?=$item['title'].' '.$item['tv_title']?></a></div>
            <div class="film-gener"><?=$helper::renderCat($item['cats'])?></div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>

  <!-- All of anime -->
  <div class="all-anime-block">
    <div class="head">
      <div class="left-head">Все аниме</div>
      <a href="/anime"><div class="right-head">Смотреть все</div></a>
    </div>

    <div class="films">
      <?php foreach ($newPosts as $val): ?>
        <div class="film-item">
          <a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>">
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
            <div class="film-name"><a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>"><?=$val['title'].' '.$val['tv_title']?></a></div>
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
          <a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>">
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
            <div class="film-name"><a href="/anime/<?=$helper::renderUrl($item['id'], $item['alias'])?>"><?=$val['title'].' '.$val['tv_title']?></a></div>
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
