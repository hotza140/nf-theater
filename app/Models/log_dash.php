<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in;
use App\Models\users_in_in;
use App\Models\users_in_in_history;

class log_dash extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_log_dash";
    protected $primarykey = "id";

    public function user_in_his()
    {
        return $this->belongsTo(users_in_in_history::class, 'id_in_in_history');
    }

}
