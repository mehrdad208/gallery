<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Payment\PaymentService;
use App\Services\Payment\Requests\IDPayRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay()
    {
        $user=User::first();
        $idPayRequest=new IDPayRequest([
            'amount'=>1000,
            'user'=>$user,
        ]);
        $paymentservice=new PaymentService(PaymentService::IDPAY,$idPayRequest);
        $paymentservice->pay();
    }
}
