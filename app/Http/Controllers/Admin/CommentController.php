<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function listComment(){
        $products = Product::with("category")->get();
        $comment = Comment::with(['user','product'])->get();
        return view("administrators/comment/comment",[
            "products"=>$products,
            "comment"=>$comment
        ]);
    }

    public function detailComment($id){
        $products = Product::with("category")->get();
        $comment = Comment::with(["product"])->where("id_product",$id)->get();
        return view("administrators/comment/comment_detail",[
            "comment"=>$comment,
            "products"=>$products,
        ]);
    }
    public function deleteComment($id){
        Comment::destroy($id);
        return redirect("admin/comments");
    }

    public function updateComment(Request $request,$id){
        try {
            $comment = Comment::findOrFail($id);
            $comment->update([
                'status'=>$request->get("up_status"),
            ]);
        }catch (\Exception $e){
            return redirect()->back()->with('error',"Update không thành công!");
        }
        return redirect()->back()->with('success',"Update thành công!");
    }
}
