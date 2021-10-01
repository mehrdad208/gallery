<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index(){
        $products=Product::all();
        $categories = Category::all();
        return view('frontend.products.all',compact('products','categories'));
    }
    public function show($id){
        $product=Product::findOrFail($id);
        $simillerProducts=Product::where('category_id',$product->category_id)->take(4)->get();
        return view('frontend.products.show',compact('product','simillerProducts'));
    }

}
