<?php


namespace Lib;


class Cache
{
    private $dir = '';

    public function __construct()
    {
        $this->dir = $_SERVER['DOCUMENT_ROOT'] . '/storage/cache/';
    }

    /**
     * @param $key
     * @param $data
     */
    public function save($key, $data)
    {
        $file = fopen($this->dir . $key . '.txt', 'w');
        fwrite($file, serialize($data));
        fclose($file);
    }

    public function get($key)
    {
        $filePath  = $this->dir . $key . '.txt';
        $file = fopen($filePath, 'r');
        $data = fread($file,filesize($filePath));
        fclose($file);
        return unserialize($data);
    }

    public function delete($key)
    {
        if ($this->exists($key)){
            unlink($this->dir.$key.'.txt');
            return true;
        }
        return  false;

    }

    public function exists($key = '')
    {
        if (!file_exists($this->dir . $key.'.txt')) {
            return false;
        }
        return true;
    }

}
