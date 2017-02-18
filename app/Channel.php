<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'slug', 'type', 'name', 'description',
    ];

    /*public function themes()
    {
        return $this->belongsToMany('App\Theme', 'channel_theme');
    }*/

    public function themes()
    {
        return $this->hasMany('App\Theme');
    }
}
