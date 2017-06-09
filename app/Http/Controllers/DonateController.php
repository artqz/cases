<?php

namespace App\Http\Controllers;

use App\Event;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonateController extends Controller
{
    public function index ()
    {
         return view('donate.index');
    }

    /**
     * @return string
     */
    public function buy($count)
    {
        if ($count == 1) {
            $crystals = 1;
            $sum = 15.00;
        }
        elseif ($count == 5) {
            $crystals = 5;
            $sum = 70.00;
        }
        elseif ($count == 10) {
            $crystals = 10;
            $sum = 110.00;
        }
        else return redirect('donate');

        $order = Order::create([
            'user_id' => Auth::id(),
            'sum' => $sum,
            'description' => 'Payment for '.$crystals.' crystals',
            'crystals' => $crystals,
        ]);

        if ($order) {
            $payment = new \Idma\Robokassa\Payment(
                'steamclicks.ru', 'xn7XTLXT7CUy02Ks9EbY', 'aAwIn3TvpPX87cLhS05o', false
            );

            $payment
                ->setInvoiceId($order->id)
                ->setSum($order->sum)
                ->setDescription($order->description);

            // redirect to payment url
            return redirect($payment->getPaymentUrl());
        }
    }

    public function success () {

        $payment = new \Idma\Robokassa\Payment(
            'steamclicks.ru', 'xn7XTLXT7CUy02Ks9EbY', 'aAwIn3TvpPX87cLhS05o', false
        );

            if ($payment->validateSuccess($_GET)) {
            $order = Order::find($payment->getInvoiceId());

            if ($payment->getSum() == $order->sum) {
                return redirect('donate')->with([
                    'flash_message' => 'Вы успешно купили '. $order->crystals. ' Кристаллов',
                    'flash_message_status' => 'success',
                ]);
            }

        }

    }

    public function result () {
        $payment = new \Idma\Robokassa\Payment(
            'steamclicks.ru', 'xn7XTLXT7CUy02Ks9EbY', 'aAwIn3TvpPX87cLhS05o', false
        );

        if ($payment->validateResult($_GET)) {
        $order = Order::find($payment->getInvoiceId());

            if ($payment->getSum() == $order->sum) {
                $order_success = Order::where('id', $order->id)->update([
                    'status' => 1,
                ]);

                if ($order_success) {
                    User::where('id', $order->user_id)->increment('crystals', $order->crystals);

                    //event
                    Event::create([
                        'user_id' => $order->user_id,
                        'image' => url('images/icons/clickcrystal.png'),
                        'text' => 'Вы купили '.$order->crystals.' Кристаллов.',
                        'url' => url('donate'),
                        'type' => 'donate',
                    ]);
                }
            }

            // send answer
            echo $payment->getSuccessAnswer(); // "OK1254487\n"
        }
    }

    public function fail (Request $request) {
        Order::where('id', $request['InvId'])->delete();

        return redirect('donate')->with([
            'flash_message' => 'Вы отменили покупку!',
            'flash_message_status' => 'warning',
        ]);
    }

    public function index_clicks ()
    {
        return view('donate.clicks.index');
    }

    public function get($count)
    {

        $user = User::where('id', Auth::id())->first();
        if ($count == 100) {
            $clicks = 100;
            $crystals = 1;
        }
        elseif ($count == 500) {
            $clicks = 500;
            $crystals = 5;
        }
        elseif ($count == 1000) {
            $clicks = 1000;
            $crystals = 10;
        }
        else return redirect('exchange');
        if ($user->crystals >= $crystals) {
            User::where('id', $user->id)->update([
                'crystals' => $user->crystals - $crystals,
                'clicks' => $user->clicks + $clicks
            ]);

            //event
            Event::create([
                'user_id' => $user->id,
                'image' => url('images/icons/clickcoin.png'),
                'text' => 'Вы обменяли '.$crystals.' Кристаллов на '.$clicks.' Кликов',
                'url' => url('exchange'),
                'type' => 'exchange',
            ]);

            return redirect('exchange')->with([
                'flash_message' => 'Вы получили '.$clicks.' Кликов',
                'flash_message_status' => 'success',
            ]);
        }
        else return redirect('exchange')->with([
            'flash_message' => 'У Вас не хватает Кристаллов!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function index_crystals ()
    {
        return view('donate.crystals.index');
    }

    public function get_crystals($count)
    {

        $user = User::where('id', Auth::id())->first();
        if ($count == 1) {
            $clicks = 260;
            $crystals = 1;
        }
        elseif ($count == 5) {
            $clicks = 1170;
            $crystals = 5;
        }
        elseif ($count == 10) {
            $clicks = 2210;
            $crystals = 10;
        }
        else return redirect('donate');
        if ($user->clicks >= $clicks) {
            User::where('id', $user->id)->update([
                'crystals' => $user->crystals + $crystals,
                'clicks' => $user->clicks - $clicks
            ]);

            //event
            Event::create([
                'user_id' => $user->id,
                'image' => url('images/icons/clickcrystal.png'),
                'text' => 'Вы обменяли '.$clicks.' Кликов на '.$crystals.' Кристаллов',
                'url' => url('donate'),
                'type' => 'exchange',
            ]);

            return redirect('donate')->with([
                'flash_message' => 'Вы получили '.$crystals.' Кристаллов',
                'flash_message_status' => 'success',
            ]);
        }
        else return redirect('donate')->with([
            'flash_message' => 'У Вас не хватает Кликов!',
            'flash_message_status' => 'danger',
        ]);
    }
}
