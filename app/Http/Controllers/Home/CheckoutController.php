<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function show(){
        $baskets=!is_null(Cookie::get('basket'))?json_decode(Cookie::get('basket'),true):[];
        $productsPrice=array_sum(array_column($baskets,'price'));
        return view('frontend.products.checkout',compact('baskets','productsPrice'));
    }
}
