<!DOCTYPE html>
<html lang="ru">
<head>
    <title>AnimeHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content ="Аниме портал Таджикистана!">
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/main.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/header.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/footer.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/sign_in.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/profile.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/sidebar.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/main-page.css">
    <link rel="stylesheet" href="<?=$uri?>/templates/css/film-list.css">
</head>
<body>
<!-- Backgrounds -->
<div class="background background-menu"></div>
<div class="background background-sign-in"></div>

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
                <input type="text" name="login" placeholder="Ваш логин" class="main-input">
                <input type="text" value="<?=$app->environment['PATH_INFO']?>" name="redirect" placeholder="Ваш логин" class="main-input" hidden>
                <input type="password" name="password" placeholder="Ваш пароль" class="main-input">
                <input type="submit" value="Войти на сайт" name="enter" class="main-input">
                <div class="check-block">
                    <label for="check"><input type="checkbox" id="check"> Запомнить меня</label>
                </div>
            </form>
            <div class="bottom">
                <div class="forget-password">Забыли пароль?</div>
                <div class="registration"><a href="index.php?regist">Регистрация</a></div>
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
                        <a href="#">Пишите в ВК</a><br>
                        <a href="#">На почту:</a>
                    </div>
                </div>
            </div>

            <div class="to-left"><a href="#" class="communication">Связаться с нами</a></div>
            <div class="to-left social">
                <span>Мы в соц. сетях</span>
                <div class="social-item">
                    <div class="social-item-img"><a href="https://vk.com/animehub_tj" target="_blank"><img src="images/vk.png"></a></div>
                    <div class="social-item-img"><a href="https://www.facebook.com/animehub.tj" target="_blank"><img src="images/facebook.png"></a></div>
                    <div class="social-item-img"><a href="https://www.instagram.com/anime_hub_tj" target="_blank"><img src="images/instagram.png"></a></div>
                </div>
            </div>
        </div>

        <div class="bottom-block">
            &#169; 2018 - 2019 AnimeHub.tj
        </div>
    </div>
</div>

<script src="<?=$uri?>/templates/js/menu.js"></script>
<script src="<?=$uri?>/templates/js/sign_in.js"></script>
<script src="<?=$uri?>/templates/js/short-text.js"></script>
<script src="<?=$uri?>/templates/js/current-number.js"></script>
</body>
</html>
