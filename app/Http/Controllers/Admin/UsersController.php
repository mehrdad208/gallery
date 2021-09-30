<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            return back()->with('success', 'یوزر حذف شد.');
        }
        return back()->with('failed', 'یوزر حذف نشد.');
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));

    }
}
