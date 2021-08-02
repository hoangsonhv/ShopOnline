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
        $comment = Comment::with("user")->get();
        return view("administrators/comment/comment",[
            "products"=>$products,
            "comment"=>$comment
        ]);
    }
    public function deleteComment($id){
        Comment::destroy($id);
        return redirect("admin/comments");
    }
}
