<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $table = "blogs";

    public $fillable = ['image','image2','image3','title','content','summary','outstanding','date'];

    public function blogImage(){
        if ($this->image){
            return asset("upload/".$this->image);
        }
        return asset("upload/default.png");
    }

    public function aImage(){
        if ($this->image2){
            return asset("upload/".$this->image2);
        }
        return asset("upload/default.png");
    }

    public function bImage(){
        if ($this->image3){
            return asset("upload/".$this->image3);
        }
        return asset("upload/default.png");
    }
}
