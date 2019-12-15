<?php
session_start();
require_once '../lib/Model.php';
$model = new Model();
if (isset($_GET['kalbasa'])) {
    $check = $model->excessCheckAnime($_GET['link']);
    if ($check['COUNT(*)'] < 1) {

        $mb = explode(' ', $_GET['other'], 3);
        $addAnimeDate = explode(' ', $_GET['other'], 4);
        $date = $mb[2];
        date_default_timezone_set('Asia/Tashkent');


        if (strpos($date, 'Сегодня')) {
            date_default_timezone_set('Asia/Tashkent');
            $time = date('d.m.Y');
            $date = str_replace($date, 'Сегодня', $time);
            $date = $date . ', ' . $addAnimeDate[3];

        } elseif (strpos($date, 'Вчера')) {
            date_default_timezone_set('Asia/Tashkent');
            $time = date('d.m.Y');
            $time = explode('.', $time);
            $forward = $time[0] - 1;
            if (strlen($forward) == 1) {
                $forward = '0' . $forward;
            }
            $forward = $forward . '.' . $time[1] . '.' . $time[2];
            $date = str_replace($date, 'Вчера', $forward);
            $date = $date . ', ' . $addAnimeDate[3];

        } else {

            $date = substr($date, 7);

        }
        $date = substr($date, 0, 17);

        if ($_GET['insert'] == '1') {


            $model->insertParseFirst($_GET['link'], $_GET['name'], $_GET['videosrc'], $mb[0], $date, 1);

        } else {
            $model->insertParse($_GET['link'], $_GET['name'], $_GET['videosrc'], $mb[0], $date);
        }

    } else {
        if ($_GET['insert'] > 1) {
            $model->deleteParseWhithLink($_GET['link']);
        }
        echo '0';
    }




//
//    $data = 'Name: '.$_GET['name'].' src: '.$_GET['videosrc'].' other: '.$_GET['other'].' link: '.$_GET['link'].' insert: '.$_GET['insert'];
//    echo $data;
//    $model->getGo($data);
}

?>
