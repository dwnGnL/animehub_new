<?php


namespace AdminController;


use Lib\Cache;
use Model\Anime;
use Model\Parse;
use Model\Post;
use Model\Title;
use Model\Tv;
use App\Models\Parse as EParse;
use App\Models\Post as EPost;
use App\Models\Anime as EAnime;

class SortController extends AdminController
{
    public function sortView()
    {
        $parseBD = new Parse();
        $anime = $parseBD->getParseSorteView($_POST['title']);
        $result = '';

        foreach ($anime as $key => $val) {
            $result .= $this->app->view()->fetch('dashboard/input.tpl.php', [
                'title' => $anime[$key]['title'],
                'tv' => $this->addNumberSeries($this->startSort($anime[$key]['title'])),
                'id' => $anime[$key]['id'],
                'key' => $key,
            ]);
        }
        $result .= '
                    <script src="' . $this->getUri() . '/templates/dashboard/js/sortRemove.js?' . filemtime('templates/dashboard/js/sortRemove.js') . '"></script>
                    ';

        echo json_encode(['status' => 200, 'html' => $result]);
        exit();
    }

    public function sortDelete()
    {
        $parseBD = new Parse();
        if ($parseBD->deleteSort($_POST['id_parse'])) {
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 500]);
        }
    }

    function saveSortTitle($title)
    {
        $titleBD = new Title();
        $countTitle = $titleBD->check(trim($title));
        if (!empty($countTitle)) {
            return $countTitle['id'];
        } else {
            return $titleBD->addTitle(trim($title));
        }
    }

    function saveSortTv($title)
    {
        $titleBD = new Tv();
        $countTitle = $titleBD->check(trim($title));
        if (!empty($countTitle)) {
            return $countTitle['id'];
        } else {
            return $titleBD->addTitle(trim($title));
        }
    }

    public function saveSort()
    {
        if (empty(trim($_POST['title']))) {
            echo json_encode(['status' == 500]);
            exit();
        }
        $total = count($_POST['anime']) / 3;
        $anime = EParse::where('title', 'LIKE', '%' . $_POST['rlyTitle'] . '%')->get();
        $postBD = new Post();
        $parseBD = new Parse();
        $tv = [];
        $j = 0;
        for ($i = 0; $i < $total; $i++) {
            if (!empty(trim($_POST['anime'][$j]['value'])) && !empty($_POST['anime'][$j + 1]['value'])) {
                $id_tv = $this->saveSortTv($_POST['anime'][$j + 1]['value']);

                $post = EPost::where('title', 'like', '%' . $_POST['title'] . '%')
                    ->where('id_tv', $id_tv)->first();

                if (empty($post)){
                    continue;
                }

                EAnime::create([
                    'rly_path' => $anime[$i]->rly_path,
                    'id_stud' => $this->sortStud($_POST['anime'][$j + 2]['value']),
                    'id_tv' => $id_tv,
                    'id_title' => $this->saveSortTitle($_POST['title']),
                    'id_kach' => $this->sortKach($anime[$i]->size),
                    'src' => $anime[$i]->src,
                    'seria' => $_POST['anime'][$j]['value'],
                    'mix_title' => $_POST['anime'][$j + 2]['value'],
                    'post_id' => $post->id,
                ]);

                if (!array_search($id_tv, $tv)) {
                    $tv = array_merge($tv, (array)$id_tv);
                }

            }
            if (!empty($tv) && count($tv) > 1) {
                for ($k = 0; $k < count($tv); $k++) {
                    $postBD->postDateUpdate($_POST['title'], $tv[$k]);
                }
            } else {
                $postBD->postDateUpdate($_POST['title'], $tv[0]);
            }
            $parseBD->deleteParseRdy($_POST['title']);
            $j += 3;
        }
        $cache = new Cache();
        $cache->delete('posts');
        echo json_encode(['status' => 200]);
        exit();

    }

    public function sortKach($kach)
    {

        $mb = explode('Mb', $kach);

        if ($mb[0] > 180) {

            $id_kach = 1;

        } else {

            $id_kach = 2;

        }

        return $id_kach;

    }

    public function startSort($str)
    {
        define('TV', 'tv');

        define('SER', 'ser');

        $regnumber = '/\d/';

        $series = [];
        $tv = [];
        $result = [];
        $reg1 = '/ \d\d /i';
        $reg2 = '/ \d /i';
        $reg3 = '/ \(\d\) /i';
        $reg4 = '/ \(\d\d\) /i';
        $reg5 = '/ \[\d /i';
        $reg6 = '/ \[\d\d /i';
        $reg7 = '/ \d\d\d /';
        $regtv1 = '/tv-\d/i';
        $regtv2 = '/\т\в\-\d/i';
        $regsezon = '/ \d |\(\d | \d\)/';

        if ((preg_match($reg1, $str, $series)) != false) {

            if ((preg_match($regtv1, $str, $tv)) != false ||

                (preg_match($regtv2, $str, $tv)) != false) {

                preg_match($regnumber, $tv['0'], $tv);

            }
            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                preg_match($regsezon, $str, $tv);

                preg_match($regnumber, $tv[0], $tv);
            }
            if (!empty($tv)) {
                $result = [TV => $tv[0], SER => $series[0]];
            } else {
                $result = [SER => $series[0]];
            }
        } elseif (((preg_match_all($regsezon, $str, $series)) == 2) &&

            strpos(mb_strtolower($str), mb_strtolower('Сезон')) ||

            !strpos(mb_strtolower($str), mb_strtolower('Сезон')) &&

            ((preg_match_all($reg2, $str, $series)) == 1)) {

            if ((preg_match($regtv1, $str, $tv)) != false ||

                (preg_match($regtv2, $str, $tv)) != false) {

                preg_match($regnumber, $tv[0], $tv);
            }
            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                preg_match($regsezon, $str, $tv);

                preg_match('/\d/', $tv[0], $tv);

                $series = $series[0];

                $result = [TV => $tv[0], SER => $series[1]];

            } else {
                $series = $series[0];
            }
            if (empty($result)) {

                if (!empty($tv)) {
                    $result = [TV => $tv[0], SER => $series[0]];
                } else {
                    $result = [SER => $series[0]];
                }
            }
        } elseif

        (((preg_match($reg3, $str, $series)) != false)) {

            preg_match('/\d/', $series['0'], $series);

            if ((preg_match($regtv1, $str, $tv)) != false ||

                (preg_match($regtv2, $str, $tv)) != false) {

                preg_match($regnumber, $tv[0], $tv);
            }
            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                preg_match($regsezon, $str, $tv);

                preg_match($regnumber, $tv[0], $tv);
            }
            if (!empty($tv)) {
                $result = [TV => $tv[0], SER => $series[0]];
            } else {
                $result = [SER => $series[0]];
            }
        }                   // ТУТ REG4
        elseif
        (((preg_match($reg4, $str, $series)) != false)) {

            preg_match('/\d\d/', $series['0'], $series);

            if ((preg_match($regtv1, $str, $tv)) != false ||

                (preg_match($regtv2, $str, $tv)) != false) {

                preg_match($regnumber, $tv[0], $tv);
            }
            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                preg_match($regsezon, $str, $tv);

                preg_match($regnumber, $tv[0], $tv);
            }
            if (!empty($tv)) {
                $result = [TV => $tv[0], SER => $series[0]];
            } else {
                $result = [SER => $series[0]];
            }

        } elseif
        (((preg_match($reg5, $str, $series)) != false)) {

            preg_match('/\d/', $series['0'], $series);

            if ((preg_match($regtv1, $str, $tv)) != false ||

                (preg_match($regtv2, $str, $tv)) != false) {

                preg_match($regnumber, $tv[0], $tv);
            }
            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                preg_match($regsezon, $str, $tv);

                preg_match($regnumber, $tv[0], $tv);
            }
            if (!empty($tv)) {
                $result = [TV => $tv[0], SER => $series[0]];

            } else {

                $result = [SER => $series[0]];
            }

        } elseif ((preg_match($reg6, $str, $series)) != false) {

            preg_match('/\d\d/', $series['0'], $series);

            if ((preg_match($regtv1, $str, $tv)) != false ||

                (preg_match($regtv2, $str, $tv)) != false) {

                preg_match($regnumber, $tv[0], $tv);

            }
            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                preg_match($regsezon, $str, $tv);

                preg_match($regnumber, $tv[0], $tv);

            }
            if (!empty($tv)) {
                $result = [TV => $tv[0], SER => $series[0]];
            } else {
                $result = [SER => $series[0]];
            }

        } elseif (strpos(mb_strtolower($str), mb_strtolower('Моб психо')) === false) {

            if (preg_match($reg7, $str, $series)) {

                if ((preg_match($regtv1, $str, $tv)) != false ||

                    (preg_match($regtv2, $str, $tv)) != false) {

                    preg_match($regnumber, $tv[0], $tv);
                }
                if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {

                    preg_match($regsezon, $str, $tv);

                    preg_match($regnumber, $tv[0], $tv);
                }

                if (!empty($tv)) {

                    $result = [TV => $tv[0], SER => $series[0]];

                } else {

                    $result = [SER => $series[0]];

                }
            }
        }
        if (preg_match('/^0/', $result['ser'], $nol) != false) {
            $delimetr = $nol[0];
            $delimetr = (string)$delimetr;
            $ex = explode($delimetr, $str, 2);
            $result['ser'] = $ex[1];

        }
        return $result;
    }

    public function sortStud($stud)
    {

        define('AniDub', 1);

        define('StudioBand', 3);

        define('Anilibria', 2);

        define('AniStar', 4);

        define('AniMedia', 5);

        define('Unknown', 6);

        define('AniMaunt', 7);

        define('Animevost', 8);
        $stud = mb_strtolower($stud);

        if (strpos($stud, 'anidub') !== false || strpos($stud, 'jam') !== false || strpos($stud, 'ancord') !== false || strpos($stud, 'JAM') !== false) {

            $id_stud = AniDub;

        } else if (strpos($stud, 'anilibria') !== false) {

            $id_stud = Anilibria;

        } else if (mb_strpos($stud, 'студийная банда') !== false || strpos($stud, 'studioband') !== false) {

            $id_stud = StudioBand;

        } else if (strpos($stud, 'artlight') !== false || strpos($stud, 'kashi') !== false || strpos($stud, 'kingmaster') !== false) {

            $id_stud = AniMedia;

        } else if (strpos($stud, 'anistar') !== false) {

            $id_stud = AniStar;

        } else if (strpos($stud, 'animaunt') !== false) {

            $id_stud = AniMaunt;

        } else if (strpos($stud, 'animevost') !== false) {

            $id_stud = Animevost;

        } else $id_stud = Unknown;

        return $id_stud;
    }

    public function addNumberSeries($result)
    {
        if (isset($result['tv'])) {
            return $title = ['ser' => trim($result['ser']), 'tv' => 'Tv-' . $result['tv']];
        } else {
            return $title = ['ser' => trim($result['ser']), 'tv' => ''];
        }
    }


}
