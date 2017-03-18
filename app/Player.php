<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'distribution_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

