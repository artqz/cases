<?php

namespace App\Http\Controllers;

use App\Referral;
use App\Stats;
use App\User;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use DB;
use Auth;


class FaucetController extends Controller
{
    public function index ()
    {
        $user = User::where('id', Auth::id())->first();
        $finishTime = (strtotime($user->last_click) + Config::get('main.period_click'));
        return view('faucet.index', compact('finishTime'));
    }
    
    public function get_click (Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        if (time() - strtotime($user->last_click) >= Config::get('main.period_click')) {

            User::where('id', Auth::id())->update([
                'clicks' => $user->clicks + 1,
                'last_click' => Carbon::now()->toDateTimeString(),
            ]);
            //Записываем статистику
            Stats::where('name', 'clicks')->increment('value', Config::get('main.reward_click'));
            if ($user->user_ref_id) {
                User::where('id', $user->user_ref_id)->increment('clicks', Config::get('main.reward_click')*Config::get('main.ref_percent_click'));
                Referral::create([
                    'user_ref_id' => $user->user_ref_id,
                    'user_id' => Auth::id(),
                    'clicks' => Config::get('main.reward_click')*Config::get('main.ref_percent_click'),
                ]);
                //Записываем статистику
                Stats::where('name', 'clicks')->increment('value', Config::get('main.reward_click')*Config::get('main.ref_percent_click'));
            }
            $finishTime = (time() + Config::get('main.period_click'));

            return redirect('faucet')->with([
                'flash_message' => 'Вы получили '. Config::get('main.reward_click') .' Клик.',
                'flash_message_status' => 'success',
            ]);
        }
        $finishTime = (strtotime($user->last_click) + Config::get('main.period_click'));
        return redirect('faucet')->with([
            'flash_message' => 'Еще не пришло ваше время!',
            'flash_message_status' => 'danger',
        ]);

    }
}
