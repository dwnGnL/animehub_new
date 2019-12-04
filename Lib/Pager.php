<?php
namespace Lib;

use function FastRoute\TestFixtures\empty_options_cached;

defined('_Sdef') or exit();

class Pager{

    protected $params;

    public function __construct(
                                $fields,
                                $tablename,
                                $where ,
                                $page,
                                $params = [],
                                $post_number,
                                $number_link,
                                $driver

                                 )
    {
        $this->page = $page;
        $this->fields = $fields;
        $this->tablename = $tablename;
        $this->where = $where;
        $this->post_number = $post_number;
        $this->number_link = $number_link;
        $this->params = $params;
        $this->driver = $driver;
    }

    public function get_total(){
        if($this->total_count){
            return $this->total_count;
        }

        $sql = 'SELECT COUNT(*) AS count FROM '.$this->tablename.' WHERE '.$this->where;
        if (!empty($this->where)){
            $count  =  $this->driver->row($sql,$this->params);

        }else{
            $count = $this->driver->row($sql);
        }


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

    protected function get_navigation(){
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
            if(($tmp_number = $number_pages - $this->page) <= $this->number_link ){

                    $this->number_link += $this->number_link - $tmp_number;

            }
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


            if(($tmp_number = $this->page - 1) <= $this->number_link ){

                $this->number_link += $this->number_link - $tmp_number;

            }

            for ($i = $this->page +1; $i <= $this->page + $this->number_link ;$i++){
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

    public function render($route){
      $navigation = $this->get_navigation();
        $temp = '<ul class="switch-page">';
            if (!empty($navigation['previous'])){
                if ($this->page > $this->number_link + 1){
                    $temp .= '<li class="switch-page-item"><a href="'.$route.$navigation['last_page'].'">Туда</a></li>';
                    $temp .= '<li class="switch-page-item"><a href="'.$route.$navigation['first'].'">'.$navigation['first'].'</a></li>';
                    $temp .= '<li class="switch-page-item disabled">...</li>';
                }
                foreach ($navigation['previous'] as $previous){

                    $temp .= '<li class="switch-page-item "><a href="'.$route.$previous.'">'.$previous.'</a></li>';
                }
            }
            $temp .= '<li class="switch-page-item switch-page-active">'.$navigation['current'].'</li>';
            if (!empty($navigation['next'])){
                foreach ($navigation['next'] as $next){
                    $temp .= '<li class="switch-page-item "><a href="'.$route.$next.'">'.$next.'</a></li>';
                }
                if ($navigation['end'] - $this->page > $this->number_link){

                    $temp .= '<li class="switch-page-item disabled">...</li>';
                    $temp .= '<li class="switch-page-item"><a href="'.$route.$navigation['end'].'">'.$navigation['end'].'</a></li>';
                    $temp .= '<li class="switch-page-item"><a href="'.$route.$navigation['next_pages'].'">Cюда</a></li>';
                }
            }
            $temp .= '</ul>';

//        $end = $navigation['end'] - $navigation['currnent'];
//        $tmp = ' <ul class="switch-page">';
//
//       if ($navigation['current'] == 1 ){
//        $tmp .= '<li class="switch-page switch-page-active disabled">'.$this->page.'</li>';
//        $end = $navigation['end'] - $navigation['currnent'];
//            foreach($navigation['next'] as $next){
//                $tmp .=  ' <li class="switch-page-item">'.$next.'</li>';
//
//            }
//            if($end > 0){
//                $tmp .= ' <li class="switch-page-item disabled">...</li>';
//                $tmp .= ' <li class="switch-page-item">'.$navigation['end'].'</li>';
//            }
//
//            $tmp .= ' <li class="page-item"> <a class="page-link" href="#" aria-label="Next">
//                        <span aria-hidden="true">&raquo;</span>
//                         </a></li>';
//       }
//
//       if($navigation['current'] > 1){
//        $tmp .= ' <li class="page-item">
//      <a class="page-link" href="#" aria-label="Previous">
//        <span aria-hidden="true">&laquo;</span>
//        <span class="sr-only">Previous</span>
//      </a>
//    </li>';
//        if ($navigation['current'] - $this->number_link > 1){
//            $tmp .= ' <li class="switch-page-item ">'.$navigation['first'].'</li>';
//            $tmp .= ' <li class="switch-page-item disabled">...</li>';
//        }
//        foreach ($navigation['previous'] as $previous){
//            $tmp .= ' <li class="switch-page-item ">'.$previous.'</li>';
//        }
//            $tmp .= ' <li class="switch-page-item switch-page-active disabled ">'.$navigation['current'].'</li>';
//        if (!empty($navigation['next'])){
//        foreach ($navigation['next'] as $next){
//            $tmp .= ' <li class="switch-page-item ">'.$next.'</li>';
//        }
//        }
//           if($end > 0){
//               $tmp .= ' <li class="switch-page-item disabled">...</li>';
//               $tmp .= ' <li class="switch-page-item">'.$navigation['end'].'</li>';
//           }
//
//           $tmp .= ' <li class="page-item"> <a class="page-link" href="#" aria-label="Next">
//                        <span aria-hidden="true">&raquo;</span>
//                         </a></li>';
//       }

      
      return $temp;
      
    }
}















