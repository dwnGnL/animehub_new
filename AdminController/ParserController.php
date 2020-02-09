<?php


namespace AdminController;


use Lib\Curl;
use Model\Channel;
use Model\Parse;
use function Composer\Autoload\includeFile;

require_once 'lib/phpQuery.php';
class ParserController extends AdminController
{

    public function index()
    {
        $channelBD = new Channel();
        $channels = $channelBD->getChannels();
        $this->index = $this->app->view()->fetch('dashboard/parser.tpl.php', [
            'channels' => $channels,
        ]);
        $this->display();
    }


    public function start()
    {
        if (!empty(trim($_POST['title']))) {
            $title = $_POST['title'];
            $startPage = !empty(trim($_POST['startPage']))? $_POST['startPage'] : 1;
            $endPage = !empty(trim($_POST['endPage']))? $_POST['endPage'] : 100;
            $startVideo = !empty(trim($_POST['startVideo']))? $_POST['startVideo'] : 1 ;
            $endVideo = !empty(trim($_POST['endVideo']))? $_POST['endVideo'] : 24;
            if ($_POST['site'] == 1) {
              $total =  $this->mixParser($title, $startPage,$endPage, $startVideo,$endVideo);
              echo json_encode(['total' => $total]);
        }elseif ($_POST['site'] == 2){
              $total =  $this->topParser($title, $startPage,$endPage, $startVideo,$endVideo);
              echo json_encode(['total' => $total]);
            }
        }

    }

    public function topParser($poisk, $start = 1, $end= 100,$startVideo = 1, $endVideo = 24){
        $stop = null;
        $insert = new Parse();
        $countInsert = 0;
        if($start <= $end) {

            $search = str_replace(' ', '+', $poisk);
            $html = Curl::curl_get("http://topvideo.tj/site/search?q=$search&page=$start");

            $doc = \phpQuery::newDocument($html);

            for ($i = $startVideo - 1; $i <= $endVideo - 1; $i++) {
                if ($doc->find('.previews' . " .preview:eq($i)")->attr('href')) {
                    $href = $doc->find('.previews' . ' .preview:eq('.$i.')')->attr('href');
                    $rly_path = $href;
                    $go = Curl::curl_get('http://topvideo.tj' . $href);
                    $newcon = \phpQuery::newDocument($go);
                    $src = $newcon->find('source')->attr('src');
                    $size = $newcon->find('.videodetails__fileinfo')->text();
                    $mb = explode(' ', $size);
                    $date = $mb[2].' '.$mb[3];
                    $title = $newcon->find('.videodetails__title')->text();
                    $dateCheck = $insert->excessCheckAnime($rly_path);
                    if($dateCheck['COUNT(*)'] > 0 && $countInsert > 0){
                        $insert->updateAnimeStatusFirst($rly_path);
                        $insert->deleteAnimeExcess($title);

                        $stop = 'stop';
                    }
                    if($dateCheck['COUNT(*)'] > 0){

                        $stop = 'stop';

                        break;
                    }else {

                        if($i==0 && $start == 1){
                            $insert->insertParse($rly_path,$title, $src,$mb[6],$date,1);
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
              $countInsert += parseTopVideo($poisk,$start,$end);
            }
        }
       return $countInsert;
    }
    public function mixParser($poisk, $start = 1, $end= 100,$startVideo = 1, $endVideo = 24)
    {
        $stop = null;
        $insert = new Parse();
        $countInsert = 0;
        $str = 'Поиск '.$poisk.' старт '.$start.' энд '.$end.' стартвидео '.$startVideo.' конец видео '.$endVideo;
        if($start <= $end) {
            $search = str_replace(' ', '+', $poisk);

            $html = Curl::curl_get("http://mix.tj/index.php?do=poisk&s=$search&so=0&st=0&sd=0&sc=0&page=$start");
            $doc = \phpQuery::newDocument($html);

            for ($i = $startVideo - 1 ; $i <= $endVideo - 1; $i++) {
                if ($doc->find('.mixx-sub-wrap:eq(1)' . " article:eq($i)" . ' a')->attr('href')) {

                    $href = $doc->find('.mixx-sub-wrap:eq(1)' . " article:eq($i)" . ' a')->attr('href');
                    $rly_path = $href;
                    $go = Curl::curl_get('http://mix.tj' . $href);
                    $newcon = \phpQuery::newDocument($go);


                    $size = $newcon->find('.autoplay-group')->text();

                    $href = explode('/', $href);
                    $embed = Curl::curl_get('http://mix.tj/embed/'. $href[2]);
                    $embed = \phpQuery::newDocument($embed);
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


                    if(!empty($dateCheck['id']) && $countInsert > 0){
                        $insert->updateAnimeStatusFirst($rly_path);
                        $insert->deleteAnimeExcess($rly_path);
                        $stop = 'stop';
                    }
                    if(!empty($dateCheck['id'])){
                        $stop = 'stop';
                        break;
                    }else {



                        if($i==0 && $start == 1){

                            $insert->insertParse($rly_path, $title, $src,$mb[0],$date,1);
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
            $countInsert += $this->mixParser($poisk,$start,$end);

            }
        }
        return $countInsert;
    }
    public function checkDate($baseDate, $currentDate){
        if (strtotime($baseDate) < strtotime($currentDate)){
            return true;
        }
        return false;
    }
    public function startChannel(){
        if (!empty(trim($_POST['title']))) {
            $title = $_POST['title'];
            $startPage = !empty(trim($_POST['startPage'])) ? $_POST['startPage'] : 1;
            $endPage = !empty(trim($_POST['endPage'])) ? $_POST['endPage'] : $startPage;
            $startVideo = !empty(trim($_POST['startVideo'])) ? $_POST['startVideo'] : 1;
            $endVideo = !empty(trim($_POST['endVideo'])) ? $_POST['endVideo'] : 24;
            $parse = new Parse();
            $excess = $parse->getParseStatus1($title);
            $total =  $this->parseChannel($_POST['channel'], $title, $startPage, $endPage, $startVideo, $endVideo, !empty($excess) ? $excess : '' );
            if (!empty($excess)){
              $anime = $parse->getParseWithTitle($_POST['title']);
              if (count($anime) > 1){
                  $temp['max'] = strtotime($anime[0]['date']) ;
                  $temp['id'] = $anime[0]['id'];
                  foreach ($anime as $val){
                      if ($temp['max'] < strtotime($val['date']) ){
                          $temp['max'] = strtotime($val['date']);
                          $temp['id'] = $val['id'];
                      }
                  }
                  $parse->Update($temp['id'], $_POST['title']);
              }
            }
            echo json_encode(['total' => $total]);
        }
    }

    public function parseChannel($channel, $anime, $pageStart = 1, $pageEnd = 1, $startVideo = 1, $endVideo = 24, $excess = '')
    {
        $insert = new Parse();
        $tempPage = $pageStart;
        $f = 0;
        while ($pageStart <= $pageEnd) {

            $html = Curl::curl_get('http://mix.tj/channel/' . $channel . '?top=new&page=' . $pageStart);

            $doc = \phpQuery::newDocument($html);
            if ($pageStart == $pageEnd) {
                $end = $endVideo;
            } else {
                $end = 24;
            }
            if ($tempPage != $pageStart) {
                $FahmidanStatusa = 1;
                $startVideo = 0;
            } else {
                $FahmidanStatusa = 0;
            }

            for ($i = $startVideo - 1; $i < $end; $i++) {
                if ($doc->find('.mixx-sub-wrap' . " article:eq($i)" . ' a')->attr('href')) {
                    $title = $doc->find('.mixx-sub-wrap' . " article:eq($i)" . ' a')->text();
                    if (mb_strpos(mb_strtolower($title), mb_strtolower($anime)) !== false) {

                        $href = $doc->find('.mixx-sub-wrap' . " article:eq($i)" . ' a')->attr('href');

                        $rly_path = $href;
                        $go = Curl::curl_get('http://mix.tj' . $href);
                        $newcon = \phpQuery::newDocument($go);


                        $size = $newcon->find('.autoplay-group')->text();

                        $href = explode('/', $href);
                        $embed = Curl::curl_get('http://mix.tj/embed/' . $href[2]);
                        $embed = \phpQuery::newDocument($embed);
                        $vid = $embed->find('script')->text();
                        $vid = substr($vid, 65, 120);
                        $delimetr = '"';
                        $vid = explode($delimetr, $vid, 3);
                        $src = $vid[1];


                        $mb = explode(' ', $size, 3);
                        $addAnimeDate = explode(' ', $size, 4);
                        $date = $mb[2];
                        date_default_timezone_set('Asia/Tashkent');
                        date_default_timezone_set('Asia/Tashkent');
                        $time = date('d.m.Y');
                        $date = str_replace($date, 'Сегодня', $time);
                        $date = $date . ', ' . $addAnimeDate[3];
                        $date = substr($date, 0, 17);


                        if (empty($excess)) {

                            if ($FahmidanStatusa == 1) {

                                $insert->insertParse($rly_path, $title, $src, $mb[0], $date);
                                $f++;

                            } else {

                                $insert->insertParse($rly_path, $title, $src, $mb[0], $date, 1);
                                $FahmidanStatusa = 1;
                                $f++;
                            }
                        } else {
                            if ($excess['rly_path'] == $rly_path && $FahmidanStatusa == 1) {
                                $insert->deleteAnimeExcess($rly_path);
                            } elseif ($FahmidanStatusa == 0) {
                                if ($excess['rly_path'] == $rly_path) {
                                    break;
                                }
                                if ($this->checkDate($excess['date'], $date)) {

                                    $insert->insertParse($rly_path, $title, $src, $mb[0], $date, 1);
                                } else {
                                    $insert->insertParse($rly_path, $title, $src, $mb[0], $date, 0);
                                }

                                $f++;
                                $FahmidanStatusa = 1;
                            } else {
                                $insert->insertParse($rly_path, $title, $src, $mb[0], $date);
                                $f++;
                            }
                        }


                    } else {
                        continue;
                    }
                }

            }
            $pageStart++;

        }

        return $f;
    }

    protected function display()
    {
        $this->main = $this->index;
        parent::display(); // TODO: Change the autogenerated stub
    }
}