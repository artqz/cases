<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_hash',
        'password',
        'user_ref_id',
        'clicks',
        'all_clicks',
        'last_click',
        'tradeoffer',
        'steam_name',
        'steam_avatar',
        'steam_profile',
        'steamid',
        'isBanned',
        'isTrader',
        'isSpamer',
        'crystals',
        'rating',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function themes()
    {
        return $this->hasMany('App\Theme');
    }

    /*public function items()
    {
        return $this->belongsToMany('App\Item', 'user_item');
    }*/
    public function items()
    {
        return $this->hasMany('App\Item');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
