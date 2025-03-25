<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class OrderPayPackageTruewallet extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_order_pay_package_truewallet";
    protected $primarykey = "id";

}
