<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        // Chia sẻ biến loai_sp với tất cả các view
        $productTypes = ProductType::all();
        View::share('loai_sp', $productTypes);
    }
    
    // Các phương thức khác giữ nguyên
}