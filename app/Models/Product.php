<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = "products";

    public $fillable = ['id','name','image','description','unit_price','promotion_price','qty','id_category'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function BillDetail(){
       return $this->hasMany(Bill_Detail::class);
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
}
