<link rel="stylesheet" href="<?=$uri?>/templates/css/sidebar.css?<?=filemtime('templates/css/sidebar.css')?>">
<link rel="stylesheet" href="<?=$uri?>/templates/css/questionnaire.css?<?=filemtime('templates/css/questionnaire.css')?>">

<div id="sidebar">
  <div class="update-block">
    <!-- <div class="sidebar-head">Топ аниме</div> -->
    <div class="top-weak">
      <div class="sidebar-head">Топ аниме</div>

      <div class="top-weak-img">

        <a href="<?=$uri?>/anime/<?=$helper::renderUrl($topAnime[0]['id'],$topAnime[0]['alias'])?>">

            <img src="<?=$topAnime[0]['image']?>">

        </a>
      </div>

      <ul class="top-weak-films">

        <a href="<?=$uri?>/anime/<?=$helper::renderUrl($topAnime[0]['id'],$topAnime[0]['alias'])?>"><li><div class="current-number current-number-active">1</div><span class="top-weak-film-name"><?=$topAnime[0]['title'].' '.$topAnime[0]['tv']?></span></li></a>
          <?php for ($i = 1; $i < count($topAnime); $i++): ?>
        <a href="<?=$uri?>/anime/<?=$helper::renderUrl($topAnime[$i]['id'],$topAnime[$i]['alias'])?>"><li><div class="current-number"><?=$i+1?></div><span class="top-weak-film-name"><?=$topAnime[$i]['title'].' '.$topAnime[$i]['tv']?></span></li></a>
          <?php endfor; ?>
      </ul>
    </div>
  </div>

  <div class="questionnaire-block">
    <div class="sidebar-head">Опросник</div>

    <div class="questionnaire">
      <div class="question" id="<?=$questions['id_questions']?>"><?=$questions['title_questions']?></div>
      <div class="questionnaire-general-choose">Проголосовало: </div>
      <div class="questionnaire-panel <?=empty($votedUser) ? : 'questionnaire-done';?> ">  <!--вот тут класс questionnaire-done надо добавить если чел зареган -->
        <?php foreach ($answer as $value):?>
          <div class="questionnaire-panel-item <?=empty($value['voted'])? : 'questionnaire-choose'?>">
            <div class="questionnaire-panel-item-shadow"></div>
            <span class="questionnaire-item" id="<?=$value['id_answers']?>"><?=$value['title_answers']?></span>
            <span class="questionnaire-length" data-length="<?=$value['total']?>">Проголосовало</span>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>

  <?php if (!empty($articles)): ?>
    <div class="news-sidebar">
      <div class="sidebar-head">Новости и статьи</div>
      <?php foreach ($articles as $article): ?>
        <div class="news-sidebar-item">
          <div class="news-sidebar-text"><?=$article['title']?></div>
          <a href="<?=$helper::renderUrl($article['id'],$article['alias'])?>" ><div class="news-sidebar-date">Статьи и Новости,<?=$helper::getWatch($article['date'])?></div></a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="comments">
    <div class="sidebar-head">Комментарии</div>
    <?php foreach ($comments as $comment): ?>
      <div class="comment-item">
        <a href="/profile/<?=$comment['login']?>">
          <div class="comment-user">
            <div class="user-avatar"><img src="<?=$comment['img']?>"></div>
            <div class="user-name-comment" style="<?=$comment['login_color']?>; font-family: <?=$comment['font']?>"><?=$comment['login']?> <span style="color: <?=$comment['color']?>; font-family:<?=$comment['login']?> "><?=$comment['status']?></span></div>
          </div>
        </a>
        <div class="comment-text"><?=$comment['body']?></div>

        <a href="/<?=$comment['type'].'/'?><?=$helper::renderUrl($comment['id_post'],$comment['alias'])?>"><div class="comments-name-film"><?=$comment['title'].' '.$comment['tv']?></div></a>
      </div>
    <?php endforeach; ?>
  </div>

</div>
</div>

<script src="<?=$uri?>/templates/js/questionnaire.js?<?=filemtime('templates/js/questionnaire.js')?>"></script>
