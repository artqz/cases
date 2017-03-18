<?php

namespace App\Helpers;

trait DataViewer {
    public function scopeSearchPaginateAndOrder($query)
    {
        return $query->paginate(10);
    }
}