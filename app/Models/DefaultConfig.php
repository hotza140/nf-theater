<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class DefaultConfig extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_default_config";
    protected $primarykey = "id";

}
