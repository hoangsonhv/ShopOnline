<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_Detail extends Model
{
    use HasFactory;

    public $table = "bill_details";

    public $fillable = ['id_bill','id_product','quantity','price'];

    public function Bill(){
        return $this->belongsTo(Bill::class,'id_bill','id');
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
