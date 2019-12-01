<?php
namespace Lib;

use function FastRoute\TestFixtures\empty_options_cached;

defined('_Sdef') or exit();

class Pager{

    protected $params;

    public function __construct(
                                $page,
                                $fields,
                                $tablename,
                                $where ,
                                $post_number,
                                $number_link,
                                $driver,
                                $params = []
                                 )
    {
        $this->page = $page;
        $this->fields = $fields;
        $this->tablename = $tablename;
        $this->where = $where;
        $this->post_number = $post_number;
        $this->number_link = $number_link;

        $this->driver = $driver;
    }

    public function get_total(){
        if($this->total_count){
            return $this->total_count;
        }
        $sql = 'SELECT COUNT(*) AS count FROM '.$this->tablename.' WHERE '.$this->where;
        if (!empty($this->where)){
            $count  =  $this->driver->row($sql);
        }
            $count = $this->driver->row($sql);

        $this->total_count = $count[0]['count'];
        return $this->total_count;

    }

    public function get_posts(){
       $total_post = $this->get_total();

       $number_pages = (int) $total_post/$this->post_number;

       if ($total_post % $this->post_number != 0){
           $number_pages++;
       }
       $start = ($this->page - 1) * $this->post_number;

       $sql = 'SELECT '.$this->fields.' FROM '.$this->tablename.' WHERE '.$this->where.' ';

       $sql .= 'LIMIT '.$start.', '.$this->post_number;

       if ($this->driver instanceof \Model\Driver){
           $result = $this->driver->row($sql,$this->params);
       }
       return $result;
    }

    public function get_navigation(){
        $total_post = $this->get_total();

        $number_pages = (int)($total_post/$this->post_number);

        if ($total_post % $this->post_number != 0){
            $number_pages++;
        }

        if ($total_post < $this->post_number || $this->page > $number_pages){
            return false;
        }

        $result = [];

        if ($this->page != 1){
            $result['first'] = 1;
            $result['last_page'] = $this->page - 1;
        }

        if ($this->page > $this->number_link + 1){
            for ($i = $this->page - $this->number_link;$i < $this->page; $i++){

                $result['previous'][] = $i;
            }
        }else{
            for ($i = 1; $i < $this->page; $i++){
                $result['previous'][] = $i;
            }
        }

        $result['current'] = $this->page;

        if ($this->page + $this->number_link < $number_pages){

            for ($i = $this->page +1; $i <= $this->page + $this->number_link;$i++){
                $result['next'][] = $i;
            }

        }else{
            for ($i = $this->page+1; $i <= $number_pages;$i++){
                $result['next'][] = $i;
            }
        }

        if ($this->page != $number_pages){
            $result['next_pages'] = $this->page + 1;
            $result['end'] = $number_pages;
        }

        return $result;
    }
}















