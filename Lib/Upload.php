<?php


namespace Lib;


class Upload
{

  public static  function can_upload($file)
    {
        // если имя пустое, значит файл не выбран
        if ($file['name'] == '')
            return false;

        /* если размер файла 0, значит его не пропустили настройки
        сервера из-за того, что он слишком большой */
        if ($file['size'] == 0)
            return false;

        // разбиваем имя файла по точке и получаем массив
        $getMime = explode('.', $file['name']);
        // нас интересует последний элемент массива - расширение
        $mime = strtolower(end($getMime));
        // объявим массив допустимых расширений
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

        // если расширение не входит в список допустимых - return
        if (!in_array($mime, $types))
            return 'Недопустимый тип файла.';

        return true;
    }

    public static function make_upload($file)
    {
        // формируем уникальное имя картинки: случайное число и name
        $name = mt_rand(0, 10000) . $file['name'];
        copy($file['tmp_name'], 'images/shop/' . $name);
        return 'images/shop/'.$name;
    }
}