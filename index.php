<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>AnimeHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content ="Аниме портал Таджикистана!">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/sign_in.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/main-page.css">
  </head>
  <body>
    <!-- Backgrounds -->
    <div class="background background-menu"></div>
    <div class="background"></div>

    <div id="wrapper">
      <!-- Sign in -->
      <div id="sign-in-page">
        <div class="top">
          <div>Авторизация</div>
          <div class="exit-sign-in">
            <div class="exit-line f-line"></div>
            <div class="exit-line s-line"></div>
          </div>
        </div>

        <div class="main-sign-in-page">
          <form class="" action="index.html" method="post">
            <input type="text" placeholder="Ваш логин" class="main-input">
            <input type="password" placeholder="Ваш пароль" class="main-input">
            <input type="button" value="Войти на сайт" class="main-input">
            <div class="check-block">
              <input type="checkbox" id="check"><label for="check">Запомнить меня</label>
            </div>
          </form>
          <div class="bottom">
            <div class="">
              Забыли пароль?
            </div>

            <div class="">
              Регистрация
            </div>
          </div>
        </div>
      </div>

      <!-- Header -->
      <div id="header">
        <div class="logo main-logo">
          <img class="logo-img" src="images/logo.png">
        </div>

        <ul id="menu">
          <li class="active"><span>Аниме</span></li>
          <li><span>Анонсы</span></li>
          <li><span>Дорамы</span></li>
          <li><span>Онгоинги</span></li>
          <li><span>Статьи</span></li>
          <li><span>Помощь нам</span></li>
        </ul>

        <div id="sign-in">Войти</div>


        <div id="menu-button">
          <div class="menu-lines">
            <div class="menu-line l1"></div>
            <div class="menu-line l2"></div>
            <div class="menu-line l3"></div>
          </div>
        </div>
      </div>

    <!-- main page -->
      <!-- Main -->
      <div id="main">

        <?php
          if(isset($_GET['post'])){
            include 'title_content.php';
          }elseif (isset($_GET['info'])){
            include 'animehub_info.php';
          }elseif (isset($_GET['regist'])) {
            include 'regis.php';
          }elseif (isset($_GET['stol']) || isset($_POST['zButton'])){
            include 'stol.php';
          }elseif (isset($_GET['news'])){
            include 'title_posts.php';
          }elseif (isset($_GET['profile'])){
            include 'profile.php';
          }elseif (isset($_GET['donat'])){
            include 'donat.php';
          }elseif (isset($_GET['prof'])){
            include 'prof.php';
          }else{
            include "animehub.php";
          }
        ?>

        <!-- Navbar -->
      </div>

      <!-- Footer -->
      <div id="footer">
        <div class="top-block">
          <div class="left">
            <div class="logo footer-logo">
              <img class="logo-img" src="images/logo.png">
            </div>

            <div class="questions-block">
              <div class="questions">
                По вопросам рекламы:
              </div>
              <div class="direction">
                <a href="#">Пишите в ВК</a><br>
                <a href="#">На почту:</a>
              </div>
            </div>
          </div>

          <div><a href="#">Связаться с нами</a></div>
          <div>Мы в соц. сетях</div>
        </div>

        <div class="bottom-block">
          &#169; 2018 - 2019 AnimeHub.tj
        </div>
      </div>
    </div>


    <script src="js/menu.js"></script>
    <script src="js/sign_in.js"></script>
    <script src="js/slider.js"></script>
  </body>
</html>
