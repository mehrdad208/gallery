<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;

Route::prefix('admin')->group(function(){
    Route::prefix('categories')->group(function(){
        Route::get('create',[CategoriesController::class,'create'])->name('admin.categories.create');
        Route::get('/',[CategoriesController::class,'index'])->name('admin.categories.all');
        Route::post('',[CategoriesController::class,'store'])->name('admin.categories.store');
    });
});