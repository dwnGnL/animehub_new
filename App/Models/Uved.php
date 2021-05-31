<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Uved extends Model
{
    protected $table = 'lite_uved';

    protected $fillable = [
        'title',
        'description',
        'date',
        'id_author'
    ];

    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo(User::class, 'id_author', 'id');
    }
}
