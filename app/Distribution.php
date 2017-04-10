<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = [
        'name',
        'level',
        'players',
        'price',
        'type',
        'status',
        'user_id',
        'user_winner_id',
        'data_name',
        'data_image',
        'data_id',
        'data_key',
        'data_region',
        'slug',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_winner()
    {
        return $this->belongsTo('App\User', 'user_winner_id');
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
