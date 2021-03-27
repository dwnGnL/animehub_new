<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TypePost extends Model
{
    public $timestamps = false;
    protected $table = 'lite_type_post';
    protected $primaryKey = 'id_type_post';
}
