<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'type', 'link_gift', 'code_gift', 'pay',
    ];

    public function games()
    {
        return $this->belongsToMany('App\Game', 'game_gift');
    }
}
