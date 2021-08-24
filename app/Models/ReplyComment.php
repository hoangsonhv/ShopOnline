<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    protected $table = "reply";
    protected $fillable = ['id_comments','id_user','id_product','content','status'];

    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function Product(){
        return $this->belongsTo(Product::class,'id_product','id');
    }

    public function Comment(){
        return $this->belongsTo(Comment::class,"id_comments","id");
    }


}
