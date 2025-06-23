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

    protected $fillable = [
        'name',
        'username',
        'password',
        'phone',
        'email',
        'line',
        'link_line',
        'type',
        'package',
        'id_package',
        'date_start',
        'date_end',
        'type_netflix',
        'open',
        'status_account',
    ];

    public function users_in_in()
    {
        return $this->hasMany(users_in_in::class, 'id_user');
    }

    public function userIn()
    {
        return $this->hasManyThrough(
            users_in::class, // โมเดลที่เราต้องการดึงข้อมูล
            users_in_in::class, // โมเดลที่เชื่อมกลาง
            'id_user', // คอลัมน์ที่เชื่อมจาก UsersInIn ไปยัง User
            'id', // คอลัมน์ที่เชื่อมจาก UserIn ไปยัง UsersInIn
            'id', // คอลัมน์ที่เชื่อมจาก User ไปยัง UsersInIn
            'id_user_in' // คอลัมน์ที่เชื่อมจาก UsersInIn ไปยัง UserIn
        );
    }
}
