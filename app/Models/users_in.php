<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; 

use App\Models\users;
use App\Models\users_in_in;

class users_in extends Authenticatable
{
    // use SoftDeletes;
    protected $table = "tb_users_in";
    protected $primarykey = "id";

    public function users_in_in()
    {
        return $this->hasMany(users_in_in::class, 'id_user_in');
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


    public function getEligibleUser()
    {
        $date = date('Y-m-d'); // วันที่ปัจจุบัน
    
        $eligibleUsers = self::where(function ($query) use ($date) {
            // กรณีที่มีข้อมูลใน users_in_in
            $query->whereHas('users_in_in', function ($subQuery) use ($date) {
                $subQuery->whereHas('user', function ($userQuery) use ($date) {
                    $userQuery->whereDate('date_start', '<=', $date)
                              ->whereDate('date_end', '>=', $date)
                              ->where('open',0);
                });
            });
            // หรือกรณีที่ไม่มีข้อมูลใน users_in_in
            $query->orDoesntHave('users_in_in');
        })
        ->withCount('users_in_in') // นับจำนวน `users_in_in`
        ->having('users_in_in_count', '<', 7) // เงื่อนไขไม่เกิน 6 ตัว
        ->inRandomOrder() // สุ่มลำดับ
        ->first(); // ดึงตัวแรกที่สุ่มได้
    
        return $eligibleUsers; // คืนค่าผลลัพธ์
    }



    // ฟังก์ชันสำหรับเรียก user
    public function get_in_in()
    {
        return users_in_in::where('id_user_in', $this->id)->get();
    }


}
