<?phprequire_once 'Parsemix.php';require_once 'Model.php';$select = new Model();$anime = $select->getAllPostForChangeSrcTopVideoForScript('http://topvideo.tj/video/');foreach ($anime as $value) {    if (!empty($value['rly_path'])) {        if(changeSrcTopVideo($value['rly_path']) != false){        $select->saveChangeSrc($value['id'], changeSrcTopVideo($value['rly_path']));        }    }}?>