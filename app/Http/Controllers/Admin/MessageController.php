<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
