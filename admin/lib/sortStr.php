<?phpdefine('TV', 'tv');define('SER', 'ser');//Studiadefine('AniDub', 1);define('StudioBand', 3);define('Anilibria', 2);define('AniStar', 4);define('AniMedia', 5);define('Unknown', 6);define('AniMaunt', 7);define('Animevost', 8);//Kachdefine('Good', 1);define('Bad', 2);return 'Model.php';class sortAnime{    public function startSort($str)    {        $regnumber = '/\d/';        $series = [];        $tv = [];        $result = [];        $reg1 = '/ \d\d /i';        $reg2 = '/ \d /i';        $reg3 = '/ \(\d\) /i';        $reg4 = '/ \(\d\d\) /i';        $reg5 = '/ \[\d /i';        $reg6 = '/ \[\d\d /i';        $reg7 = '/ \d\d\d /';        $regtv1 = '/tv-\d/i';        $regtv2 = '/\т\в\-\d/i';        $regsezon = '/ \d |\(\d | \d\)/';        if ((preg_match($reg1, $str, $series)) != false) {            if ((preg_match($regtv1, $str, $tv)) != false ||                (preg_match($regtv2, $str, $tv)) != false) {                preg_match($regnumber, $tv['0'], $tv);            }            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                preg_match($regsezon, $str, $tv);                preg_match($regnumber, $tv[0], $tv);            }            if(!empty($tv)){                $result = [TV => $tv[0], SER => $series[0]];            }else{                $result = [SER => $series[0]];            }        } elseif (((preg_match_all($regsezon, $str, $series)) == 2) &&            strpos(mb_strtolower($str), mb_strtolower('Сезон')) ||            !strpos(mb_strtolower($str), mb_strtolower('Сезон')) &&            ((preg_match_all($reg2, $str, $series)) == 1)) {            if ((preg_match($regtv1, $str, $tv)) != false ||                (preg_match($regtv2, $str, $tv)) != false) {                preg_match($regnumber, $tv[0], $tv);            }            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                preg_match($regsezon, $str, $tv);                preg_match('/\d/', $tv[0], $tv);                $series = $series[0];                $result = [TV => $tv[0], SER => $series[1]];            } else {                $series = $series[0];            }            if(empty($result)){                if(!empty($tv)){                    $result = [TV => $tv[0], SER => $series[0]];                }else{                    $result = [SER => $series[0]];                }            }        }        elseif        (((preg_match($reg3, $str, $series)) != false)){            preg_match('/\d/', $series['0'], $series);            if ((preg_match($regtv1, $str, $tv)) != false ||                (preg_match($regtv2, $str, $tv)) != false) {                preg_match($regnumber, $tv[0], $tv);            }            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                preg_match($regsezon, $str, $tv);                preg_match($regnumber, $tv[0], $tv);            }            if(!empty($tv)){                $result = [TV => $tv[0], SER => $series[0]];            }else{                $result = [SER => $series[0]];            }        }                   // ТУТ REG4        elseif        (((preg_match($reg4, $str, $series)) != false)){            preg_match('/\d\d/', $series['0'], $series);            if ((preg_match($regtv1, $str, $tv)) != false ||                (preg_match($regtv2, $str, $tv)) != false) {                preg_match($regnumber, $tv[0], $tv);            }            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                preg_match($regsezon, $str, $tv);                preg_match($regnumber, $tv[0], $tv);            }            if(!empty($tv)){                $result = [TV => $tv[0], SER => $series[0]];            }else{                $result = [SER => $series[0]];            }        } elseif        (((preg_match($reg5, $str, $series)) != false)){            preg_match('/\d/', $series['0'], $series);            if ((preg_match($regtv1, $str, $tv)) != false ||                (preg_match($regtv2, $str, $tv)) != false) {                preg_match($regnumber, $tv[0], $tv);            }            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                preg_match($regsezon, $str, $tv);                preg_match($regnumber, $tv[0], $tv);            }            if(!empty($tv)){                $result = [TV => $tv[0], SER => $series[0]];            }else{                $result = [SER => $series[0]];            }        } elseif((preg_match($reg6, $str, $series)) != false){            preg_match('/\d\d/', $series['0'], $series);            if ((preg_match($regtv1, $str, $tv)) != false ||                (preg_match($regtv2, $str, $tv)) != false) {                preg_match($regnumber, $tv[0], $tv);            }            if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                preg_match($regsezon, $str, $tv);                preg_match($regnumber, $tv[0], $tv);            }            if(!empty($tv)){                $result = [TV => $tv[0], SER => $series[0]];            }else{                $result = [SER => $series[0]];            }        }elseif (strpos(mb_strtolower($str), mb_strtolower('Моб психо')) === false ){            if (preg_match($reg7, $str, $series)) {                if ((preg_match($regtv1, $str, $tv)) != false ||                    (preg_match($regtv2, $str, $tv)) != false) {                    preg_match($regnumber, $tv[0], $tv);                }                if (strpos(mb_strtolower($str), mb_strtolower('Сезон'))) {                    preg_match($regsezon, $str, $tv);                    preg_match($regnumber, $tv[0], $tv);                }                if(!empty($tv)){                    $result = [TV => $tv[0], SER => $series[0]];                }else{                    $result = [SER => $series[0]];                }            }        }        if(preg_match('/^0/', $result['ser'], $nol)!= false){            $delimetr = $nol[0];            $delimetr = (string)$delimetr;            $ex = explode($delimetr, $str, 2);            $result['ser'] = $ex[1];        }        return $result;    }    public function addNumberSeries($result){        if(isset($result['tv'])){            return $title = ['ser' => $result['ser'], 'tv' => 'Tv-'.$result['tv']];        }else{            return $title = ['ser'=> $result['ser'], 'tv' => ''];        }    }    public function sortStud($stud){        $stud = mb_strtolower($stud);        if(strpos($stud, 'anidub') !== false || strpos($stud, 'jam') !== false || strpos($stud, 'ancord') !== false || strpos($stud, 'JAM') !== false){            $id_stud = AniDub;        }else if(strpos($stud, 'anilibria')!== false){            $id_stud = Anilibria;        }else if(mb_strpos($stud, 'студийная банда') !== false || strpos($stud, 'studioband')!== false){            $id_stud = StudioBand;        }else if(strpos($stud, 'artlight') !== false || strpos($stud, 'kashi') !== false || strpos($stud, 'kingmaster')!==false){            $id_stud = AniMedia;        }else if(strpos($stud, 'anistar')!== false){            $id_stud = AniStar;        }else if(strpos($stud, 'animaunt')!== false){            $id_stud = AniMaunt;        }else if(strpos($stud, 'animevost')!== false){            $id_stud = Animevost;        }        else $id_stud = Unknown;        return $id_stud;    }    public function sortKach($kach){        $mb = explode('Mb', $kach);        if($mb[0] > 180){            $id_kach = Good;        }else{            $id_kach = Bad;        }        return $id_kach;    }    function saveSortTv ($tv){        $model = new Model();        $countTv =  $model->proTvExists($tv) ;        if($countTv['COUNT(*)'] != 0){            return $model->getIdTv($tv);        }else {            $model->addIdTv($tv);            return $this->saveSortTv($tv);        }    }    function saveSortTitle($title){        $model = new Model();        $countTitle = $model->proTitleExists($title);        if($countTitle['COUNT(*)'] != 0){            return $model->getIdTitle($title);        }else{            $model->addIdTitle($title);            return $this->saveSortTitle($title);        }    }    function saveSortGod($title){        $model = new Model();        $countTitle = $model->proGodExists($title);        if($countTitle['COUNT(*)'] != 0){            return $model->getIdGod($title);        }else{            $model->addIdGod($title);            return $this->saveSortGod($title);        }    }    function saveSortCat($title){        $model = new Model();        $countTitle = $model->proCatExists($title);        if($countTitle['COUNT(*)'] != 0){            return $model->getIdCat($title);        }else{            $model->addIdCat($title);            return $this->saveSortCat($title);        }    }    function sortStudForWatch($stud){        $stud = mb_strtolower($stud);        if(strpos($stud, '[anidub]') !== false){            $id_stud = AniDub;        }else if(strpos($stud, '[anilibria]')!== false){            $id_stud = Anilibria;        }else if(strpos($stud, '[studioband]')!== false){            $id_stud = StudioBand;        }else if(strpos($stud, '[animedia]') !== false ){            $id_stud = AniMedia;        }else if(strpos($stud, '[anistar]')!== false){            $id_stud = AniStar;        }else if(strpos($stud, '[animaunt]')!== false){            $id_stud = AniMaunt;        }else if(strpos($stud, '[animevost]')!== false){            $id_stud = Animevost;        }        else $id_stud = Unknown;        return $id_stud;    }    function sortKachForWatch($kach){        $kach = mb_strtolower($kach);        if(strpos($kach, '[hd]') !== false) {            $id_stud = 1;        }else{            $id_stud = 2;        }        return $id_stud;        }}?>