<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.all', compact('users'));
    }
    public function create()
    {
        return view('admin.users.add');
    }
    public function destroy($id)
    {
        $userDeleted = User::findOrFail($id)->delete();
        if ($userDeleted) {
            return back()->with('success', 'کاربر حذف شد.');
        }
        return back()->with('failed', 'کاربر حذف نشد.');
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));

    }
    public function store(StoreRequest $request){
        $validatedData = $request->validated();
       $createdUser=User::create([
            'name'=> $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile'=> $validatedData['mobile'],
            'role'=> $validatedData['role'],
        ]);
        if($createdUser){
            return back()->with('success', 'کاربر ایجاد شد');
        }
        return back()->with('failed','کاربر ایجاد نشد');
        
    }
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
