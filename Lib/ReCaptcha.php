<?php


namespace Lib;


class ReCaptcha
{
    public static function display()
    {
        echo '<div class="g-recaptcha" data-sitekey="' . RECAPTCHA_SITE_KEY . '"></div>';
    }

    public static function renderJs()
    {
        echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }

    public static function validate($captcha, $required = true)
    {
        if ($required){
            if (empty($captcha)){
                return  false;
            }
            if (!self::request($captcha)){
                return false;
            }
        }
        return  true;
    }

    private static function request($captcha)
    {
        $secretKey = RECAPTCHA_SECRET_KEY;
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            return true;
        } else {
           return false;
        }
    }

}
