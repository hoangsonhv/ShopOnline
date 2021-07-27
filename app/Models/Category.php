<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $table = "categories";

    public $fillable = ['name'];

    public function Product(){
        $this->hasMany(Product::class,'id_category','id');
    }
}
