<?php
require_once '../lib/Model.php';
session_start();

$model = new Model();

if(isset($_POST['title'])&& isset($_POST['editor']) && isset($_POST['img']))  {

    $model->addNews($_POST['title'], $_POST['img'],$_POST['editor'],time(),$_SESSION['id']);

    echo 'Вы успешно добавили новость! <a href="../index.php">AnimeHub.tj</a> <a href="../index.php">Админка</a>  <a href="addNews.php">Добавить новость</a>';
}else{
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap шаблон</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <style>
    label {
    display: inline-block;
    width: 45%;
    margin-right: 40px;
    margin-bottom: 5px;
    font-weight: 700;
}
body{
  background:#e2e2ff;
}
    .container{
      background:#eaeaea;
      min-height:90vh;
    }
    </style>
<div class="container">
    <form action="addNews.php" method="post">
      <div>
      <label>Загаловок статьи<input class="form-control" style="margin-bottom: 5px; margin-top: 20px;"  name="title" placeholder="Загаловок статьи" required></label>
      <label>Ссылка на картинку<input class="form-control" style="margin-bottom: 5px; margin-top: 20px;"  name="img" placeholder="Ссылка на картинку" required></label>
      </div>
		<textarea id="editor" name="editor"></textarea>
        <input type="submit" class="btn btn-primary" style="float:right;" value="сохранить" name="save">
    </form>
    </div>
		<script type="text/javascript">
		var editor = CKEDITOR.replace('editor',{height: 300});
		AjexFileManager.init({returnTo: 'ckeditor', editor: editor});
		</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php }?>