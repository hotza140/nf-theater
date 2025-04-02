<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class ConfirmMail extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_confirm_mail";
    protected $primarykey = "id";

}
