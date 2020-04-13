<?php
session_start();
if ($_SESSION['status'] == 'Анимешник' || !isset($_SESSION['auth']) || $_SESSION['auth'] == false ||  $_SESSION['status'] == '_Vip_'){
    header('Location:../');
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
<!--  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">-->
<script src="https://kit.fontawesome.com/8859a7c0a5.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="../templates/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">
  <link rel="stylesheet" href="css/normilize.css">
<!--	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>-->
	<script src="../templates/js/jquery-3.3.1.min.js"></script>
	<script src="js/side-bar-script.js"></script>
	<link rel="stylesheet" href="css/side-bar-style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/Animehub.css">
</head>

<body class="grey lighten-5">
  <header>
    <nav class="navbar container  navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid ">

          <a href="../" class="navbar-brand"><span id="logo" style="color: #000;">Anime<span class="hub">Hub</span></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="
          #navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span></button>
          <?php if($_SESSION['status'] == 'Админ'){ ?>
<!--          --><?php
//          require_once 'lib/Model.php';
//          $bd = new Model();
//          $tech = $bd->getTech();
//          $text = '';
//          if($tech == 1){
//              $text = 'Выключить тех...';
//          }else{
//              $text = 'Включить тех...';
//          }
//          ?>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="index.php?uved" class="nav-link waves-effect" id="Users">Уведомление</a>
            </li>
              <?php if($_SESSION['status'] == 'Админ') {?>
                  <li class="nav-item">
                      <a href="http://ce93845.tmweb.ru/AnimeAdmin.php?pars=parse" class="nav-link waves-effect" id="Users">Парсер микса</a>
                  </li>
              <?php }?>
              <li class="nav-item">
                  <a href="index.php?ras" class="nav-link waves-effect" id="Users">Расписание</a>
              </li>
              <li class="nav-item">
<!--                  <a href="#" class="nav-link waves-effect" id="tech" id-text="--><?//=$tech['tech'];?><!--">--><?//=$text;?><!--</a>-->
              </li>
          </ul>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item mr-2">
              <a href="#" class="nav-link border border-light rounded waves-effect">
                <i class="fa fam-facebook"></i>
              </a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link border border-light rounded waves-effect">
                <i class="fa fam-github"></i>
              </a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link border border-light rounded waves-effect">
                <i class="fa fam-twitter"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
        <?php  }?>
    </nav>

    <!-- <div class="sidebar-fixed position-fixed"> -->
      <!--<a href="#" class="logo-wrapper waves-effect">
        <img src="http://tajfile.tj/templates/tajfile/images/logo.png" alt="" class="img-fluid">
      </a> -->

      <!-- <div class="list-group list-group-flush">
        <a href="#" class="list-group-item waves-effect active">
          <i class="fa fa-pie-chart mr-3" id="Item1">Dashboard</i>
        </a>
        <a href="#" class="list-group-item waves-effect ">
          <i class="fa fa-user mr-3" id="Item2">Profile</i>
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fa fa-table mr-3" id="Item3">Tables</i>
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fa fa-map mr-3" id="Item4" >Maps</i>
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fa fa-money mr-3" id="Item5">Orders</i>
        </a>

      </div> -->
      <span class="toggle-button">
        <div class="menu-bar menu-bar-top"></div>
        <div class="menu-bar menu-bar-middle"></div>
        <div class="menu-bar menu-bar-bottom"></div>
      </span>
  <div class="menu-wrap primary-color">
    <div class="menu-sidebar">
      <ul class="menu ">
          <?php if($_SESSION['status'] == 'Админ' || $_SESSION['status'] == 'Модератор'){?>
            <li><a href="index.php?pars=parse" id="Pars" >Парсинг аниме</a></li>

        <li class="menu-item-has-children"><a href="#">Пост</a>
          <span class="sidebar-menu-arrow"></span>
          <ul class="sub-menu">
            <li><a href="index.php?post=post" id="Post">Добавить пост</a></li>
            <li><a href="index.php?posts=posts">Все посты</a></li>
              <li><a href="index.php?EditSrc=EditSrc">Редактор ссылок</a></li>
          </ul>
        </li>
          <?php }?>
          <?php if($_SESSION['status'] == 'Админ' || $_SESSION['status'] == 'Журналист'){?>
          <li class="menu-item-has-children"><a href="#">Новости</a>
              <span class="sidebar-menu-arrow"></span>
              <ul class="sub-menu">
                  <li><a href="Admin/addNews.php">Добавить новость</a></li>
                  <li><a href="index.php?allNews">Все новости</a></li>
              </ul>
          </li>
          <?php }?>
          <?php if($_SESSION['status'] == 'Админ'){?>
        <li class="menu-item-has-children"><a href="index.php?comments=comments">Комментарии</a>
          <span class="sidebar-menu-arrow"></span>
          <ul class="sub-menu">
            <li><a href="index.php?comments=comments">Последние комментарии</a></li>
            <li><a href="#">Все комментарии</a></li>
          </ul>
        </li>
              <li class="menu-item-has-children"><a href="#">Слайдер</a>
                  <span class="sidebar-menu-arrow"></span>
                  <ul class="sub-menu">
                      <li><a href="index.php?slider">Добавить слайд</a></li>
                      <li><a href="index.php?allSlider">Все слайды</a></li>
                  </ul>
              </li>

              <li><a href="index.php?channel=channel" id="channel" >Добавить канал</a></li>
              <li><a href="index.php?vip" id="channel" >Дать випку</a></li>


          <?php }?>
      </ul>			
    </div>
  </div>
    <!-- </div> -->
  </header>

  <div id="content" >
  <?php
    if(isset($_GET['pars'])){
        include "Admin/Parse.php";
    }elseif (isset($_GET['post'])){
        include "Admin/AddPost.php";
    }elseif (isset($_GET['posts']) || isset($_GET['searchPosts'])) {
        include "Admin/allPosts.php";
    } elseif (isset($_GET['edit'])){
        include "Admin/edit.php";
    }elseif (isset($_GET['comments'])){
        include "Admin/comments.php";
    }elseif (isset($_GET['channel'])){
        include 'Admin/channel.php';
    }elseif (isset($_GET['EditSrc'])){
        include 'Admin/EditSrc.php';
    }elseif (isset($_GET['slider'])){
        include 'Admin/slider.php';
    }elseif (isset($_GET['allSlider'])){
        include 'Admin/allSlide.php';
    }elseif (isset($_GET['editSlider'])){
        include 'Admin/editSlider.php';
    }elseif (isset($_GET['allNews']) || $_GET['searchNews']){
        include 'Admin/allNews.php';
    }elseif (isset($_GET['vip'])){
        include 'Admin/vip.php';
    }elseif (isset($_GET['uved'])){
        include 'Admin/uved.php';
    }elseif (isset($_GET['ras'])){
        include 'Admin/raspisanie.php';
    }

  ?>
  </div>




  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="../templates/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/jquery.form.js"></script>
  <script type="text/javascript" src="js/mdb.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script type="text/javascript" src="js/sort.js"></script>
  <script type="text/javascript" src="js/slider.js"></script>
  <script type="text/javascript" src="js/upload.js"></script>
  <script src="js/controlsAllPosts.js"></script>

</body>

</html>
