
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

  <div class="top-weak">
    <div class="sidebar-head">Топ за неделю</div>

    <div class="top-weak-img">
      <img src="<?=$uri?>/templates/images/image (2).jpg">
    </div>

    <ul class="top-weak-films">
      <li><div class="current-number current-number-active"></div><span class="top-weak-film-name">Ван пис</span></li>
      <li><div class="current-number"></div><span class="top-weak-film-name">Доктор Стоун</span></li>
      <li><div class="current-number"></div><span class="top-weak-film-name">Моя героическая академия 4</span></li>
      <li><div class="current-number"></div><span class="top-weak-film-name">Семь смертных грехов: Гнев Богов</span></li>
      <li><div class="current-number"></div><span class="top-weak-film-name">Мастер меча</span></li>
    </ul>
  </div>



  <div class="news-sidebar">
    <div class="sidebar-head">Новости и статьи</div>

    <div class="news-sidebar-item">
      <div class="news-sidebar-text">Восстановление работы сайта и смена домена!</div>
      <div class="news-sidebar-date">Статьи и Новости, 21 август 2019, Среда</div>
    </div>

    <div class="news-sidebar-item">
      <div class="news-sidebar-text">Восстановление работы сайта и смена домена!</div>
      <div class="news-sidebar-date">Статьи и Новости, 21 август 2019, Среда</div>
    </div>

    <div class="news-sidebar-item">
      <div class="news-sidebar-text">Восстановление работы сайта и смена домена!</div>
      <div class="news-sidebar-date">Статьи и Новости, 21 август 2019, Среда</div>
    </div>

    <div class="news-sidebar-item">
      <div class="news-sidebar-text">Восстановление работы сайта и смена домена!</div>
      <div class="news-sidebar-date">Статьи и Новости, 21 август 2019, Среда</div>
    </div>

    <div class="news-sidebar-item">
      <div class="news-sidebar-text">Восстановление работы сайта и смена домена!</div>
      <div class="news-sidebar-date">Статьи и Новости, 21 август 2019, Среда</div>
    </div>
  </div>

  <div class="comments">
    <div class="sidebar-head">Комментарии</div>

    <div class="comment-item">
      <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

      <div class="comment-user">
        <div class="user-avatar">
          <img src="<?=$uri?>/templates/images/image (1).jpg">
        </div>
        <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
      </div>
    </div>

    <div class="comment-item">
      <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

      <div class="comment-user">
        <div class="user-avatar">
          <img src="<?=$uri?>/templates/images/image (1).jpg">
        </div>
        <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
      </div>
    </div>

    <div class="comment-item">
      <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

      <div class="comment-user">
        <div class="user-avatar">
          <img src="<?=$uri?>/templates/images/image (1).jpg">
        </div>
        <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
      </div>
    </div>

    <div class="comment-item">
      <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

      <div class="comment-user">
        <div class="user-avatar">
          <img src="<?=$uri?>/templates/images/image (1).jpg">
        </div>
        <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
      </div>
    </div>
  </div>
</div>
</div>
