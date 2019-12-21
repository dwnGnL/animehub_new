<?php
require_once  'Model.php';
$model = new Model();
$i = 0;
if($i == 0){
$message = $model->getMessageWhithId($_POST['id_chat']);
if(!empty($message)){
    $colorText = '';
    $vip = $model->getVipka($message['id']);
    if($message['status'] != 0){
        $colorText = $vip['login_color'].' font-family: '.$vip['font'];
    }else{
        $colorText = 'color: black;';
    }
    echo '<div class="my_msg" id-msg="'.$message["id_chat"].'">
    <div class="infos">
        <img src="'.$message["img"].'" alt="avatar" width=45>
        <div class="name_data">
            <span ><a style="'.$colorText.'" href="index.php?prof='.$message['id'].'"><b>'.$message['login'].'</b></a></span><br>
            <span style="font-size:15px;color:gray;">'.($message['time']).'</span>
        </div>
    </div>
    <div class="message">
        <p>'.$message['text'].'</p>
    </div>
</div>';
}
$i = 1;
}
?>
