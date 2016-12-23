<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $fillable = [
        'case_type',
        'case_price',
    ];
}
