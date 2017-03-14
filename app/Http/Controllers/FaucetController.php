<?php

namespace App\Http\Controllers;

use App\Click;
use App\Item;
use App\Referral;
use App\Stats;
use App\Traits\CaptchaTrait;
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
        $finishDate = date("Y/m/d H:i:s", $finishTime);
        return view('faucet.index', compact('finishTime', 'finishDate', 'items'));
    }
    
    public function get_click (Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        $token = $request->input('g-recaptcha-response');

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

                if (time() - strtotime($user->last_click) >= Config::get('main.period_click')) {
                    //берем последние 25 кликов
                    //$clicks = Click::limit(1)->max('clicks');  - не работает

                    $clicks = Click::latest('created_at')->limit(25)->get();

                    $array = array();

                    foreach ($clicks as $click)
                    {
                        $array[] =  $click->clicks;
                    }

                    if (!$array) $array[] = 0;
                    //разрешаем максимум раз в 25 ликов, если повезет
                    if (max($array) >= Config::get('main.reward_click_max'))
                    {
                        $click_max = (Config::get('main.reward_click_min')+Config::get('main.reward_click_max'))/2;
                    }
                    else $click_max = Config::get('main.reward_click_max');

                    //если сегодня ВС даём х2
                    if(date("w",time()) == 0) {
                        $clicks = random_int(Config::get('main.reward_click_min'),$click_max)*2;
                    }
                    else {
                        $clicks = random_int(Config::get('main.reward_click_min'),$click_max);
                    }

                    User::where('id', Auth::id())->update([
                        'clicks' => $user->clicks + $clicks, //1
                        'all_clicks' => $user->all_clicks + $clicks, //1
                        'last_click' => Carbon::now()->toDateTimeString(),
                    ]);

                    //Записываем в таблицу для подсчета рейтинга
                    Click::create([
                        'user_id' => Auth::id(),
                        'clicks' => $clicks,
                    ]);

                    //Записываем статистику
                    Stats::where('name', 'clicks')->increment('value', $clicks);

                    //Бонус за реф
                    if ($user->user_ref_id) {
                        User::where('id', $user->user_ref_id)->increment('clicks', $clicks*Config::get('main.ref_percent_click'));
                        User::where('id', $user->user_ref_id)->increment('all_clicks', $clicks*Config::get('main.ref_percent_click'));
                        Referral::create([
                            'user_ref_id' => $user->user_ref_id,
                            'user_id' => Auth::id(),
                            'clicks' => $clicks*Config::get('main.ref_percent_click'),
                        ]);
                        //Записываем статистику
                        Stats::where('name', 'clicks')->increment('value', $clicks*Config::get('main.ref_percent_click'));
                    }
                    $finishTime = (time() + Config::get('main.period_click'));

                    return redirect('faucet')->with([
                        'flash_message' => 'Вы получили ',
                        'flash_message_value' => $clicks,
                        'flash_message_status' => 'warning',
                    ]);
                }
                $finishTime = (strtotime($user->last_click) + Config::get('main.period_click'));
                return redirect('faucet')->with([
                    'flash_message' => 'Еще не пришло твое время!',
                    'flash_message_status' => 'danger',
                ]);

            }

            else {
                return redirect('faucet')->with([
                    'flash_message' => 'Ты робот?',
                    'flash_message_status' => 'danger',
                ]);
            }

        }

        else {
            return redirect('faucet')->with([
                'flash_message' => 'А капча?',
                'flash_message_status' => 'danger',
            ]);
        }

    }
}
