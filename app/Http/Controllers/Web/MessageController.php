<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
        if (Auth::check()){
            $request->validate([
                "name"=>"required",
                "email"=>"required",
                "content"=>"required"
            ]);
            Messenger::create([
                "name"=>$request->get("name") ,
                "email"=>$request->get("email"),
                "content"=>$request->get("content")
            ]);
            return redirect()->back()->with('success',"Cảm ơn bạn đã góp ý kiến.Nhân viên của chúng tôi sẽ liên hệ lại.");
        }
        return back()->with('success',"Bạn chưa đăng nhập. Hãy đăng nhập để comment!");
    }
}
