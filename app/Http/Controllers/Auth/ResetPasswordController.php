<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    //
    public function getPassword($token) {

        return view('auth/password/reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);
        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->get("email"), 'token' => $request->get("token")])
            ->first();
        if(!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');
            $user = User::where('email', $request->get("email"))
                    ->update(['password' => Hash::make($request->get("password"))]);

        DB::table('password_resets')->where(['email'=> $request->get("email")])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');

    }
}
