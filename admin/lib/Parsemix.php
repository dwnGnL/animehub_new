<?php
session_start();
set_time_limit(0);
    require_once 'phpQuery.php';
    require_once 'curl.php';
    require 'Model.php';

    function Parser($poisk, $start = 1, $end= 100,$startVideo = 1, $endVideo = 24)
    {
        $stop = null;
        $insert = new Model();
        $countInsert = 0;
        $str = 'Поиск '.$poisk.' старт '.$start.' энд '.$end.' стартвидео '.$startVideo.' конец видео '.$endVideo;
        if($start <= $end) {
                $search = str_replace(' ', '+', $poisk);

                $html = curl_get("http://mix.tj/index.php?do=poisk&s=$search&so=0&st=0&sd=0&sc=0&page=$start");
            $doc = phpQuery::newDocument($html);

            for ($i = $startVideo - 1 ; $i <= $endVideo - 1; $i++) {
                if ($doc->find('.mixx-sub-wrap:eq(1)' . " article:eq($i)" . ' a')->attr('href')) {

                    $href = $doc->find('.mixx-sub-wrap:eq(1)' . " article:eq($i)" . ' a')->attr('href');
                    $rly_path = $href;
                    $go = curl_get('http://mix.tj' . $href);
                    $newcon = phpQuery::newDocument($go);


                    $size = $newcon->find('.autoplay-group')->text();

                        $href = explode('/', $href);
                        $embed = curl_get('http://mix.tj/embed/'. $href[2]);
                        $embed = phpQuery::newDocument($embed);
                        $vid = $embed->find('script')->text();
                        $vid = substr($vid, 65,120);
                        $delimetr = '"';
                        $vid = explode($delimetr, $vid,3 );
                        $src = $vid[1];


                    $mb = explode(' ', $size, 3);
                    $addAnimeDate = explode(' ', $size, 4);
                    $date = $mb[2];
                    date_default_timezone_set('Asia/Tashkent');


                    if (strpos($date, 'Сегодня')){
                        date_default_timezone_set('Asia/Tashkent');
                        $time = date('d.m.Y');
                        $date = str_replace($date,'Сегодня', $time);
                        $date = $date.', '.$addAnimeDate[3];

                    }elseif (strpos($date, 'Вчера')){
                        date_default_timezone_set('Asia/Tashkent');
                        $time = date('d.m.Y');
                        $time = explode('.',$time );
                        $forward = $time[0] - 1;
                        if(strlen($forward) == 1){
                            $forward = '0'.$forward;
                        }
                        $forward = $forward.'.'.$time[1].'.'.$time[2];
                        $date = str_replace($date,'Вчера', $forward);
                        $date = $date.', '.$addAnimeDate[3];
                        }else{

                      $date = substr($date, 7);
                    }
                        $date = substr($date, 0, 17);
                        $title = $newcon->find('.single-title')->text();
                        $dateCheck = $insert->excessCheckAnime($rly_path);


                        if($dateCheck['COUNT(*)'] > 0 && $countInsert > 0){
                            $insert->updateAnimeStatusFirst($rly_path);
                            $insert->deleteAnimeExcess($title);
                            echo 'аниме уже добавлен';
                            $stop = 'stop';
                        }
                    if($dateCheck['COUNT(*)'] > 0){

                        echo 'аниме уже добавлен';
                        $stop = 'stop';

                        break;
                    }else {



                        if($i==0 && $start == 1){

                            $insert->insertParseFirst($rly_path, $title, $src,$mb[0],$date,1);


                            $countInsert++;
                        }else{

                        $insert->insertParse($rly_path, $title, $src, $mb[0], $date);
                            $countInsert++;
                        }

                    }

                } else {
                    $stop = "stop";
                    break;
                }
            }
                if($stop === null){

                    $start++;
                    Parser($poisk,$start,$end);

                }
        }
        echo'<br>Парсинг закончен';
    }



    function parseChannel($channel, $anime, $pageStart = 1, $pageEnd = 1, $startVideo = 1, $endVideo = 24)
    {
        $insert = new Model();
        $tempPage = $pageStart;
        while ($pageStart <= $pageEnd){
        $html = curl_get('http://mix.tj/channel/'.$channel.'?top=new&page='.$pageStart);
        $doc = phpQuery::newDocument($html);
        if ($pageStart == $pageEnd){
            $end = $endVideo;
        }else{
            $end = 24;
        }
        if ($tempPage != $pageStart){
            $FahmidanStatusa = 1;
            $startVideo = 0;
        }else{
            $FahmidanStatusa = 0;
        }

        for ($i = $startVideo - 1; $i < $end; $i++) {
            if ($doc->find('.mixx-sub-wrap' . " article:eq($i)" . ' a')->attr('href')) {

                $href = $doc->find('.mixx-sub-wrap' . " article:eq($i)" . ' a')->attr('href');
                $rly_path = $href;

                $go = curl_get('http://mix.tj' . $href);
                $newcon = phpQuery::newDocument($go);
                $title = $newcon->find('.single-title')->text();
                if (mb_strpos(mb_strtolower($title), mb_strtolower($anime)) !== false){



                $size = $newcon->find('.autoplay-group')->text();

                    $href = explode('/', $href);
                    $embed = curl_get('http://mix.tj/embed/'. $href[2]);
                    $embed = phpQuery::newDocument($embed);
                    $vid = $embed->find('script')->text();
                    $vid = substr($vid, 65,120);
                    $delimetr = '"';
                    $vid = explode($delimetr, $vid,3 );
                    $src = $vid[1];


                    $mb = explode(' ', $size, 3);
                $addAnimeDate = explode(' ', $size, 4);
                $date = $mb[2];
                date_default_timezone_set('Asia/Tashkent');
                    date_default_timezone_set('Asia/Tashkent');
                    $time = date('d.m.Y');
                    $date = str_replace($date, 'Сегодня', $time);
                    $date = $date . ', ' . $addAnimeDate[3];
                    $date = substr($date, 0,17);


                        $dateCheck = $insert->excessCheckAnime($rly_path);

                        if ($dateCheck['COUNT(*)'] > 0 && $FahmidanStatusa == 1) {

                            $insert->updateAnimeStatusFirst($rly_path);
                            $insert->deleteAnimeExcess($src);
                            echo 'Такой аниме уже добавлен';
                            break;
                        } elseif ($FahmidanStatusa == 0) {

                            $insert->updateAnimeStatusFirstChannel($rly_path);
                            $insert->deleteAnimeExcessWithTitle($anime);
                            $insert->insertParseFirst($rly_path, $title, $src, $mb[0], $date,  1);
                            $FahmidanStatusa = 1;
                        } else {

                            $insert->insertParse($rly_path, $title, $src, $mb[0], $date);
                        }




                }else{
                continue;
            }
            }
        }
        $pageStart++;
        }
    }


    function changeSrc($href){
        $href = explode('/', $href);
        $embed = curl_get('http://mix.tj/embed/'. $href[2]);
        $embed = phpQuery::newDocument($embed);
        $src = '';
       if($embed->find('script')) {
           $vid = $embed->find('script')->text();
           $vid = substr($vid, 65,120);
           $delimetr = '"';
           $vid = explode($delimetr, $vid,3 );
           $src = $vid[1];
       }
        if(!empty($src)){
            return $src;

        }else{

            return false;
        }

    }

function changeSrcTopVideo($href){
    $embed = curl_get('http://topvideo.tj'.$href);
    $embed = phpQuery::newDocument($embed);
    $src = '';
    if($embed->find('source')->attr('src')) {
        $src = $embed->find('source')->attr('src');
    }

    if(!empty($src)){
        return $src;
    }else{
        return false;
    }

}


function changeImg($titleAnime)
{
    $search = str_replace(' ', '+', $titleAnime);
    $html = curl_get('http://mix.tj/?do=poisk&s=' . $search);
    $doc = phpQuery::newDocument($html);
    $img = $doc->find('.mixx-sub-wrap:eq(1)' . " article:eq(0)" . ' img')->attr('data-src');
    if(strpos($img, 'default.jpg')){
        $img = 'http://mix.tj'.$img;
    }
    return $img;

}


function parseTopVideo($poisk, $start = 1, $end = 20, $startVideo = 1, $endVideo = 20){
            $stop = null;
            $insert = new Model();
            $countInsert = 0;
            if($start <= $end) {

                    $search = str_replace(' ', '+', $poisk);
                    $html = curl_get("https://topvideo.tj/site/search?q=$search&page=$start");

                $doc = phpQuery::newDocument($html);

                for ($i = $startVideo - 1; $i <= $endVideo - 1; $i++) {
                    if ($doc->find('.previews' . " .preview:eq($i)")->attr('href')) {


                        $href = $doc->find('.previews' . ' .preview:eq('.$i.')')->attr('href');
                        $rly_path = $href;
                        $go = curl_get('https://topvideo.tj' . $href);
                        $newcon = phpQuery::newDocument($go);
                        $src = $newcon->find('source')->attr('src');

                        $size = $newcon->find('.videodetails__fileinfo')->text();

                        $mb = explode(' ', $size);

                        $date = $mb[2].' '.$mb[3];

                        $title = $newcon->find('.videodetails__title')->text();

                        $dateCheck = $insert->excessCheckAnime($rly_path);


                        if($dateCheck['COUNT(*)'] > 0 && $countInsert > 0){
                            $insert->updateAnimeStatusFirst($rly_path);
                            $insert->deleteAnimeExcess($title);
                            echo 'аниме уже добавлен';
                            $stop = 'stop';
                        }
                        if($dateCheck['COUNT(*)'] > 0){

                            echo 'аниме уже добавлен';
                            $stop = 'stop';

                            break;
                        }else {



                            if($i==0 && $start == 1){

                                $insert->insertParseFirst($rly_path,$title, $src,$mb[6],$date,1);
                                $countInsert++;

                            }else{

                                $insert->insertParse($rly_path,$title, $src, $mb[6], $date);
                                $countInsert++;
                            }

                        }

                    } else {
                        $stop = "stop";
                        break;
                    }
                }
                if($stop === null){
                        $start++;
                        parseTopVideo($poisk,$start,$end);
                }
            }
            echo'<br>Парсинг закончен';


}


?>





