<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\OrderByFilter;
use App\Http\Controllers\Filters\PriceFilter;

class ProductsController extends Controller
{
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $simillerProducts = Product::where('category_id', $product->category_id)->take(4)->get();
        return view('frontend.products.show', compact('product', 'simillerProducts'));
    }

    private function findFilter(string $className, string $methodName)
    {
        $baseNameSpace = "App\Http\Controllers\Filters\\";
        $className = $baseNameSpace . ucfirst($className) . 'Filter';
        if (!class_exists($className)) {
            return null;
        }
        $object = new $className;
        if (!method_exists($object, $methodName)) {
            return null;
        }
        return $object->$methodName();
    }
    private function findPrice($request){
        if(empty($request)){
            return null;
        }
        $className="App\Http\Controllers\Filters\PriceFilter";
        $object=new $className;
        return $object->sort($request);

    }
}
