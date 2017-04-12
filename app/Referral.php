<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'user_id',  'user_ref_id', 'clicks', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
