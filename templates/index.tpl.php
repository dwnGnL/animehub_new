<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?=$title?></title>
  <meta charset="utf-8">
  <meta name="referrer" content="no-referrer">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/main.css?<?=filemtime('templates/css/main.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/header.css?<?=filemtime('templates/css/header.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/footer.css?<?=filemtime('templates/css/footer.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/sign_in.css?<?=filemtime('templates/css/sign_in.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/profile.css?<?=filemtime('templates/css/profile.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/main-page.css?<?=filemtime('templates/css/main-page.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/film-list.css?<?=filemtime('templates/css/film-list.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/alert-message.css?<?=filemtime('templates/css/alert-message.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/notification.css?<?=filemtime('templates/css/notification.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/chat.css?<?=filemtime('templates/css/chat.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/css/holiday.css?<?=filemtime('templates/css/holiday.css')?>">
  <link rel="stylesheet" href="<?=$uri?>/templates/font-awesome/css/all.css?<?=filemtime('templates/font-awesome/css/all.css')?>">
  <link rel="shortcut icon" href="<?=$uri?>/templates/images/favoicon.png" type="image/png">
  <script type="text/javascript" src="<?=$uri?>/templates/Admin/js/ckeditor/ckeditor.js?<?=filemtime('templates/Admin/js/ckeditor/ckeditor.js')?>"></script>

  <meta name="description" content="<?=$description?>">
  <meta name="keywords" content="<?=$keywords?>">
  <script src="<?=$uri?>/templates/js/jquery-3.3.1.min.js?<?=filemtime('templates/js/jquery-3.3.1.min.js')?>"></script>
</head>
<body data-domen="<?=$uri?>">
  <!-- Backgrounds -->
  <div class="background background-menu"></div>
  <div class="background background-sign-in"></div>
  <div class="message-place"></div>
  <script src="<?=$uri?>/templates/js/alert-message.js?<?=filemtime('templates/js/alert-message.js')?>"></script>

  <div class="show-chat">Открыть чат <i class="fa fa-comments"></i></div>

  <div class="chat-block">
    <div class="chat-header">
      <div class="">Чат <i class="fa fa-comments"></i></div>

      <div class="cross-chat">
        <div class="cross-chat-line"></div>
        <div class="cross-chat-line"></div>
      </div>
    </div>

    <div id="chat"></div>

    <div class="control-chat">
      <textarea id="redactor" name="chat"></textarea>
      <div class="stickers-block">
        <div class="toggle-block">
          <div class="toggle-sticker-arrows left-stickers"><div></div></div>

          <div class="toggle-stickers">
            <ul class="toggle-stickers-list">
              <li class="toggle-sticker-itme"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\0.png"></li>
              <li class="toggle-sticker-itme"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\facebookChat\facebook (0).png"></li>
              <li class="toggle-sticker-itme"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\milkbottle\Milk Bottle--1.gif"></li>
              <li class="toggle-sticker-itme"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\onion\Onion--1.gif"></li>
              <li class="toggle-sticker-itme"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\redChat\red (1).gif"></li>
            </ul>
          </div>

          <div class="toggle-sticker-arrows right-stickers"><div></div></div>
        </div>
        <ul class="stickers-list">
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\0.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\1.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\2.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\3.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\4.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\5.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\6.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\7.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\8.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\9.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\10.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\11.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\12.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\13.png"></li>
          <li class="sticker-item"><img src="\templates\Admin\js\ckeditor\plugins\hkemoji\sticker\14.png"></li>
        </ul>
      </div>
      <i class="far fa-smile"></i>
      <i id="sendChat" class="far fa-arrow-alt-circle-right"></i>
    </div>
  </div>


  <div id="notification-page">
    <div class="top-notification">
      <div>Уведомления</div>

      <div class="notification-cross">
        <div class="notification-cross-line"></div>
        <div class="notification-cross-line"></div>
      </div>
    </div>

    <div class="main-notification">
      <ul class="list-notification">
          <?php foreach ($notifications as $notification): ?>
        <li id="<?=$notification['id']?>" class="notification-item <?= $notification['view'] == 0 ? 'new-notification': '' ?>">
          <div class="notification-text">
            <div class="notification-data">
              <div class="title-notification"><?=$notification['title']?></div>
              <div class="date-notification"><?=$helper::getWatch($notification['date'])?></div>
            </div>

            <p class="notification-description">
              <?=$notification['description']?>
              <div>Автор: <?=$notification['login']?></div>
            </p>
          </div>
          <i class="fa fa-trash"></i>
        </li>
            <?php endforeach; ?>
      </ul>
    </div>

    <div class="bottom-notification">Удалить все</div>
  </div>

  <div id="wrapper">
    <!-- Sign in -->
    <div id="sign-in">
      <div class="top">
        <div>Авторизация</div>
        <div class="exit-sign-in">
          <div class="exit-line f-line"></div>
          <div class="exit-line s-line"></div>
        </div>
      </div>

      <div class="main-sign-in-page">
        <form class="" action="<?=$app->urlFor('login')?>" method="post">
          <div class="sign-in-input">
            <input type="text" name="login" class="main-input sign-in-input-item">
            <div class="sign-in-placeholder">Ваш логин</div>
          </div>

          <input type="text" value="<?=$app->environment['PATH_INFO']?>" name="redirect" placeholder="Ваш логин" class="main-input" hidden>

          <div class="sign-in-input">
            <input type="password" name="password" class="main-input sign-in-input-item">
            <div class="sign-in-placeholder">Ваш пароль</div>
          </div>

          <input type="submit" value="Войти на сайт" name="enter" class="main-input">
          <div class="check-block">
            <label for="check"><input type="checkbox" id="check"> Запомнить меня</label>
          </div>
        </form>
        <div class="bottom">
          <div class="forget-password">Забыли пароль?</div>
          <div class="registration"><a href="/registration">Регистрация</a></div>
        </div>
      </div>
    </div>

    <!-- Header -->
    <?=$menu?>
    <!-- Main page -->
    <div id="main">
      <?=$main?>
      <!-- Main -->
      <!--        --><?php
      //        if (isset($_GET['post'])) {
      //            include $uri.'/templates/'.'pages/film-Pager.php';
      //        } elseif (isset($_GET['info'])) {
      //            include $uri.'/templates/'.'animehub_info.php';
      //        } elseif (isset($_GET['regist'])) {
      //            include $uri.'/templates/'.'pages/regist.php';
      //        } elseif (isset($_GET['stol']) || isset($_POST['zButton'])) {
      //            include $uri.'/templates/'.'stol.php';
      //        } elseif (isset($_GET['news'])) {
      //            include $uri.'/templates/'.'title_posts.php';
      //        } elseif (isset($_GET['donat'])) {
      //            include $uri.'/templates/'.'donat.php';
      //        } elseif (isset($_GET['prof'])) {
      //            include $uri.'/templates/'.'prof.php';
      //        } elseif (isset($_GET['all-anime'])) {
      //            include $uri.'/templates/'.'pages/all-anime.php';
      //        } elseif (isset($_GET['advertisement'])) {
      //            include $uri.'/templates/'.'pages/advertisement.php';
      //        } elseif (isset($_GET['dorames'])) {
      //            include $uri.'/templates/'.'pages/dorames.php';
      //        } elseif (isset($_GET['ongoings'])) {
      //            include $uri.'/templates/'.'pages/ongoings.php';
      //        } elseif (isset($_GET['articles'])) {
      //            include $uri.'/templates/'.'pages/articles.php';
      //        } elseif (isset($_GET['profile'])) {
      //            include $uri.'/templates/'.'pages/profile.php';
      //        } else {
      //            include $uri.'/templates/'."pages/main-Pager.php";
      //        }
      //        ?>

      <!-- Sidebar -->
      <?=$sidebar?>
      <!-- Footer -->
      <div id="footer">
        <div class="top-block">
          <div class="left">
            <div class="logo footer-logo">
              <img class="logo-img" src="<?=$uri?>/templates/images/logo.png">
            </div>

            <div class="questions-block">
              <div class="questions">
                По вопросам рекламы:
              </div>
              <div class="direction">
                <a href="https://vk.com/animehub_tj">Пишите в ВК</a><br>
                На почту: desuhub@yandex.ru
              </div>
            </div>
          </div>

          <div class="to-left"><a href="#" class="communication">Связаться с нами</a></div>
          <div class="to-left social">
            <span>Мы в соц. сетях</span>
            <div class="social-item">
              <div class="social-item-img"><a href="https://vk.com/animehub_tj" target="_blank"><i class="fab fa-vk"></i></a></div>
              <div class="social-item-img"><a href="https://www.facebook.com/animehub.tj" target="_blank"><i class="fab fa-facebook-square"></i></a></div>
              <div class="social-item-img"><a href="https://www.instagram.com/anime_hub_tj" target="_blank"><i class="fab fa-instagram"></i></a></div>
            </div>
          </div>
        </div>

        <div class="bottom-block">
          &#169; 2019 AnimeHub.tj
        </div>
      </div>
    </div>
    <span id="token" style="display:none;"><?=$helper::generateToken()?></span>
    <!-- Yandex.Metrika informer -->
<a class="metrika" href="https://metrika.yandex.ru/stat/?id=53707954&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/53707954/2_1_8C959DFF_6C757DFF_1_uniques"
style="width:80px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (уникальные посетители)" class="ym-advanced-informer" data-cid="53707954" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53707954, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53707954" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <script src="<?=$uri?>/templates/js/notification.js?<?=filemtime('templates/js/notification.js')?>"></script>
    <script src="<?=$uri?>/templates/js/menu.js?<?=filemtime('templates/js/menu.js')?>"></script>
    <script src="<?=$uri?>/templates/js/sign_in.js?<?=filemtime('templates/js/sign_in.js')?>"></script>
    <script src="<?=$uri?>/templates/js/short-text.js?<?=filemtime('templates/js/short-text.js')?>"></script>
    <script src="<?=$uri?>/templates/js/chat.js?<?=filemtime('templates/js/chat.js')?>"></script>
    <script src="<?=$uri?>/templates/js/sticker.js?<?=filemtime('templates/js/sticker.js')?>"></script>
    <script src="<?=$uri?>/templates/js/holiday.js?<?=filemtime('templates/js/holiday.js')?>"></script>
  </body>
  </html>
