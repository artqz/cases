<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'appid', 'name', 'price', 'status', 'header_image', 'user_id', 'hashcode',
    ];

    public function gifts()
    {
        return $this->belongsToMany('App\Gift', 'game_gift');
    }
}
