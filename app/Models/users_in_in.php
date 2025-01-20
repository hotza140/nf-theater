<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in;

class users_in_in extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_users_in_in";
    protected $primarykey = "id";

    public function user()
    {
        return $this->belongsTo(users::class, 'id_user');
    }
}
