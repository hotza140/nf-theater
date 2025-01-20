<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class users extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_users";
    protected $primarykey = "id";

    public function users_in_in()
    {
        return $this->hasMany(users_in_in::class, 'id_user');
    }
}
