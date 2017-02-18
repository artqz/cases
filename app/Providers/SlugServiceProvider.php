<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SlugHelper;

class SlugServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('App\Helpers\Contracts', function(){

            return new SlugHelper();

        });
    }

    public function provides()
    {
        return [
            'App\Helpers\Contracts\SlugContract',
        ];
    }
        
}