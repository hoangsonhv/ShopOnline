<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    //

    public function login()
    {

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("/");
        }
        return redirect()->back()->with('error', 'Vui lòng kiểm tra lại Email hoặc Mật khẩu');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function home()
    {
        return view('web/home');
    }
}
