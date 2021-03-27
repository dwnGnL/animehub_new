<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $table = 'lite_post';
    public $timestamps = false;

    public function tv()
    {
        return $this->belongsTo(Tv::class, 'id_tv');
    }
}

