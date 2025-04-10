<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.user-list', compact('users'));
    }

    public function create()
    {
        return view('admin.user.user-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|numeric',
            'address' => 'nullable',
            'level' => 'required|in:0,1,2',
        ]);

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->level = $request->level;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Thêm người dùng thành công');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'full_name' => 'required|min:3',
            'phone' => 'nullable|numeric',
            'address' => 'nullable',
            'level' => 'required|in:0,1,2',
        ];
        
        if ($request->filled('password')) {
            $rules['password'] = 'min:6|confirmed';
        }
        
$request->validate($rules);

        $user->full_name = $request->full_name;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->level = $request->level;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Cập nhật người dùng thành công');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();
        
        return redirect()->route('admin.user.index')->with('success', 'Xóa người dùng thành công');
    }
}