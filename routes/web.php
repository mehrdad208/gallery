<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;

Route::prefix('admin')->group(function(){
    Route::prefix('categories')->group(function(){
        Route::get('create',[CategoriesController::class,'create'])->name('admin.categories.create');
        Route::get('/',[CategoriesController::class,'index'])->name('admin.categories.all');
        Route::post('',[CategoriesController::class,'store'])->name('admin.categories.store');
        Route::delete('{category_id}/delete',[CategoriesController::class,'destroy'])->name('admin.categories.delete');
        Route::get('{category_id}/edit',[CategoriesController::class,'edit'])->name('admin.categories.edit');
        Route::put('{category_id}/update',[CategoriesController::class,'update'])->name('admin.categories.update');

    });
});