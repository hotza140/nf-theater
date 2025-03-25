<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class log_dash extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_log_dash";
    protected $primarykey = "id";
}
