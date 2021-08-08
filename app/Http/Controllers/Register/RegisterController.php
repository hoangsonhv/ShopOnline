<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ],[
            'name.max'=>'Tên quá dài!',
            'email.unique'=>'Email đã được sử dụng!',
            'email.max'=>'Email quá dài!',
            'password.min'=>'Mật khẩu phải chứa ít nhất 8 kí tự!',
            'password_confirmation.same'=>'Nhập lại mật khẩu không đúng!',
        ]);
        User::create([
            'name' => $request->get("name"),
            'email' => $request->get("email"),
            'password' => Hash::make($request->get("password")),
        ]);
        return redirect('login');
    }

    public function CheckOut(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ],[
            'name.max'=>'Tên quá dài!',
            'email.unique'=>'Email đã được sử dụng!',
            'email.max'=>'Email quá dài!',
            'password.min'=>'Mật khẩu phải chứa ít nhất 8 kí tự!',
            'password_confirmation.same'=>'Nhập lại mật khẩu không đúng!',
        ]);
        User::create([
            'name' => $request->get("name"),
            'email' => $request->get("email"),
            'password' => Hash::make($request->get("password")),
        ]);
        return redirect()->back()->with('success',"Đăng ký thành công.Hãy Đăng nhập để mua hàng!");
    }
}
