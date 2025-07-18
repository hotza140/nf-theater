<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in;

class users_in_in_history extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_users_in_in_history";
    protected $primarykey = "id";

    protected $fillable = [
        'id_user',
        'id_user_in',
        'type',
        'date_start',
        'date_end',
        'id_user_in_in',
        'type_mail',
    ];

    public function user()
    {
        return $this->belongsTo(users::class, 'id_user');
    }

    public function user_in()
    {
        return $this->belongsTo(users_in::class, 'id_user_in');
    }
}
