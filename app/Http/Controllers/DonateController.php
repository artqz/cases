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
    public function buy_one()
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'sum' => 15.00,
            'description' => 'Payment for 5 crystals',
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
    public function buy_five()
    {
        $payment = new \Idma\Robokassa\Payment(
            'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
        );

        $payment
            ->setInvoiceId(2)
            ->setSum(70.00)
            ->setDescription('Payment for some goods');

        // redirect to payment url
        return redirect($payment->getPaymentUrl());
    }
    public function buy_ten()
    {
        $payment = new \Idma\Robokassa\Payment(
            'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
        );

        $payment
            ->setInvoiceId(3)
            ->setSum(100.00)
            ->setDescription('Payment for some goods');

        // redirect to payment url

        return redirect($payment->getPaymentUrl());
    }

    public function success (Request $request) {

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
                    User::where('id', $order->user_id)->update([
                        'crystals' => $order->crystals,
                    ]);
                }
            }

            // send answer
            echo $payment->getSuccessAnswer(); // "OK1254487\n"
        }
    }
}
