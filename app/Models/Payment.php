<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = "payment";

    public $fillable = ['transaction_code','money','note','respone_code','code_vnpay','code_bank'];
}
