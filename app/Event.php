<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'text', 'value', 'user_id', 'status', 'image',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
