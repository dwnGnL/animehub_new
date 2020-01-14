<?php

require_once '../lib/Model.php';
$model = new Model();
$model->clearTop();

function generateArrayPost($views, $like,$dislike){
    foreach ($views as $key => $val){
        foreach ($like as $value){
            if ($views[$key]['id_post'] == $value['id_post']){
                $views[$key]['like'] = $value['postLike'];
            }

        }
        foreach ($dislike as $value){
            if ($views[$key]['id_post'] == $value['id_post']){
                $views[$key]['disLike'] = $value['postLike'] + 1;
            }
        }
        if (!isset($views[$key]['disLike'])){
            $views[$key]['disLike'] = 1;
        }
        if (!isset($views[$key]['like'])){
            $views[$key]['like'] = 1;
        }

    }
    return $views;
}
function generateTop(array $data){
    $top = [];
    foreach ($data as $key => $val){
        $top[$key]['rate'] = ceil($data[$key]['views'] * $data[$key]['like'] / $data[$key]['disLike']);
        $top[$key]['id_post'] = $data[$key]['id_post'];
    }
    return $top;
}



  


    $views = $model->getViewsForTop();
    $likeTotal = $model->getLike($views);
    $disLikeTotal = $model->getDisLike($views);
   $arr =  (generateTop(generateArrayPost($views,$likeTotal,$disLikeTotal)));
   foreach ($arr as $value){
       $model->writeTop($value['id_post'], $value['rate']);
   }

?>
