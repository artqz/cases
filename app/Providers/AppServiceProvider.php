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

        Validator::extend('recaptcha', function($attribute, $value, $parameters, $validator) {
        $token = $value;

        if (strlen($token) > 0) {

            $data = array(
                'secret' => env('RE_CAP_SECRET'),
                'response' => $token
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($verify));
            
            if ($result->success) {
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
