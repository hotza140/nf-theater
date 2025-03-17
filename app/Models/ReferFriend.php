<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class ReferFriend extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_refer_friend";
    protected $primarykey = "id";

}
