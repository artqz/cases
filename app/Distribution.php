<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = [
        'name', 'players', 'price', 'type', 'status', 'user_id', 'user_winner_id', 'game_name', 'game_image', 'game_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function players_list ()
    {
        return $this->hasMany('App\Player')->orderBy('created_at', 'DESC')->limit(9);
    }
}
