<?php
function generateSalt($saltLength = 8)
{
    $salt = '';
    for($i=0; $i<$saltLength; $i++) {
        $salt .= chr(mt_rand(33,126)); //символ из ASCII-table
    }
    return $salt;
}

function createToken(){
    $token = md5(generateSalt(32).session_name());
    return $token;
}
?>