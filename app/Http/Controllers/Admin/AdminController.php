<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login\loginRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function __construct(){
        session_start();
    }

   // logout admin with delete session and redirect to home page and show all products
    public function logout()
    {
        Session::forget('user');
        return redirect()->route('home.products.all');
    }
   // show send code page for admin 
    public function sendCodePassword()
    {
        return view('admin.login.sendCodePassword');
    }
  
   //set new password for admin in admin page 
    public function setOnlyPassword(Request $request){
       
        $validatedData= $request->validate([
             'newPassword'=>'required|min:8',
             're_newPassword'=>'required|min:8'
         ]);
         if($validatedData){
             if($validatedData['newPassword']==$validatedData['re_newPassword']){
                 User::where('id', $request->input('user_id'))->update([
                     'password' =>password_hash($validatedData['newPassword'],PASSWORD_DEFAULT),
                 ]);
                 return redirect()->back()->with('رمز تغییر پیدا کرد');
             }
         }
         return redirect()->back()->with('رمز وتکرار أن صحیح نمی باشد');
         
 
     }
      
     public function sendSmsForAdminLogin(Request $request)
     {
         $national_code = $request->input(('national_code'));
         
         $user = User::where('national_code', $national_code)->first();
         if (!$user) {
 
             return redirect()->route('sendCodePassword')->with('response', 'کد ملی شما صحیح نمی باشد');
         }
         
         if ($user->role != "admin") {
             return redirect()->route('sendCodePassword')->with('response','شما اجازه دسترسی به پنل ادمین را ندارید');
         }
         $recovery_code = rand(10000000, 999999999);
         $user->two_factor_secret = $recovery_code;
         $user->save();
         if($user->mobile == null){
             return redirect()->route('sendCodePassword')->with('response' , 'موبایل ثبت نشد'); 
         }
         return redirect()->route('login')->with('response' , ' کد یکبار مصرف برای شما ارسال گردید کدارسالی را در قسمت رمز عبور وارد نمایید');
     }

     
//show login view for admin
     public function login()
     {
        
         return view('admin.login.loginView');
     }
     //check user send data is admin
     public function adminLogin(loginRequest $request)
     {
        
         $national_code = $request->input('national_code');
         $password = $request->input('password');
         $user = User::where('national_code', $national_code)->first();
         if (!$user) {
 
             return redirect()->route('login')->with('response','کد ملی یا رمز عبور صحیح نمی باشد');
         }
         
         if ($user->role != "admin") {
             return redirect()->route('login')->with('response', 'شما اجازه دسترسی به پنل ادمین را ندارید');
         }
 
         if (password_verify($password, $user['password'])) {
             $user=$user->first_name ." ". $user->last_name;
             Session::put('user',$user);
             return redirect()->route('admin.dashboard');
         }
       
         if ($password == $user->two_factor_secret) {
             $user=$user->first_name." " . $user->last_name;
             Session::put('user',$user);
 
             return redirect()->route('admin.dashboard');
         }
         return redirect()->route('login')->with('response','ادمین عزیز رمز عبور شما صحیح نمی باشد');
     }


  // show all data in index for show admin
   public function adminDashboard(){
        $usersCount=User::all()->count();
        $categoriesCount=Category::all()->count();
        $ordersCount=Order::all()->count();
        $productsCount=Product::all()->count();
        $price=Order::all()->sum('amount');
        return view('admin.index',compact('usersCount','categoriesCount','ordersCount','productsCount','price'));
    
   }
   public function setPasswordView(){
    $admin=User::where('role','admin')->first();
    return view('admin.users.changePassword',compact('admin'));
   }
}
