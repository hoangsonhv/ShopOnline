<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class StaffController extends Controller
{
    //

    public function showStaff(){
        $staffs = Staff::all();
        return view("administrators/staff/staff_list",[
            "staffs"=>$staffs
        ]);
    }

    public function addStaff(){
        return view("administrators/staff/staff_add");
    }

    public function saveStaff(Request $request){
//        dd($request);
        $request->validate([
            'name'=>"required",
            'email' => 'required|email|max:255|unique:staffs',
            'address' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'password' => 'required|min:8|max:20'
        ]);
        try {
            Staff::create([
                'name'=>$request->get("name"),
                'email' => $request->get("email"),
                'address' => $request->get("address"),
                'gender' => $request->get("gender"),
                'phone_number'=>$request->get("phone_number"),
                'password' => bcrypt($request->get("password")),
            ]);
        }catch (\Exception $e){
            return back()->with('error',"Không thể thêm mới. Hãy kiểm tra lại.!");
        }
        return redirect("admin/staffs")->with('success',"Thêm mới thành công.!");
    }

    public function editStaff($id){
        $staff = Staff::findOrFail($id);
        return view("administrators/staff/staff_edit",[
            "staff"=>$staff
        ]);
    }

    public function updateStaff(Request $request,$id){
//        dd($request);
        $request->validate([
            'name'=>"required",
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone_number'=>'required',
            'password' => 'required'
        ]);
        try {
            $staffs = Staff::findOrFail($id);
            $staffs->update([
                'name' => $request->get("name"),
                'email' => $request->get("email"),
                'address' => $request->get("address"),
                'gender' => $request->get("gender"),
                'phone_number' => $request->get("phone_number"),
                'password' => bcrypt($request->get("password")),
            ]);
        }catch (\Exception $e){
//            abort("404");
            return back()->with('error',"Cập nhật lỗi.!");
        }
        return redirect("admin/staffs")->with('success',"Update thành công.!");
    }

    public function deleteStaff($id){
        Staff::destroy($id);
        return redirect("admin/staffs")->with('success',"Xóa thành công.!");
    }


    public function updatePassword(){
        return view("administrators/staff/password");
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
            'password_confirm.same'     => 'Mật khẩu xác nhận không đúng',
        ]);
        $staff = Auth::user();
        if (Hash::check($request->password_old , $staff->password)) {
            $staff->password = bcrypt($request->get("password"));
            $staff->save();
            return redirect()->back()->with('success',"Cập nhật thành công!");
        }
        return redirect()->back()->with('error',"Mật khẩu cũ không đúng!");
    }
}
