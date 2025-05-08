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


use JfBiswajit\PHPBigQuery\Facades\BigQuery;
use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\BigQuery\QueryJobConfiguration;



class ApiController extends Controller

{

  
     
    public function test_api()
    {
        try {

      // ลบเช็คเวลา
$date = date('Y-m-d');
$item = users_in_in::whereDate('date_end', '>=', $date)
    ->groupBy('id_user_in')
    ->get();
// ลบเช็คเวลา

$account = [];
// dd($item);

foreach ($item as $aaa) {
    $row = users_in::where('id',$aaa->id_user_in)->first();

    $email = @$row->email;

    if (!isset($account[$email])) {
        $account[$email] = [
            'password' => @$row->password,
            'profile' => []
        ];
    }

    // ดึงชื่อผู้ใช้ที่ type_netflix ไม่เป็น null
    $users_check_user = users_in_in::whereDate('date_end', '>=', $date)
        ->where('id_user_in', @$row->id) // ใช้ id_user_in แทน $row->id
        ->pluck('id_user')
        ->toArray();

    $users_update = users::whereIn('id', $users_check_user)
        ->whereNotNull('type_netflix')
        ->pluck('name')
        ->toArray();

    // รวมชื่อที่ยังไม่มีใน profile
    foreach ($users_update as $name) {
        if (!in_array($name, $account[$email]['profile'])) {
            $account[$email]['profile'][] = $name;
        }
    }
}

dd($account);
            

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




}
