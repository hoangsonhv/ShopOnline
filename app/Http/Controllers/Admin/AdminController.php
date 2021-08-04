<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Staff;
use App\Models\Admin;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function showAdmin(){
        $admins = Admin::all();
        return view("administrators/admin/admin_list",[
            "admins"=>$admins
        ]);
    }

    public function addAdmin(){
        return view("administrators/admin/admin_add");
    }

    public function saveAdmin(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);
        try {
            Admin::create([
                "name"=>$request->get("name"),
                "email"=>$request->get("email"),
                "password"=>bcrypt($request->get("password")),
            ]);
        }catch (\Exception $e){
            return back()->with('error','Không thể thêm mới.!');
        }
        return redirect("admin/admins")->with('success',"Thêm mới thành công.!");
    }

    public function editAdmin($id){
        $admin = Admin::findOrFail($id);
        return view("administrators/admin/admin_edit",[
            "admin"=>$admin
        ]);
    }

    public function updateAdmin(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);
        try {
            $admins = Admin::findOrFail($id);
            $admins->update([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "password" => bcrypt($request->get("password"))
            ]);
        }catch (\Exception $e){
            return back()->with('error','Cập nhật lỗi. Hãy kiểm tra lại.!');
        }
        return redirect("admin/admins")->with('success',"Cập nhật thành công.!");
    }

//    public function deleteAdmin($id){
//        User::findOrFail($id)->delete();
//        return redirect("admin/users");
//    }


    //

    public function homeAdmin()
    {
        if (Auth::guard("admin")->check() ){
            $teams = Team::all();
            return view("administrators/admin/home", [
                "teams" => $teams
            ]);
        }elseif(Auth::guard("staff")->check()){
            return redirect("admin/bills");
        }
        else{
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
