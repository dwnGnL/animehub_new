<?php


namespace Lib;
defined('_Sdef') or exit();

class AclClass
{
    static protected $instance;
    /*


    */
    protected $allow;

    private function __construct()
    {

    }
    public function setAllow($role,$resource,$method){
        $this->allow[$role][] = ['resource' => $resource, 'method' => $method];
    }

    public function getAllow(){
        return $this->allow;
    }
    public static function getInstance(){
        if (self::$instance instanceof self){
            return self::$instance;
        }
        return new self;
    }
    public function check($resource, $role, $method){
        if (empty($this->allow)){
            return false;
        }
        if (isset($this->allow[$role]) && is_array($this->allow[$role])) {
            foreach ($this->allow[$role] as $item) {
                if ($item['resource'] == $resource) {
                    if (in_array($method, $item['method'])) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}