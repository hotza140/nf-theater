<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class delete_pass extends Authenticatable
{
    protected $table = "delete_pass";
    protected $primarykey = "id";
}
