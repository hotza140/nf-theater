<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class PayPackNotmatch extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_pay_pack_notmatch";
    protected $primarykey = "id";

}
