<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    public function index () {
        $user = User::where('id'. \Auth::id())->first();
        $payment = new \Idma\Robokassa\Payment(
            'djoctuk', 'Artem110789', 'Kuznetsov110789', true
        );

        $payment
            ->setInvoiceId(1)
            ->setSum(10)
            ->setDescription('Payment for some goods');

        // redirect to payment url
        return redirect($payment->getPaymentUrl());
    }
}
