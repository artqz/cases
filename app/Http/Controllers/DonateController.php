<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    public function index () {
        $payment = new \Idma\Robokassa\Payment(
            'steamclicks.ru', 'Artem110789', 'Kuznetsov110789', true
        );

        $payment
            ->setInvoiceId(111111)
            ->setSum(10.00)
            ->setDescription('Payment for some goods');

        // redirect to payment url
        return redirect($payment->getPaymentUrl());
    }
}
