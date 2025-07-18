<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Mail\Email;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\TokenGuard;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\support\carbon;
use DateTime;
use PDF;
use Yajra\DataTables\Facades\DataTables;

use App\Models\users;
use App\Models\users_in;
use App\Models\users_in_in;
use App\Models\users_in_in_history;
use App\Models\admin;
use App\Models\country;
use App\Models\alert;
use App\Models\log_dash;
use App\Models\dash_regis_to;

use App\Models\created_history;

use App\Models\api_log_clear;


use JfBiswajit\PHPBigQuery\Facades\BigQuery;
use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\BigQuery\QueryJobConfiguration;



class ApiController extends Controller

{

  
     
    public function api_call_bot()
    {
        try {

    $ddd = users_in_in::pluck('id')->ToArray();

        // ลบเช็คเวลา
        $date = date('Y-m-d');
        $item = users_in_in_history::whereDate('date_end', '<=', $date)
        ->whereNotIn('id_user_in_in',$ddd)
        ->whereNull('status_check')
        ->whereNull('api_status')
        ->groupBy('id_user_in')
        ->get();
        // ลบเช็คเวลา

$account = [];
// dd($item);

foreach ($item as $aaa) {
    $row = users_in::where('id',$aaa->id_user_in)->first();

    if($row!=null){

    // ดึงชื่อผู้ใช้ที่ type_netflix ไม่เป็น null
    $users_check_user = users_in_in_history::whereDate('date_end', '<=', $date)
    ->where('id_user_in', @$row->id) // ใช้ id_user_in แทน $row->id
    ->whereNotIn('id_user_in_in',$ddd)
    ->whereNull('status_check')
    ->pluck('id_user')
    ->toArray();

    $users_update = users::whereIn('id', $users_check_user)
    ->whereNotNull('type_netflix')
    ->pluck('name')
    ->toArray();

    if (!empty($users_update)) {

    $email = @$row->email;

    if (!isset($account[$email])) {
        $account[$email] = [
            'password' => @$row->password,
            'profile' => []
        ];
    }

    // รวมชื่อที่ยังไม่มีใน profile
    foreach ($users_update as $name) {
        if (!in_array($name, $account[$email]['profile'])) {
            $account[$email]['profile'][] = $name;
        }
    }

    }


    }


}
            

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'result' => [
                    'account' => $account,
                ],
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }


        
    }





    public function api_call_bot_fall_back(Request $r)
    {
        try {

            $date=date('Y-m-d');

            $data = $r->all();
            if (empty($data)) {
                return response()->json([
                    'status' => false,
                    'message' => 'ข้อมูลไม่ถูกต้อง'
                ], 400);
            }

            // ตรวจสอบว่า success เป็น true
            if ($data['success']) {
                $email = $data['email'];
                $newPassword = $data['new_password'];
                $profile=$data['profile'];

                $row = users_in::whereNull('type_f')->where('email',$email)->first();

                if($row==null){
                    return response()->json([
                        'status' => false,
                        'message' => 'ไม่พบบัญชีที่ตรงกัน'
                    ], 400);
                }

                $row->password=$newPassword;
                $row->save();

                $ddd = users_in_in::pluck('id')->ToArray();

                $save = users_in_in_history::whereDate('date_end', '<=', $date)
                ->where('id_user_in', @$row->id) // ใช้ id_user_in แทน $row->id
                ->whereNotIn('id_user_in_in',$ddd)
                ->whereNull('status_check')
                ->pluck('id_user')->ToArray();

                if (!empty($save)) {
                $saveString = implode(',', $save);

                $profile = DB::table('tb_users')->whereIn('id',$save)->pluck('name')->ToArray();
                $ym = implode(', ', @$profile);
                $detail=$row->name.' Profile ที่แก้ใข -> '.@$ym;
                }


                $users_check_user = users_in_in_history::whereDate('date_end', '<=', $date)
                ->where('id_user_in', @$row->id) // ใช้ id_user_in แทน $row->id
                ->whereNotIn('id_user_in_in',$ddd)
                ->whereNull('status_check')
                ->update(['api_status' => '1']);

                $new=new api_log_clear();
                $new->id_user=@$saveString;
                $new->id_user_in=@$row->id;
                $new->detail=@$detail;
                $new->save();



                return response()->json([
                    'status' => true,
                    'message' => 'success!.'
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'ไม่สามารถดำเนินการได้'
                ], 400);
            }
    
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }








    public function api_call_account_almost()
    {
        try {

            $date=date('Y-m-d');

            $accountList = users_in::where('open', 0)
            ->whereNull('type_f')
            ->whereBetween('date_end', [
                $date,
                date('Y-m-d', strtotime('+1 days', strtotime($date)))
            ])
            ->get([
                'date_end',
                'email',
                'password',
                'email01',
                'password01',
                'email02',
                'password02',
            ])
            ->toArray();

                return response()->json([
                    'status' => true,
                    'message' => 'success!.',
                    'accountList' => $accountList,
                ]);
    
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    


    

}