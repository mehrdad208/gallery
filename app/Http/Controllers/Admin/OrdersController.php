<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrdersController extends Controller
{
    //show all orders for admin
    public function index(){
        $orders=Order::paginate(10);
        return view('admin.orders.all',compact('orders'));
    }
    //show all orders items for admin
    public function items($id){
        $orderItems=OrderItem::where('order_id',$id)->paginate(10);
        return view('admin.orders.orderItems',compact('orderItems'));
    }
}
