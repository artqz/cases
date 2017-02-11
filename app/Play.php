<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    protected $fillable = [
        'user_id',
        'count',
        'pay',
        'type',
    ];
}
