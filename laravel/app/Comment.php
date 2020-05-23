<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'lite_comment';

    public function user(){
        $this->belongsTo('App\HubUser', 'id_user', 'id');
    }

    public function post(){
        $this->belongsTo('App\Post', 'id_post', 'id');
    }
}
