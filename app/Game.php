<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function gifts()
    {
        return $this->belongsToMany('App\Gift', 'game_gift');
    }
}
