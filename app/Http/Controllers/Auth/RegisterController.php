<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Stats;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:20|min:3',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::where('id', $data['ref_id'])->first();
        if ($user) {
            $user_ref_id = $user->id;
        }
        else {
            $user_ref_id = 0;
        }
        //Записываем статистику
        Stats::where('name', 'users')->increment('value', 1);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_hash' => md5($data['email']),
            'password' => bcrypt($data['password']),
            'user_ref_id' => $user_ref_id,
        ]);
    }
}
