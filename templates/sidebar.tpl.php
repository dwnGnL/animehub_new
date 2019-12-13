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

<!--  <div class="top-weak">-->
<!--    <div class="sidebar-head">Топ за неделю</div>-->
<!---->
<!--    <div class="top-weak-img">-->
<!--      <img src="--><?//=$uri?><!--/templates/images/image (2).jpg">-->
<!--    </div>-->
<!---->
<!--    <ul class="top-weak-films">-->
<!--      <li><div class="current-number current-number-active"></div><span class="top-weak-film-name">Ван пис</span></li>-->
<!--      <li><div class="current-number"></div><span class="top-weak-film-name">Доктор Стоун</span></li>-->
<!--      <li><div class="current-number"></div><span class="top-weak-film-name">Моя героическая академия 4</span></li>-->
<!--      <li><div class="current-number"></div><span class="top-weak-film-name">Семь смертных грехов: Гнев Богов</span></li>-->
<!--      <li><div class="current-number"></div><span class="top-weak-film-name">Мастер меча</span></li>-->
<!--    </ul>-->
<!--  </div>-->

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
