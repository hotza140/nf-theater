<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in;

class created_history extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_his_created_user";
    protected $primarykey = "id";
}
