<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $table = 'lite_anime';
    public $timestamps = false;

    protected $fillable = [
        'id_stud',
        'id_kach',
        'id_tv',
        'id_title',
        'src',
        'seria',
        'mix_title',
        'img',
        'rly_path',
        'date',
        'auto_correction',
        'post_id',
    ];

    public function title()
    {
        return $this->belongsTo(Title::class, 'id_title');
    }
}
