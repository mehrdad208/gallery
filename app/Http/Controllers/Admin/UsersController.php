<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;

class UsersController extends Controller
{
    //show all users and admin for admin
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.all', compact('users'));
    }
    //create new user agency admin
    public function create()
    {
        return view('admin.users.add');
    }
    // delete user agency admin
    public function destroy($id)
    {
        $userDeleted = User::findOrFail($id)->delete();
        if ($userDeleted) {
            return back()->with('success', 'کاربر حذف شد.');
        }
        return back()->with('failed', 'کاربر حذف نشد.');
    }
    //show one user for edit in edit view
    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));

    }
    //store new user
    public function store(StoreRequest $request){
        $validatedData = $request->validated();
       $createdUser=User::create([
            'name'=> $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile'=> $validatedData['mobile'],
            'role'=> $validatedData['role'],
            'national_code'=> $validatedData['national_code'],
        ]);
        if($createdUser){
            return back()->with('success', 'کاربر ایجاد شد');
        }
        return back()->with('failed','کاربر ایجاد نشد');
        
    }

    //store update data in one user 
    public function update(UpdateRequest $request,$id){
        
        $validatedData= $request->validated();
        $updateUser= User::findOrFail($id)->update([
            'name'=> $validatedData['name'],
            'email'=> $validatedData['email'],
            'mobile'=> $validatedData['mobile'],
            'role'=> $validatedData['role'],
        ]);
        if($updateUser){
            return back()->with('success', 'کاربر بروزرسانی شد.');
        }
        return back()->with('failed', 'کاربر بروزرسانی نشد.');

    }


    


   
}
