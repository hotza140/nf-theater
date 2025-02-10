<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class PackageSubwatch extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_package_subwatch";
    protected $primarykey = "id";

}
