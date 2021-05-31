<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Post extends Model {

    protected $table = 'lite_post';
    public $timestamps = false;

    public function tv()
    {
        return $this->belongsTo(Tv::class, 'id_tv');
    }

    public function categories()
    {
        return $this->belongsToMany(Cat::class, 'lite_cat_post', 'id_post', 'id_cat');
    }

    public function year()
    {
        return $this->belongsTo(GodWip::class, 'id_god_wip');
    }

    public function view()
    {
        return $this->hasOne(View::class, 'id_post');
    }

    public function type()
    {
        return $this->belongsTo(TypePost::class, 'id_type_post');
    }

    public function scopePost($query,$type)
    {
        return $query->whereHas('type', function (Builder $builder)use ($type){
            $builder->where('title_type_post', $type);
        })->with('categories')
            ->with('view')
            ->with(['anime' => function($query){
                $query->orderBy('seria', 'DESC');
            }]);
    }

    public function anime()
    {
        return $this->hasOne(Anime::class, 'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lite_favorites', 'id_post', 'id_user');
    }
}

