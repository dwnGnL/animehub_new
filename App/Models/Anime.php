<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'lite_anime';
    public $timestamps = false;

    public function title()
    {
        return $this->belongsTo(Title::class, 'id_title');
    }
}
