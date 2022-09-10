<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Utilities\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\products\StoreRequest;
use App\Http\Requests\Admin\products\UpdateRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all products for admin
    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::all();
        return view('admin.products.all', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show add view for create product for admin
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //store data for create product
    public function store(StoreRequest $request)
    {
        
        $admin = User::where('email', 'm.ebrahimi.talo1990@gmail.com')->first();
       
        $validatedData = $request->validated();
        

        $createdProduct = Product::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'owner_id' => $admin->id,
        ]);
        
        if (!$this->uploadImages($createdProduct, $validatedData)) {
            return back()->with('failed', 'محصول ایجاد نشد');
        }
        return back()->with('success', 'محصول ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //show edit view for update product
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update product with new data send admin
    public function update(UpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $product = Product::findOrFail($id);

        $updatedProduct = Product::findOrFail($id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
        ]);
        if(!$this->uploadImages($product,$validatedData) or  $updatedProduct)
        {
            return back()->with('success','محصول بروزرسانی شد');
        }
        return back()->with('failed','محصول بروزرسانی نشد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete product agency admin
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        return back()->with('success', 'محصول حذف شد.');
    }
    public function downloadDemo($product_id)
    {
        $product = Product::findOrFail($product_id);
        return response()->download(public_path($product->demo_url));
    }
    public function downloadSource($product_id)
    {
        $product = Product::findOrFail($product_id);
        
        return response()->download(storage_path('app/local_storage/' . $product->source_url));
    }
    //upload image
    private function uploadImages($createdProduct, $validatedData)
    {
        try {
            $basePath = 'products/' . $createdProduct->id . "/";
            $sourceImageFullPath = null;
            $data = [];
            if (isset($validatedData['source_url'])) {
                $sourceImageFullPath = $basePath . 'source_url' . $validatedData['source_url']->getClientOriginalName();
                ImageUploader::upload($validatedData['source_url'], $sourceImageFullPath, 'local_storage');
                $data += ['source_url' => $sourceImageFullPath,];
                
            }
            if (isset($validatedData['thumbnail_url'])) {
                $fullPath = $basePath . 'thumbnail_url_' . $validatedData['thumbnail_url']->getClientOriginalName();
                ImageUploader::upload($validatedData['thumbnail_url'], $fullPath, 'public_storage');
                $data += ['thumbnail_url' => $fullPath];
            }
            if (isset($validatedData['demo_url'])) {

                $fullPath = $basePath . 'demo_url_' . $validatedData['demo_url']->getClientOriginalName();
                ImageUploader::upload($validatedData['demo_url'], $fullPath, 'public_storage');
                $data += ['demo_url' => $fullPath];
            }


            $updatedProduct = Product::find($createdProduct->id)->update($data);
            
            if (!$updatedProduct) {
                Product::find($createdProduct->id)->delete();
                throw new Exception('تصاویر آپلود نشدند.');
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
