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
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/title_content.css">

    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  </head>
  <body>
    <!-- Backgrounds -->
    <div class="background background-menu"></div>
    <div class="background background-sign-in"></div>

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
            <div class="forget-password">Забыли пароль?</div>
            <div class="registration">Регистрация</div>
          </div>
        </div>
      </div>

      <!-- Header -->
      <div id="header">
        <div class="logo main-logo">
          <img class="logo-img" src="images/logo.png">
        </div>

        <ul id="menu">
          <li class="active sub-menu top-menu">
            <span>Аниме</span>
            <div id="sub-menu">
              <div class="left-part-sub-menu">
                <span class="sub-menu-header">По типу</span>
                <ul class="qualification-list">
                  <li>Запад</li>
                  <li>ТВ</li>
                  <li>OVA</li>
                  <li>Фильм</li>
                  <li>ONA</li>
                </ul>

                <span class="sub-menu-header">По годам</span>
                <ul class="qualification-list">
                  <li>2019</li>
                  <li>2018</li>
                  <li>2017</li>
                  <li>2016</li>
                  <li>2015</li>
                  <li>2014</li>
                  <li>2013</li>
                  <li>2012</li>
                  <li>2011</li>
                  <li>2010</li>
                  <li>2009</li>
                  <li>2008</li>
                  <li>2007</li>
                  <li>2006</li>
                  <li>2005</li>
                  <li>2004</li>
                  <li>2003</li>
                  <li>2002</li>
                  <li>2001</li>
                  <li>2000</li>
                  <li>1999</li>
                  <li>1998</li>
                </ul>
              </div>

              <ul class="middle-part-sub-menu gener-list">
                <li>Апокалипсис</li>
                <li>Боевик</li>
                <li>Боевые искусства</li>
                <li>Вампиры</li>
                <li>Война</li>
                <li>Гарем</li>
                <li>Детектив</li>
                <li>Детское</li>
                <li>Драма</li>
                <li>Игры</li>
                <li>Исторический</li>
                <li>Киберпанк</li>
                <li>Комедия</li>
                <li>Космос</li>
                <li>Магия</li>
                <li>Меха</li>
                <li>Мистика</li>
                <li>Музыка</li>
                <li>Пародия</li>
              </ul>

              <ul class="right-part-sub-menu gener-list">
                <li>Повседневность</li>
                <li>Приключения</li>
                <li>Психология</li>
                <li>Романтика</li>
                <li>Сверхъестественное</li>
                <li>Сказка</li>
                <li>Спорт</li>
                <li>Сёнэн</li>
                <li>Сёдзё</li>
                <li>Триллер</li>
                <li>Ужасы</li>
                <li>Фантастика</li>
                <li>Фэнтези</li>
                <li>Школа</li>
                <li>Экшен</li>
                <li>Этти</li>
                <li>Яой</li>
                <li>Юри</li>
              </ul>
            </div>
          </li>
          <li class="top-menu"><span>Анонсы</span></li>
          <li class="top-menu"><span>Дорамы</span></li>
          <li class="top-menu"><span>Онгоинги</span></li>
          <li class="top-menu"><span>Статьи</span></li>
          <li class="top-menu"><span>Помощь нам</span></li>
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

      <!-- Main page -->
      <div id="main">
        <!-- Main -->
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

        <!-- Sidebar -->
        <div id="sidebar">
          <div class="update-block">
            <div class="sidebar-head">Обновления</div>

            <div class="update">
              <div class="update-item">
                <div class="update-data">Сегодня, 12:00</div>
                <div class="update-bottom">
                  <div class="update-name">Вавилон</div>
                  <div class="update-series">3 серия</div>
                </div>
              </div>
            </div>

            <div class="update">
              <div class="update-item">
                <div class="update-data">Сегодня, 12:00</div>
                <div class="update-bottom">
                  <div class="update-name">Новый мастер кулинарии</div>
                  <div class="update-series">3 серия</div>
                </div>
              </div>
            </div>

            <div class="update">
              <div class="update-item">
                <div class="update-data">Сегодня, 12:00</div>
                <div class="update-bottom">
                  <div class="update-name">Мастер меча</div>
                  <div class="update-series">3 серия</div>
                </div>
              </div>
            </div>

            <div class="update">
              <div class="update-item">
                <div class="update-data">Сегодня, 12:00</div>
                <div class="update-bottom">
                  <div class="update-name">Нет лекарств для моего брата</div>
                  <div class="update-series">62+ special 3 серия</div>
                </div>
              </div>
            </div>

            <div class="update">
              <div class="update-item">
                <div class="update-data">Сегодня, 12:00</div>
                <div class="update-bottom">
                  <div class="update-name">Несносные пришельц</div>
                  <div class="update-series">3 серия</div>
                </div>
              </div>
            </div>
          </div>

          <div class="top-weak">
            <div class="sidebar-head">Топ за неделю</div>

            <div class="top-weak-img">
              <img src="images/image (2).jpg">
            </div>

            <ul class="top-weak-films">
              <li><div class="current-number current-number-active"></div><span class="top-weak-film-name">Ван пис</span></li>
              <li><div class="current-number"></div><span class="top-weak-film-name">Доктор Стоун</span></li>
              <li><div class="current-number"></div><span class="top-weak-film-name">Моя героическая академия 4</span></li>
              <li><div class="current-number"></div><span class="top-weak-film-name">Семь смертных грехов: Гнев Богов</span></li>
              <li><div class="current-number"></div><span class="top-weak-film-name">Мастер меча</span></li>
            </ul>
          </div>

          <div class="advice-block">
            <div class="sidebar-head">Советуем глянуть</div>

            <div id="advice-slider">
              <div class="dots"></div>

              <div class="advice-slider-item">
                <div class="advice-item">
                  <div class="advice-img"><img src="images/image (3).jpg"></div>
                  <div>
                    <div class="advice-name">Блич Краткий сюжет</div>
                    <div class="advice-data">11 декабря 2018, Вторник</div>
                  </div>
                </div>

                <div class="advice-item">
                  <div class="advice-img"><img src="images/image (2).jpg"></div>
                  <div>
                    <div class="advice-name">Блич Краткий сюжет</div>
                    <div class="advice-data">11 декабря 2018, Вторник</div>
                  </div>
                </div>

                <div class="advice-item">
                  <div class="advice-img"><img src="images/image (4).jpg"></div>
                  <div>
                    <div class="advice-name">Блич Краткий сюжет</div>
                    <div class="advice-data">11 декабря 2018, Вторник</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- _______________________ -->
          <div class="comments">
            <div class="sidebar-head">Коментарии</div>

            <div class="comment-item">
              <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

              <div class="comment-user">
                <div class="user-avatar">
                  <img src="images/image (1).jpg">
                </div>
                <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
              </div>
            </div>

            <div class="comment-item">
              <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

              <div class="comment-user">
                <div class="user-avatar">
                  <img src="images/image (1).jpg">
                </div>
                <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
              </div>
            </div>

            <div class="comment-item">
              <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

              <div class="comment-user">
                <div class="user-avatar">
                  <img src="images/image (1).jpg">
                </div>
                <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
              </div>
            </div>

            <div class="comment-item">
              <div class="comment-text">ffas  dsa  fasfa ds asdfasdfa asd fasd</div>

              <div class="comment-user">
                <div class="user-avatar">
                  <img src="images/image (1).jpg">
                </div>
                <div class="comments-name-film">sdasdasd a fasd asd asdfasd</div>
              </div>
            </div>
          </div>
        </div>
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

          <div class="to-left"><a href="#" class="communication">Связаться с нами</a></div>
          <div class="to-left social">
            <span>Мы в соц. сетях</span>
            <div class="social-item">
              <img src="images/vk.png">
              <img src="images/facebook.png">
              <img src="images/instagram.png">
            </div>
          </div>
        </div>

        <div class="bottom-block">
          &#169; 2018 - 2019 AnimeHub.tj
        </div>
      </div>
    </div>


    <script src="js/menu.js"></script>
    <script src="js/sign_in.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/slider-sidebar.js"></script>
    <script src="js/short-text.js"></script>
    <script src="js/current-number.js"></script>
    <script src="js/show-hide-text.js"></script>
  </body>
</html>
