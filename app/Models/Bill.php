<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    public $table = "bills";

    public $fillable = ['id','id_customer','total','payment','status','id_user','reason','paid','unpaid'];

    public function bill_detail(){
        return $this->hasMany(Bill_Detail::class,'id_bill','id');
    }

    public function customer(){
        return $this->belongsTo(Custommer::class,'id_customer','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }
}
