<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $table = 'lite_chat';
    protected $primaryKey = 'id_chat';

    public function user(){
        $this->belongsTo('App\HubUser', 'id_user', 'id');
    }
}
