<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //

    public function showTeam(){
        $teams = Team::all();
        $team1 = Team::all();
        return view("administrators/team/team_list",[
            "teams"=>$teams,
            "team1"=>$team1
        ]);
    }

    public function addTeam(){
        return view("administrators/team/team_add");
    }

    public function saveTeam(Request $request){
        $request->validate([
            "name"=>"required",
            "age"=>"required",
            "position"=>"required",
            "address"=>"required",
            "phone"=>"required",
            "email"=>"required|unique:users"
        ],[
            "name.required"=>"Vui lòng nhập tên.!",
            "age.required"=>"Vui lòng nhập tuổi.!",
            "position.required"=>"Vui lòng nhập chức vụ.!",
            "address.required"=>"Vui lòng nhập địa chỉ.!",
            "phone.required"=>"Vui lòng nhập số điện thoại.!",
            "email.required"=>"Vui lòng nhập email.!",
            "email.unique"=>"Email không được trùng lặp.!",
        ]);

        $image = null;
        if ($request->has("image")){
            $file = $request->file("image");
            $exName = $file->getClientOriginalExtension();
            $fileName = time().".".$exName;
            $fileSize = $file->getSize();
            $allow = ["png","jpeg","jpg","gif"];

            if (in_array($exName,$allow)){
                if ($fileSize < 10000000){
                    $upload = "upload";
                    if (\Illuminate\Support\Facades\File::exists($upload) == true){
                        try {
                            $file->move("upload",$fileName);
                            $image = $fileName;
                        }catch (\Exception $e){}
                    }else{
                        mkdir(\Illuminate\Support\Facades\File::makeDirectory($upload,0777,true));
                        try {
                            $file->move("upload",$fileName);
                            $image = $fileName;
                        }catch (\Exception $e){}
                    }
                }
            }
        }
        try{
            Team::create([
                "name"=>$request->get("name"),
                "image"=>$image,
                "age"=>$request->get("age"),
                "position"=>$request->get("position"),
                "address"=>$request->get("address"),
                "phone"=>$request->get("phone"),
                "email"=>$request->get("email")
            ]);
        }catch (\Exception $e){
            return back()->with("error","Không thể thêm mới.!");
        }
        return redirect("admin/teams")->with("success","Đăng ký thành công.!");
    }

    public function editTeam($id){
        $teams = Team::findOrFail($id);
        return view("administrators/team/team_edit",[
            "teams"=>$teams
        ]);
    }

    public function updateTeam(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "age"=>"required",
            "position"=>"required",
            "address"=>"required",
            "phone"=>"required",
            "email"=>"required"
        ]);
        try {
            $image = request("image");
            if ($image) {
                $image = null;
                if ($request->has("image")) {
                    $file = $request->file("image");
                    $exName = $file->getClientOriginalExtension();
                    $fileName = time() . "." . $exName;
                    $fileSize = $file->getSize();
                    $allow = ["png", "jpeg", "jpg", "gif"];
                    if (in_array($exName, $allow)) {
                        if ($fileSize < 10000000) {
                            try {
                                $file->move("upload", $fileName);
                                $image = $fileName;
                            } catch (\Exception $e) {
                            }
                        }
                    }
                }
                $team = Team::findOrFail($id);
                $team->update([
                    "name" => $request->get("name"),
                    "image" => $image,
                    "age" => $request->get("age"),
                    "position" => $request->get("position"),
                    "address" => $request->get("address"),
                    "phone" => $request->get("phone"),
                    "email" => $request->get("email")
                ]);
            }else{
                $team = Team::findOrFail($id);
                $team->update([
                    "name"=>$request->get("name"),
                    "age"=>$request->get("age"),
                    "position"=>$request->get("position"),
                    "address"=>$request->get("address"),
                    "phone"=>$request->get("phone"),
                    "email"=>$request->get("email")
                ]);
            }
        }catch (\Exception $e){
            return back()->with("error","Không thể cập nhật.Hãy kiểm tra lại.!");
        }
        return redirect()->to("admin/teams")->with("success","Cập nhật thành công.!");
    }

    public function deleteTeam($id){
        try {
            Team::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/teams")->with('success',"Xóa thành công.!");
    }
}
