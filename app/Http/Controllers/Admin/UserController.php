<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function listUser(){
        $users = User::all();
        return view("administrators/user/user_list",[
            "users"=>$users
        ]);
    }

    public function addUser(){
        return view("administrators/user/user_add");
    }

    public function saveUser(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);
        try {
            User::create([
                "name"=>$request->get("name"),
                "email"=>$request->get("email"),
                "password"=>bcrypt($request->get("password")),
            ]);
        }catch (\Exception $e){
            return back()->with('error','Không thể thêm mới.!');
        }
        return redirect("admin/users")->with('success',"Thêm mới thành công.!");
    }

    public function editUser($id){
        $user = User::findOrFail($id);
        return view("administrators/user/user_edit",[
            "user"=>$user
        ]);
    }

    public function updateUser(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);
        try {
            $users = User::findOrFail($id);
            $users->update([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "password" => bcrypt($request->get("password"))
            ]);
        }catch (\Exception $e){
            return back()->with('error','Cập nhật lỗi. Hãy kiểm tra lại.!');
        }
        return redirect("admin/users")->with('success',"Cập nhật thành công.!");
    }

    public function deleteUser($id){
        User::findOrFail($id)->delete();
        return redirect("admin/users");
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
