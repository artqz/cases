<?php

namespace App;

use Carbon\Carbon;
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
        Carbon::setLocale('ru');
        return $this->hasMany('App\Player')->orderBy('created_at', 'DESC');
    }
    public function check_player ()
    {
        return $this->hasMany('App\Player')->where('user_id', \Auth::id());
    }
}
