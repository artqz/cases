<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'appid', 'name', 'price', 'status', 'icon_url', 'icon_url_large', 'user_id', 'hashcode', 'type', 'name_color',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\AllGame', 'appid', 'appid');
    }
}
