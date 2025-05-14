<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class UserNotifymailLog extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_user_notifymail_logs";
    protected $primarykey = "id";

    protected $fillable = [
        'user_id',
        'package',
        'name' ,
        'username',
        'email',
        'date_start',
        'date_end',
    ];

}
