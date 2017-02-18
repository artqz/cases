<?php

namespace App\Helpers\Contracts;

Interface SlugContract
{
    public function makeSlugFromTitle($model, $title);
}