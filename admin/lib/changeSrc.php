<?phpsession_start();require_once 'Parsemix.php';require_once 'Model.php';require_once 'Log.php';$select = new Model();$anime = $select->getAllPostForChangeSrcForScript('http://upload.mix.tj/');foreach ($anime as $value) {    if (!empty($value['rly_path'])) {        if(changeSrc($value['rly_path']) != false){        $select->saveChangeSrc($value['id'], changeSrc($value['rly_path']));        }    }}?>