<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;

Route::prefix('admin')->group(function(){
    Route::prefix('categories')->group(function(){
        Route::get('create',[CategoriesController::class,'create'])->name('admin.categories.create');
        Route::get('/',[CategoriesController::class,'index'])->name('admin.categories.all');
        Route::post('',[CategoriesController::class,'store'])->name('admin.categories.store');
        Route::delete('{category_id}/delete',[CategoriesController::class,'destroy'])->name('admin.categories.delete');
        Route::get('{category_id}/edit',[CategoriesController::class,'edit'])->name('admin.categories.edit');
        Route::put('{category_id}/update',[CategoriesController::class,'update'])->name('admin.categories.update');

    });
    Route::prefix('products')->group(function(){
        Route::get('create',[ProductsController::class,'create'])->name('admin.products.create');
        Route::get('/',[ProductsController::class,'index'])->name('admin.products.all');
        Route::post('',[ProductsController::class,'store'])->name('admin.products.store');
        Route::delete('{product_id}/delete',[ProductsController::class,'destroy'])->name('admin.product.delete');
        Route::get('{product_id}/edit',[ProductsController::class,'edit'])->name('admin.products.edit');
        Route::put('{product_id}/update',[ProductsController::class,'update'])->name('admin.products.update');

        Route::get('{product_id}/download/demo',[ProductsController::class,'downloadDemo'])->name('admin.products.download.demo');
        Route::get('{product_id}/download/source_url',[ProductsController::class,'downloadSource'])->name('admin.products.download.source');
    });
});
