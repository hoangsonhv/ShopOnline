<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        if (Auth::guard("admin")->check() || Auth::guard("staff")->check()){
            $teams = Team::all();
            return view("administrators/admin/home", [
                "teams" => $teams
            ]);
        }else{
            return redirect("admin/login");
        }
    }

    public function getLogin()
    {
        if (Auth::guard('admin')->check() || Auth::guard('staff')->check()) {
            return redirect("admin");
        } else {
            return view("administrators/admin/login");
        }

    }

    public function postLogin(Request $request){
        $credentials = $request->only("email","password");
        if (Auth::guard('admin')->attempt($credentials) || Auth::guard('staff')->attempt($credentials)) {
            return redirect("admin");
        }else{
            return redirect("admin/login");
        }
    }

    public function logout(){
        Auth::guard("admin")->logout();
        Auth::guard("staff")->logout();
        return redirect("admin/login");
    }
}
