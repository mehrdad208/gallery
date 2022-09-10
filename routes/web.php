<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Home\BasketController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Home\CheckoutController;
use App\Http\Controllers\Home\InformationController;

use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\validAdmin;

use App\Http\Controllers\Home\ProductsController as HomeProductsController;


Route::prefix('')->group(function(){

    //for first public page 
    Route::get('',[HomeProductsController::class,'index'])->name('home.products.all');
    Route::get('{product_id}/show',[HomeProductsController::class,'show'])->name('home.product.show');
    Route::get('{product_id}/addToBasket',[BasketController::class,'addToBasket'])->name('home.basket.add');
    Route::get('{product_id}/deleteToBasket',[BasketController::class,'deleteToBasket'])->name('home.basket.delete');
    Route::get('checkout',[CheckoutController::class,'show'])->name('home.checkout.show');
    
    //for search public first page
    Route::post('search',[HomeProductsController::class,'search'])->name('home.search');
    Route::get('popularSearchFree',[HomeProductsController::class,'popularSearchFree'])->name('home.popular.search.free');
    Route::get('popularSearchMoney',[HomeProductsController::class,'popularSearchMoney'])->name('home.popular.search.money');
    Route::get('popularSearchAll',[HomeProductsController::class,'popularSearchAll'])->name('home.popular.search.all');
    Route::get('popularSearch200',[HomeProductsController::class,'popularSearch200'])->name('home.popular.search.200');
    Route::get('popularSearch201to400',[HomeProductsController::class,'popularSearch201to400'])->name('home.popular.search.201to400');
    Route::get('popularSearch401toup',[HomeProductsController::class,'popularSearch401toup'])->name('home.popular.search.401toup');
    Route::get('popularSearchnewest',[HomeProductsController::class,'searchNewest'])->name('home.search.newest');
    Route::get('popularSearchmoretoless',[HomeProductsController::class,'searchMoreToLess'])->name('home.search.moretoless');
    Route::get('popularSearchlesstomore',[HomeProductsController::class,'searchLessToMore'])->name('home.search.lesstomore');

    //for footer public page
    Route::get('helps',[InformationController::class,'helps'])->name('home.product.helps');
    Route::get('about',[InformationController::class,'about'])->name('home.product.about');
    Route::get('contact_us',[InformationController::class,'contact_us'])->name('home.product.contact_us');
    Route::get('law',[InformationController::class,'law'])->name('home.product.law');


    

});
// admin page for login and logout   and send sms
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class,'login'])->name('login');
    Route::get('/logout', [AdminController::class,'logout'])->name('logout'); 
    Route::post('/adminlogin', [AdminController::class,'adminLogin'])->name('adminLogin');
    Route::get('/sendPassword', [AdminController::class,'sendCodePassword'])->name('sendPasswordView');
    Route::post('/sendSmsForAdminLogin', [AdminController::class,'sendSmsForAdminLogin'])->name('sendSmsForAdminLogin');



});

//admin page for other features with middleware
Route::prefix('admin')->middleware('validAdmin')->group(function () {
    
    //set password code for admin and show index for admin
    Route::get('/setPasswordView', [AdminController::class,'setPasswordView'])->name('setPasswordView');
    Route::put('/setOnlyPassword', [AdminController::class,'setOnlyPassword'])->name('admin.setOnlyPassword');
    Route::get('/index', [AdminController::class,'adminDashboard'])->name('admin.dashboard');
    
    //show all category route for admin 
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories.all');
        Route::get('create', [CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('', [CategoriesController::class, 'store'])->name('admin.categories.store');
        Route::delete('{category_id}/delete', [CategoriesController::class, 'destroy'])->name('admin.categories.delete');
        Route::get('{category_id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
        Route::put('{category_id}/update', [CategoriesController::class, 'update'])->name('admin.categories.update');
        Route::get('search', [CategoriesController::class, 'search'])->name('admin.categories.search');

    });
    //show all products route for admin 
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('admin.products.all');
        Route::get('create', [ProductsController::class, 'create'])->name('admin.products.create');
        Route::post('', [ProductsController::class, 'store'])->name('admin.products.store');
        Route::delete('{product_id}/delete', [ProductsController::class, 'destroy'])->name('admin.product.delete');
        Route::get('{product_id}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
        Route::put('{product_id}/update', [ProductsController::class, 'update'])->name('admin.products.update');
        Route::get('{product_id}/download/demo', [ProductsController::class, 'downloadDemo'])->name('admin.products.download.demo');
        Route::get('{product_id}/download/source_url', [ProductsController::class, 'downloadSource'])->name('admin.products.download.source');
    });

    //show all users route for admin 
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('admin.users.all');
        Route::get('create', [UsersController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [UsersController::class, 'store'])->name('admin.users.store');
        Route::delete('{category_id}/delete', [UsersController::class, 'destroy'])->name('admin.users.delete');
        Route::get('{user_id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::put('{user_id}/update', [UsersController::class, 'update'])->name('admin.users.update');
    });

     //show all orders route for admin 
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('admin.orders.all');
        Route::get('{user_id}/order_items', [OrdersController::class, 'items'])->name('admin.orders.items.all');
    });
     //show all payments route for admin 
    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentsController::class, 'index'])->name('admin.payments.all');
    });

     //show all payments route for admin 
     Route::prefix('payments')->namespace('Payment')->group(function(){
         Route::post('pay',[PaymentController::class,'pay'])->name('payment.pay');
     });



});



