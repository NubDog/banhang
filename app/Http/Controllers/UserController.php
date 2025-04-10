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
        // Validation code remains the same
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
        $user->level = 3; // Regular user
        $user->save();

        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }

    public function getLogin()
    {
        return view('pages.dangnhap');
    }

    public function postLogin(Request $request)
    {
        $validated = $request->validate(
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự'
            ]
        );
        
        $credentials = array('email'=>$request->email, 'password'=>$request->password);
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->level == 1 || $user->level == 2) {
                // Redirect to admin dashboard if user is admin
                return redirect('/admin/dashboard')->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
            } else {
                // Redirect to home page for regular users
                return redirect('/')->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
            }
        } else {
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Add this temporarily to see the table structure
    public function checkUsersTable()
    {
        $columns = \Illuminate\Support\Facades\DB::select('SHOW COLUMNS FROM users');
        dd($columns); // This will display the table structure
    }
}