<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Cookie;
use App\Services\Payment\PaymentService;
use App\Http\Requests\Payment\PayRequest;
use App\Mail\SendOrderedImages;
use App\Services\Payment\Requests\IDPayRequest;
use App\Services\Payment\Requests\IDPayVerifyRequest;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    //pay for orders 
    public function pay(PayRequest $request)
    {
        $validatedData =$request->validated();

        $user=User::firstOrCreate([
            'email'=>$validatedData['email'],

        ],[
            'name'=>$validatedData['name'],
            'mobile'=>$validatedData['mobile'],

        ]);
        

        try{
            $orderItems=json_decode(Cookie::get('basket'),true);
            if(count($orderItems) <= 0){
                throw new \InvalidArgumentException('سبد خرید شما خالی می باشد');
            }
           
            
            $products= Product::findMany(array_keys($orderItems));
           
            $productsPrice=$products->sum('price');
            

            $ref_code=Str::random(30);
    
           $createdOrder= Order::create([
              
                'amount'=>$productsPrice,
                'ref_code'=>$ref_code,
                'status'=>'unpaid',
                'user_id'=>$user->id
            ]);
            $orderItemsForCreatedOrder=$products->map(function($product){
                $currentProduct=$product->only(['price','id']);
                
                $currentProduct['product_id']=$currentProduct['id'];
               
                unset($currentProduct['id']);
                
                return $currentProduct;
            });
        $createdOrder->orderItems()->createMany($orderItemsForCreatedOrder -> toArray());

       $createdPayment=Payment::create([
            'gateway' =>'id_pay',
            'ref_code' => $ref_code,
            'status'=>'paid',
            'order_id'=>$createdOrder->id,
        ]);
        $createdOrder->update([
            'status'=>'paid'
        ]);
        $basket=Cookie::forget('basket');
        return redirect()->route('home.products.all')->withCookie($basket)->with('success','خرید شما انجام شد');

        }catch(\Exception $e){

            return back()->with('failed',$e->getMessage());

        }
        

       
    }
   
   
}
