<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Staff extends Model implements AuthenticatableContract
{
    use HasFactory;

    use Authenticatable;

    public $table = "staffs";

    protected $guarded = "staff";

    protected $fillable = [
        "name",
        "email",
        "address",
        "gender",
        "phone_number",
        "password",
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
