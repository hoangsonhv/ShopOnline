<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = "orders";

    public $fillable = ['name','email','address','phone','gender','customer','total_order','id_user','id_bill','id_product','name_product','qty','price','paid','unpaid','status'];
}
