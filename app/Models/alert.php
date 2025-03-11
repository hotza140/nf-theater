<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class alert extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_alert";
    protected $primarykey = "id";
}
