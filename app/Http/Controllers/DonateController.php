<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        $payment = new \Idma\Robokassa\Payment(
            'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
        );

        $payment
            ->setInvoiceId(1)
            ->setSum(15.00)
            ->setDescription('Payment for some goods');

        // redirect to payment url
        return redirect($payment->getPaymentUrl());
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
}
