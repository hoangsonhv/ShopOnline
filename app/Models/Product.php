<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = "products";

    public $fillable = ['id','cost','name','image','description','information','parameter','unit_price','promotion_price','qty','new','color','id_category','id_brand','pro_pay','pro_view'];

    public function Category(){
        return $this->belongsTo(Category::class,'id_category','id');
    }

    public function Brand(){
        return $this->belongsTo(Brand::class,'id_brand','id');
    }

    public function BillDetail(){
       return $this->hasMany(Bill_Detail::class);
    }

    public function Rating(){
        return $this->belongsTo(Rating::class,'product_id','id');
    }

    public function getImage(){
        if ($this->image){
            return asset("upload/".$this->image);
        }
        return asset("upload/default.png");
    }

    public function Comment(){
        return $this->hasMany(Comment::class,'id_product','id');
    }

    public function Reply_Comment(){
        return $this->hasMany(ReplyComment::class,'id_product','id');
    }
}
