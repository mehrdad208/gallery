<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Bus\UpdatedBatchJobCounts;
use App\Http\Requests\Admin\Categories\StoreResult;
use App\Http\Requests\Admin\Categories\UpdateRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all categories in admin page
    public function index()
    {
      $categories=Category::paginate(10);
       return view('admin.categories.all',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show create category for admin
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // store data for create category
    public function store(StoreResult $request)
    {
        $validatedData=$request->validated();
        $createdCategory=Category::create([
            
            'title'=>$validatedData['title'],
            'slug'=>$validatedData['slug'],
        ]);
        if(!$createdCategory){
            return back()->with('failed','دسته بندی ایجاد نشد');
        }
        return back()->with('success','دسته بندی ایجاد شد');

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
    //show edit category for admin
    public function edit($id)

    {
        $category=Category::find($id);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //update data for one category
    public function update(UpdateRequest $request, $id)
    {
     
        $category=Category::find($id)->update([
            'title'=>$request['title'],
            'slug'=>$request['slug'],

        ]);
        if($category){
            return back()->with('success','دسته بندی آپدیت شد');
       }
       return back()->with('failed','دسته بندی آپدیت نشد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //delete one category 
    public function destroy($category_id)
    {
        $category=Category::find($category_id)->delete();
        return back()->with('success','دسته بندی حذف شد');
    }

    //search one category in all categories
    public function search(Request $request){
      $categories=Category::where('title','like','%'.$request['search'].'%')->paginate(10);
      return view('admin.categories.all',compact('categories'));


    }
}
