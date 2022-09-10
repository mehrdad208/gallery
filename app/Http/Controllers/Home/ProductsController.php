<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProductsController extends Controller
{
  //show all products
    public function index(Request $request)
    {
        if (isset($request->filter, $request->action)) {
            $products = $this->findFilter($request->filter, $request->action)??Product::all();
        } elseif (isset($request->search)) {
            $productName = $request->search;
            $products = Product::where('title', 'LIKE', '%' . $productName . '%')->get();
        }elseif(isset($request->price)){
            $products=$this->findPrice($request->price) ?? Product::all();
        }
        else {
            $products = Product::all();
        }



        $categories = Category::all();
        return view('frontend.products.all', compact('products', 'categories'));
    }
      //show simillar products 
    public function show($id)
    {
        

        $product = Product::findOrFail($id);
        $simillerProducts = Product::where('category_id', $product->category_id)->take(4)->get();
        $categories = Category::all();
        return view('frontend.products.show', compact('product', 'simillerProducts','categories'));

    }

//show result for viewer search
  public function search(Request $request){

    $search=$request->input('search');
    $products=Product::where('title','like','%'.$search.'%')->get();
    $categories= Category::all();
    return view('frontend.products.all',compact('products','categories'));

  }

//show result free money to viewer search
  public function popularSearchFree(){
    $products=Product::where('price',0)->get();
    $categories= Category::all();
    return view('frontend.products.all',compact('products','categories'));
  }

//show result  money to viewer search
  public function popularSearchMoney(){

    $products=Product::where('price','>',0)->get();
    $categories= Category::all();
    return view('frontend.products.all',compact('products','categories'));
  }

//show result all products to viewer search
  public function popularSearchAll(){
    $products=Product::all();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));
  }

//show result products to 200 thousand toman
  public function popularSearch200(){
    $products=Product::where('price','<=',200000)->get();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));
  }

 //show result products 201 to 400 thousand toman
  public function popularSearch201to400(){
    $products=Product::whereBetween('price',[201000,400000])->get();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));
  }

  //show result products up 401 thousand toman
  public function popularSearch401toup(){
    $products=Product::where('price','>=',401000)->get();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));
  }

  //show result newest products 
  public function searchNewest(){

    $products=Product::orderBy('created_at', 'desc')->get();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));

  }

//show result more to less 
  public function searchMoreToLess(){

    $products=Product::orderBy('price', 'desc')->get();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));
    
  }

//show result less to more 
  public function searchLessToMore(){

    $products=Product::orderBy('price', 'asc')->get();
    $categories=Category::all();
    return view('frontend.products.all',compact('products','categories'));
    
  }


}