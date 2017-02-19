<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'appid', 'name', 'price', 'data', 'status', 'header_image', 'user_id', 'hashcode',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
