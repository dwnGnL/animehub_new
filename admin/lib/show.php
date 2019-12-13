<?php
require_once 'Model.php';
session_start();
$model = new Model();
$massage = $model->getMessage();

foreach ($massage as $value){
    $colorText = '';
    $vip = $model->getVipka($value['id']);
    if($value['status'] != 0){
        $colorText = $vip['login_color'].' font-family: '.$vip['font'];
    }else {
        $colorText = 'color: black;';
    }
?>
    <div class="my_msg" id-msg="<?=$value['id_chat']?>">
    <div class="infos">
        <img src="<?=$value['img']?>" alt="avatar" width=45>
        <div class="name_data">
            <span ><a style="<?=$colorText?>" href="index.php?prof=<?=$value['id']?>"><b><?=$value['login']?></b></a></span><br>
            <span style="font-size:15px;color:gray;"><?=$value['time']?></span>
        </div>
    </div>
    <div class="message">
        <p><?=$value['text']?></p>
    </div>
</div>

<?php }?>