<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = "payment";

    public $fillable = ['transaction_code','money','note','respone_code','code_vnpay','code_bank','id_user'];

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }
}
