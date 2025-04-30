<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class dash_regis_to extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "dash_regis_to";
    protected $primarykey = "id";
}
