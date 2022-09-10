<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class InformationController extends Controller
{
//show hellps text for guidance viewer
public function helps(){
    $categories = Category::all();
    return view('frontend.products.helps',compact('categories'));
  }
//show about text for guidance viewer
public function about(){
$categories = Category::all();
return view('frontend.products.about',compact('categories'));
  }
//show law text for guidance viewer
public function law(){
$categories = Category::all();
return view('frontend.products.law',compact('categories'));
  }
//show contact_us text for guidance viewer
public function contact_us(){
$categories = Category::all();

return view('frontend.products.contact_us',compact('categories'));
  }
}
