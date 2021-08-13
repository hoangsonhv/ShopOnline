<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Messenger;
use App\Models\Slide;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showMes(){
        $messages = Messenger::all();
        return view("administrators/message/message_list",[
            "messages"=>$messages
        ]);
    }

    public function deleteMes($id){
        try {
            Messenger::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/messages")->with('success',"Xóa thành công.!");
    }

    public function updateMess(Request $request,$id){
        try {
            $messages = Messenger::findOrFail($id);
            $messages->update([
                'status'=>$request->get("status"),
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with('error',"Update không thành công!");
        }
        return redirect()->back()->with('success',"Update thành công!");
    }
}
