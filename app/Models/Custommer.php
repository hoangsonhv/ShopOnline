<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custommer extends Model
{
    use HasFactory;

    public $table = "customers";

    public $fillable = ['name','gender','email','address','phone_number'];

    public function Bill(){
        $this->hasMany(Bill::class,'id_customer','id');
    }
}
