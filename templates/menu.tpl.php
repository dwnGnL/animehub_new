<div id="profile">
  <div class="top">
    <div>Профиль</div>
    <div class="exit-profile">
      <div class="exit-line f-line"></div>
      <div class="exit-line s-line"></div>
    </div>
  </div>

  <div class="main-sign-in-page">
    <div class="profile-data">
      <div class="profile-avatar">
        <img src="<?=$user['img']?>" alt="">
      </div>

      <div class="profile-name" style="font-family: <?=$user['font']?>; <?=$user['login_color']?>">
        <?=$_SESSION['login']?>
      </div>
    </div>

    <div class="profile-bottom">
      <div><a href="/profile/<?= $_SESSION['login']?>" >Профиль</a></div>
        <?php if ($_SESSION['status'] == 'Админ'): ?>
        <div><a href="/admin/">Админ панель</a></div>
        <div><a href="<?=$app->urlFor('viewQuest')?>">Опросник</a></div>
        <?php endif; ?>
      <div>Закладки: (<span class="bookmark-quantity">0</span>)</div>
      <div><a href="<?=$app->urlFor('logout')?>">Выйти</a> </div>
    </div>
  </div>
</div>


<div id="header">
  <a href="<?=$app->urlFor('home')?>">
    <div class="logo main-logo">
      <img class="logo-img" src="<?=$uri?>/templates/images/logo.png">
    </div>
  </a>
  <ul id="menu">
    <li class="active sub-menu top-menu">
      <a href="/anime"><span>Аниме</span></a>
      <div id="sub-menu">
        <div class="left-part-sub-menu">
          <span class="sub-menu-header">По типу</span>
          <ul class="qualification-list">
            <li> <a href="<?=$uri?>/type/tv">ТВ</a></li>
            <li><a href="<?=$uri?>/type/ova">OVA</a></li>
            <li> <a href="<?=$uri?>/type/film">Фильм</a></li>
            <li> <a href="<?=$uri?>/type/amv">AMV</a></li>
          </ul>

          <span class="sub-menu-header">По годам</span>
          <ul class="qualification-list">
            <?php foreach ($years as $year): ?>
              <li><a href="<?=$uri?>year/<?=$year['title']?>"><?=$year['title']?></a> </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="right-part-sub-menu-block">

          <ul class="middle-part-sub-menu gener-list">
            <?php if (isset($categories) && is_array($categories)): ?>
              <?php $middle = count($categories) / 2 ?>
              <?php $middle = ceil($middle); ?>
              <?php $i = 0; ?>
              <?php foreach ($categories as $category ): ?>

                <?php if ($i != $middle): ?>
                  <li><a href="/category/<?=$category['title']?>"><?=$category['title']?></a></li>
                <?php elseif($i == $middle): ?>
                </ul>
                <ul class="right-part-sub-menu gener-list">
                  <li><a href="/category/<?=$category['title']?>"><?=$category['title']?></a></li>
                <?php else:  ?>
                  <li><a href="/category/<?=$category['title']?>"><?=$category['title']?></a></li>
                <?php endif;  ?>
                <?php $i++?>
              <?php endforeach;  ?>
            <?php endif;  ?>
          </ul>
        </div>
      </div>
    </li>
    <?php if (!empty($pages) && is_array($pages)): ?>
      <?php foreach ($pages as $page): ?>
        <li class="top-menu"><a href="<?=$app->urlFor('page',['alias' => $page['alias']])?>"><span><?=$page['title']?></span></a></li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>


  <?php if (!isset($_SESSION['auth'])):?>
    <div id="sign-in-button">Войти</div>
  <?php else: ?>
    <div id="profile-button">Профиль</div>
  <?php endif; ?>
  <div id="menu-button">
    <div class="menu-lines">
      <div class="menu-line l1"></div>
      <div class="menu-line l2"></div>
      <div class="menu-line l3"></div>
    </div>
  </div>
</div>
