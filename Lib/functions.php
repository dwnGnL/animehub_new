<?php
function debug($string)
{
    echo '<pre>';
    var_dump($string);
    echo '</pre>';
    exit();
}

function clear_str($var)
{

    return strip_tags(trim($var));
}

function generateSalt($saltLength = 8)
{
    $salt = '';
    for ($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33, 126)); //символ из ASCII-table
    }
    return $salt;
}

function isLaravel($str)
{
    if (str_contains($str, 'storage/uploads/avatars')) {
        return true;
    }
    return false;
}

function viewAvatar($str)
{
    if (isLaravel($str)){
        return BASE_URl.'/'.$str;
    }
    return $str;
}
