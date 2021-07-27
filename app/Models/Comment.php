<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $fillable = ['id','id_user','id_product','content'];

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function Product(){
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
