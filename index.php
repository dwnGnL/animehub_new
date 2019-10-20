<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>AnimeHub</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content ="Аниме портал Таджикистана!">
 
  </head>
  <body>
 
         <!-- Все файлы нужно ставить сюда -->
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
  </body>
</html>
