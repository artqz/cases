<?php
namespace App\Helpers;

use App\Helpers\Contracts\SlugContract;
use Illuminate\Support\Str;

class SlugHelper implements SlugContract
{
    public function makeSlugFromTitle($model, $title)
    {
        $slug = Str::slug($title);

        $count = $model::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}