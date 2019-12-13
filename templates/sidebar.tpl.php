<link rel="stylesheet" href="<?=$uri?>/templates/css/sidebar.css?<?=filemtime('templates/css/sidebar.css')?>">
<link rel="stylesheet" href="<?=$uri?>/templates/css/questionnaire.css?<?=filemtime('templates/css/questionnaire.css')?>">


<div id="sidebar">
  <div class="update-block">
    <div class="sidebar-head">Обновления</div>

    <?php foreach ($newSerii as $ser): ?>
      <a href="/anime/<?=$helper::renderUrl($ser['id'],$ser['alias'])?>">
        <div class="update">
          <div class="update-item">
            <div class="update-data"><?=$ser['date']?></div>
            <div class="update-bottom">
              <div class="update-name"><?=$ser['title']?></div>
              <div class="update-series"><?=$ser['seria']?> серия</div>
            </div>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

  <div class="questionnaire-block">
    <div class="sidebar-head">Опросник</div>

    <div class="questionnaire">
      <div class="question">Кто мудак?</div>
      <div class="questionnaire-general-choose">Проголосовало: </div>

      <div class="questionnaire-panel">
        <div class="questionnaire-panel-item">
          <div class="questionnaire-panel-item-shadow"></div>
          <span class="questionnaire-item">Анушервон</span>
          <span class="questionnaire-length" data-length="700">Проголосовало</span>
        </div>

        <div class="questionnaire-panel-item">
          <div class="questionnaire-panel-item-shadow"></div>
          <span class="questionnaire-item">Барзу</span>
          <span class="questionnaire-length" data-length="800"></span>
        </div>

        <div class="questionnaire-panel-item">
          <div class="questionnaire-panel-item-shadow"></div>
          <span class="questionnaire-item">Бахтиер</span>
          <span class="questionnaire-length" data-length="300"></span>
        </div>

        <div class="questionnaire-panel-item">
          <div class="questionnaire-panel-item-shadow"></div>
          <span class="questionnaire-item">Я</span>
          <span class="questionnaire-length" data-length="900"></span>
        </div>
      </div>
    </div>
  </div>

    <?php if (!empty($articles)): ?>
  <div class="news-sidebar">
    <div class="sidebar-head">Новости и статьи</div>
    <?php foreach ($articles as $article): ?>
    <div class="news-sidebar-item">
      <div class="news-sidebar-text"><?=$article['title']?></div>
    <a href="<?=$helper::generateUrl($article['id'],$article['alias'])?>" ><div class="news-sidebar-date">Статьи и Новости,<?=$helper::getWatch($article['date'])?></div></a>
    </div>
      <?php endforeach; ?>
  </div>
    <?php endif; ?>

  <div class="comments">
    <div class="sidebar-head">Комментарии</div>
    <?php foreach ($comments as $comment): ?>
    <div class="comment-item">
      <div class="comment-text"><?=$comment['body']?></div>

      <div class="comment-user">
        <div class="user-avatar">
          <img src="<?=$comment['img']?>">
        </div>

      <a href="/<?=$comment['type'].'/'?><?=$helper::renderUrl($comment['id'],$comment['alias'])?>"><div class="comments-name-film"><?=$comment['title'].' '.$comment['tv']?></div></a>
      </div>
    </div>
      <?php endforeach; ?>
  </div>
</div>
</div>


<script src="<?=$uri?>/templates/js/questionnaire.js?<?=filemtime('templates/js/questionnaire.js')?>"></script>
