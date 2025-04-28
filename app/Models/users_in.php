<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in_in;

class users_in extends Authenticatable
{
    use SoftDeletes;
    protected $table = "tb_users_in";
    protected $primarykey = "id";

    // UserIn.php
    public function usersInIns()
    {
        return $this->hasMany(users_in_in::class, 'id_user_in');
    }


    public function users_in_in_mobile()
    {
        return $this->hasMany(users_in_in::class, 'id_user_in')->where('type', 'MOBILE');
    }

    public function users_in_in_pc()
    {
        return $this->hasMany(users_in_in::class, 'id_user_in')->where('type', 'PC');
    }

    // ฟังก์ชันสำหรับนับจำนวน user
    public function count_in_in()
    {
        return users_in_in::where('id_user_in', $this->id)->count();
    }

    // ฟังก์ชันสำหรับนับจำนวน user ที่ยังไม่หมดอายุ
    public function count_in_in_use()
    {
        $date=date('Y-m-d');
        return users_in_in::where('id_user_in', $this->id)->whereDate('date_start', '<=', $date)
        ->whereDate('date_end', '>=', $date)->count();
    }


    // public function getEligibleUser()
    // {
    //     $date = date('Y-m-d'); // วันที่ปัจจุบัน
    
    //     $eligibleUsers = self::where(function ($query) use ($date) {
    //         // กรณีที่มีข้อมูลใน users_in_in
    //         $query->whereHas('users_in_in', function ($subQuery) use ($date) {
    //             $subQuery->whereHas('user', function ($userQuery) use ($date) {
    //                 $userQuery->whereDate('date_start', '<=', $date)
    //                           ->whereDate('date_end', '>=', $date)
    //                           ->where('open',0);
    //             });
    //         });
    //         // หรือกรณีที่ไม่มีข้อมูลใน users_in_in
    //         $query->orDoesntHave('users_in_in');
    //     })
    //     ->withCount('users_in_in') // นับจำนวน `users_in_in`
    //     ->having('users_in_in_count', '<', 5) // เงื่อนไขไม่เกิน 6 ตัว
    //     ->inRandomOrder() // สุ่มลำดับ
    //     ->first(); // ดึงตัวแรกที่สุ่มได้
    
    //     return $eligibleUsers; // คืนค่าผลลัพธ์
    // }

    // public function getEligibleUser()
    // {
    //     $date = date('Y-m-d');
    //     $eligibleUsers = self::where(function ($query) use ($date) {
    //         $query->whereHas('users_in_in', function ($subQuery) use ($date) {
    //             $subQuery->whereDate('date_start', '<=', $date)
    //                     ->whereDate('date_end', '>=', $date);
    //             });
    //     })
    //     ->orDoesntHave('users_in_in')
    //     ->withCount('users_in_in')
    //     ->having('users_in_in_count', '<', 5)
    //     ->inRandomOrder()
    //     ->first();

    //     return $eligibleUsers;
    // }

    public function getEligibleUser()
    {
        $date = date('Y-m-d');
        $eligibleUsers = self::where('open',0)->whereNull('type_f')->where(function ($query) use ($date) {
            $query->whereHas('users_in_in_mobile', function ($subQuery) use ($date) {
                $subQuery->whereHas('user', function ($userQuery) use ($date) {
                    $userQuery->whereNotNull('type_netflix')
                              ->whereDate('date_start', '<=', $date)
                              ->whereDate('date_end', '>=', $date)
                              ->where('open', 0);
                });
            });
            $query->orDoesntHave('users_in_in_mobile');
        })
        ->withCount('users_in_in_mobile') // นับเฉพาะ MOBILE
        ->having('users_in_in_mobile_count', '<', 5)
        ->first();

        return $eligibleUsers;
    }


    public function getEligibleUser_pc()
    {
    $date = date('Y-m-d');

    $eligibleUsers = self::where('open',0)->whereNull('type_f')->where(function ($query) use ($date) {
        $query->whereHas('users_in_in_pc', function ($subQuery) use ($date) {
            $subQuery->whereHas('user', function ($userQuery) use ($date) {
            $userQuery->whereNotNull('type_netflix')
                     ->whereDate('date_start', '<=', $date)
                     ->whereDate('date_end', '>=', $date)
                     ->where('open', 0)
                     ->where(function ($q) {
                         $q->whereNull('type_mail') // type_mail เป็น NULL หรือ ''
                           ->orWhere('type_mail', '')
                           ->orWhere(function ($pcQuery) { // หรือมี PC อยู่แค่ 1 ตัว
                               $pcQuery->where('type', 'PC')
                                       ->havingRaw('COUNT(*) < 2');
                           });
                     });
                    });
        });
        $query->orDoesntHave('users_in_in_pc');
    })
    ->withCount('users_in_in_pc')
    ->having('users_in_in_pc_count', '<', 2) // ต้องไม่เกิน 2 ตัว
    ->first();

    return $eligibleUsers;
    }


    // ->inRandomOrder()


    // ฟังก์ชันสำหรับเรียก user
    public function get_in_in()
    {
        return users_in_in::where('id_user_in', $this->id)->get();
    }




    public function getEligibleUser_youtube()
    {
        $date = date('Y-m-d');
        $eligibleUsers = self::where('open',0)->whereNotNull('type_f')->whereNull('t_house')->where(function ($query) use ($date) {
            $query->whereHas('users_in_in_mobile', function ($subQuery) use ($date) {
                $subQuery->whereHas('user', function ($userQuery) use ($date) {
                    $userQuery->whereNotNull('type_youtube')
                              ->whereDate('date_start', '<=', $date)
                              ->whereDate('date_end', '>=', $date)
                              ->where('open', 0);
                });
            });
            $query->orDoesntHave('users_in_in_mobile');
        })
        ->withCount('users_in_in_mobile') // นับเฉพาะ MOBILE
        ->having('users_in_in_mobile_count', '<', 5)
        ->first();

        return $eligibleUsers;
    }


}
