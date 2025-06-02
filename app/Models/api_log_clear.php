<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class api_log_clear extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "api_log_clear";
    protected $primarykey = "id";
}
