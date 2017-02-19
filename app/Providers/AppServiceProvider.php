<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_link_steam', function($attribute, $value, $parameters, $validator) {
            if(parse_url($value)['host'] == 'store.steampowered.com'){
                if ( explode('/', trim(parse_url($value)['path'], '/'))[0] == 'app')  {
                    return true;
                }
                return false;
            }
            return false;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
