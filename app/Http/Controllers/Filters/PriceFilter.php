<?php

namespace App\Http\Controllers\Filters;

use App\Models\Product;
use Illuminate\Validation\Rules\Exists;

class PriceFilter
{

    public function sort($request)
    {
        $arr = explode('to', $request);
       
        if(empty($arr[0]) or empty($arr[1])){
            return null;
            die();
        }
        if(!is_numeric($arr[0]) or !is_numeric($arr[1])){
            return null;
            die();
        }
        $item1 = $arr[0] * 1000;
        $item2 = $arr[1] * 1000;
        return Product::whereBetween('price', [$item1, $item2])->get();
    }
}
