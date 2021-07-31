<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $table = "brands";

    public $fillable = ['name','image'];

    public function Products(){
        return $this->hasMany(Product::class,'id_product','id');
    }

    public function brandImage(){
        if ($this->image){
            return asset("upload/".$this->image);
        }
        return asset("upload/default.png");
    }
}
