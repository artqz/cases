<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'appid', 'name', 'price', 'status', 'icon_url_large', 'hashcode',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_item');
    }
}
