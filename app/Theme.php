<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'channel_id', 'user_id', 'slug', 'name',
    ];

    public function channels()
    {
        return $this->belongsToMany('App\Channel', 'channel_theme');
    }
    /*
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'theme_post');
    }
    */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
