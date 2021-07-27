<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    public $table = "bills";

    public $fillable = ['id_customer','code_orders','total','payment','status'];

    public function Custommer(){
        $this->belongsTo(Custommer::class,'id_customer','id');
    }

    public function BillDetail(){
        $this->hasMany(Bill_Detail::class,'id_bill','id');
    }
}
