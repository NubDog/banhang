<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        // Share product types with all views
        $productTypes = ProductType::all();
        View::share('loai_sp', $productTypes);
    }

    public function getRegister()
    {
        return view('pages.dangky');
    }

    public function postRegister(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'full_name' => 'required',
                'repassword' => 'required|same:password',
                'phone' => 'required',
                'address' => 'required'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'repassword.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'full_name.required' => 'Vui lòng nhập họ tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'address.required' => 'Vui lòng nhập địa chỉ'
            ]
        );

        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        // Remove the level assignment for now
        // $user->level = 3;
        $user->save();

        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }

    public function getLogin()
    {
        return view('pages.dangnhap');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu tối đa 20 ký tự'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ]);
    }

    public function getLogout()
    {
        Auth::logout();
        Session::forget('cart');
        return redirect()->route('home');
    }

    // Add this temporarily to see the table structure
    public function checkUsersTable()
    {
        $columns = \Illuminate\Support\Facades\DB::select('SHOW COLUMNS FROM users');
        dd($columns); // This will display the table structure
    }
}