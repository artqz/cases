<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SteamHelper;

class SteamServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('App\Helpers\Contracts', function(){

            return new SteamHelper();

        });
    }

    public function provides()
    {
        return ['App\Helpers\Contracts\SteamContract'];
    }
        
}