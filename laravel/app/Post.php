<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'lite_post';

    public function tv(){
        $this->belongsTo('App\Tv', 'id_tv', 'id');
    }

    public function type(){
        $this->belongsTo('App\Type', 'id_type_post', 'id_type_post');
    }

    public function views(){
        $this->belongsTo('App\View', 'id', 'id_post');
    }


}
