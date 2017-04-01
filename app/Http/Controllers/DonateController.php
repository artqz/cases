<?php

namespace App\Http\Controllers;

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
                'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
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
            'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
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
            'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
        );

        if ($payment->validateResult($_GET)) {
        $order = Order::find($payment->getInvoiceId());

            if ($payment->getSum() == $order->sum) {
                $order_success = Order::where('id', $order->id)->update([
                    'status' => 1,
                ]);

                if ($order_success) {
                    User::where('id', $order->user_id)->increment('crystals', $order->crystals);
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
}
