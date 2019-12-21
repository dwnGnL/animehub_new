<?php
require_once 'Model.php';
$model = new Model();
if(isset($_POST['send']) && isset($_POST['text'])){
    $_POST['text'] = htmlspecialchars($_POST['text']);
    $brobel = trim($_POST['text']);
    if(strlen($brobel) > 0) {
        $model->addMessage($_POST['send'], $_POST['text']);
    }

}

