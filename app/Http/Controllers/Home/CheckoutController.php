<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
  //show all products in basket session for viewer 
    public function show(){
      
        if(Cookie::get('basket')=='[]'){
          
          return redirect()->route('home.products.all')->with('failed','سبد شما خالی است.');
        }
        $baskets=!is_null(Cookie::get('basket'))?json_decode(Cookie::get('basket'),true):[];
        $productsPrice=array_sum(array_column($baskets,'price'));
        $categories = Category::all();
        return view('frontend.products.checkout',compact('baskets','productsPrice','categories'));
    }
}
