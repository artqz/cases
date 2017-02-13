<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'game_id', 'link', 'pay',
    ];

    public function games()
    {
        return $this->belongsToMany('App\Game', 'game_gift');
    }
}
