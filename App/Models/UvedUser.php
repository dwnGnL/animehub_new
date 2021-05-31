<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UvedUser extends Model
{
    protected $table = 'lite_uved_id_user';

    protected $primaryKey = 'id_nag';

    public $timestamps = false;

    protected $fillable = [
        'id_uved',
        'id_user',
        'view'
    ];
}
