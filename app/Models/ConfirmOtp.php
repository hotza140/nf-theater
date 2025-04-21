<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class ConfirmOtp extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_confirm_otp";
    protected $primarykey = "id";

}
