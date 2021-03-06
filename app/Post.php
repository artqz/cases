<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'theme_id', 'user_id', 'text',
    ];

    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }

    public function channel()
    {
        return $this->hasManyThrough('App\Theme', 'App\Channel', 'id', 'channel_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
