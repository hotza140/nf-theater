<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in_in;

class Coupon extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_coupons";
    protected $primarykey = "id";

}
