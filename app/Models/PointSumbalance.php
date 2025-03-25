<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class PointSumbalance extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_point_sumbalance";
    protected $primarykey = "id";

}
