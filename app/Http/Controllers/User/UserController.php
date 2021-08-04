<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function updatePassword(){
        return view("web/user/password");
    }

    public function saveUpdatePassword(Request $request){
        $request->validate([
            'password_old'     => 'required',
            'password'         => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ],[
            'password_old.required'     => 'Trường này không được để trống',
            'password.required'         => 'Trường này không được để trống',
            'password.min'              => 'Mật khẩu phải chứa từ 8 ký tự',
            'password_confirm.required' => 'Trường này không được để trống',
            'password_confirm.same' => 'Mật khẩu xác nhận không đúng',
        ]);
        $user = Auth::user();
        if (Hash::check($request->password_old , $user->password)) {
            $user->password = bcrypt($request->get("password"));
            $user->save();
            return redirect()->back()->with('success',"Cập nhật thành công!");
        }
        return redirect()->back()->with('error',"Mật khẩu cũ không đúng!");
    }
}
