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
use App\Models\delete_pass;

use App\Models\api_log_clear;

use App\Models\created_history;

class AdminUserBackendController extends Controller
{

    public function im_user_netflix(Request $request)
    {
        try {

            $data = $request->input('data');

            if (!is_array($data)) {
                return response()->json(['error' => '📛 ข้อมูลไม่ถูกต้อง (ไม่ใช่ array)'], 400);
            }
    
            if (count($data) < 2) {
                return response()->json(['error' => '⚠️ ไฟล์ควรมีอย่างน้อย 1 แถวของข้อมูล'], 400);
            }
    
    
             // ✅ เอาจำนวน column จากหัวข้อ (row แรก)
             $header = $data[0];
             $expectedColumnCount =12;
    
             if (count($header) !== $expectedColumnCount) {
                return response()->json([
                    'error' => "❌ หัวตารางควรมี $expectedColumnCount ช่อง แต่พบ " . count($header) . " ช่อง"
                ], 400);
            }
    
        if (!is_array($data)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }
    
        foreach ($data as $row) {
            // ป้องกัน array ขนาดไม่ครบ
            $row = array_pad($row, 12, null);



            $exists = \App\Models\users::where('name', $row[0])->where('username', $row[1])
            ->where('password', $row[2])->where('type_netflix',1)->exists();
    
            if ($exists) {
                continue;
            }

    
            // แปลงวันที่
            if (!isset($row[9]) || trim($row[9]) === '') {
                $formattedDate_start = null;
            } else {
                $dateParts = explode('/', $row[9]); // ex: 17/04/2025
                $formattedDate_start = count($dateParts) === 3 ? "{$dateParts[2]}-{$dateParts[0]}-{$dateParts[1]}" : null;
            }

              // แปลงวันที่
              if (!isset($row[10]) || trim($row[10]) === '') {
                $formattedDate_end = null;
            } else {
                $datePartsa = explode('/', $row[10]); // ex: 17/04/2025
                $formattedDate_end = count($datePartsa) === 3 ? "{$datePartsa[2]}-{$datePartsa[0]}-{$datePartsa[1]}" : null;
            }

            if($formattedDate_start=='0000-00-00'){
                $formattedDate_start=null;
            }

            if($formattedDate_end=='0000-00-00'){
                $formattedDate_end=null;
            }

            if($row[7]=='ยกเว้นทีวี'){
                $type='MOBILE';
            }else{
                $type='PC';
            }

            $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$row[8])->first();
    

            $acc = \App\Models\users_in::whereNull('type_f')->where('email',$row[11])->first();
            if($acc!=null){
                $account=0;
            }else{
                $acc = \App\Models\users_in::whereNull('type_f')->where('email01',$row[11])->first();

                if($acc!=null){
                    $account=1;
                }else{
                    $acc = \App\Models\users_in::whereNull('type_f')->where('email02',$row[11])->first();

                    if($acc!=null){
                        $account=2;
                    }else{
                       $account=null;
                    }

                }
            }    

            
            if(@$acc!=null){
                $status=0;
            }else{
                $status=1;
            }

            if($row[1]==null){
                do {
                    // สุ่มเลขระหว่าง 000000 ถึง 999999
                    $randomNumber = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
                    $run = "NF{$randomNumber}";
                
                    // ตรวจสอบว่าเลขนี้มีอยู่ใน username หรือยัง
                    $exists = DB::table('tb_users')->where('username', $run)->exists();
                } while ($exists);

                $username=@$run;
            }else{
                $username=$row[1];
            }

            if($row[2]==null){
                $pass=rand(111111, 999999);
            }else{
                $pass=$row[2];
            }

            $user=\App\Models\users::create([
                'name'       => $row[0],
                'username'   => @$username,
                'password'   => @$pass,
                'phone'   => $row[3],
                'email'   => $row[4],
                'line'   => $row[5],
                'link_line'   => $row[6],
                'type'   => @$type,
                'package'   => $row[8],
                'id_package' => @$pack_id->id,
                'date_start'   => @$formattedDate_start,
                'date_end'   => @$formattedDate_end,
                'type_netflix'   => 1,
                'open'   => 0,
                'status_account'   => @$status,
            ]);



            if($account==0){
                $aaa=\App\Models\users_in_in::create([
                    'id_user'       => $user->id,
                    'id_user_in'   => @$acc->id,
                    'type'   => @$type,
                    'date_start'   => @$formattedDate_start,
                    'date_end'   => @$formattedDate_end,
                ]); 
                
                \App\Models\users_in_in_history::create([
                    'id_user'       => $user->id,
                    'id_user_in'   => @$account,
                    'type'   => @$type,
                    'date_start'   => @$formattedDate_start,
                    'date_end'   => @$formattedDate_end,
                    'id_user_in_in'   => @$aaa->id,
                ]); 
            }elseif($account==1){
                $aaa=\App\Models\users_in_in::create([
                    'id_user'       => $user->id,
                    'id_user_in'   => @$acc->id,
                    'type'   => @$type,
                    'date_start'   => @$formattedDate_start,
                    'date_end'   => @$formattedDate_end,
                    'type_mail'   => 1,
                ]); 
                
                \App\Models\users_in_in_history::create([
                    'id_user'       => $user->id,
                    'id_user_in'   => @$account,
                    'type'   => @$type,
                    'date_start'   => @$formattedDate_start,
                    'date_end'   => @$formattedDate_end,
                    'id_user_in_in'   => @$aaa->id,
                    'type_mail'   => 1,
                ]); 
            }elseif($account==2){
                $aaa=\App\Models\users_in_in::create([
                    'id_user'       => $user->id,
                    'id_user_in'   => @$acc->id,
                    'type'   => @$type,
                    'date_start'   => @$formattedDate_start,
                    'date_end'   => @$formattedDate_end,
                    'type_mail'   => 1,
                ]); 
                
                \App\Models\users_in_in_history::create([
                    'id_user'       => $user->id,
                    'id_user_in'   => @$account,
                    'type'   => @$type,
                    'date_start'   => @$formattedDate_start,
                    'date_end'   => @$formattedDate_end,
                    'id_user_in_in'   => @$aaa->id,
                    'type_mail'   => 1,
                ]); 
            }
        }
    
        return response()->json(['success' => true]);

        } catch (\Exception $e) {
            \Log::error('❌ ERROR: ' . $e->getMessage());
            return response()->json(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
        }
        
    }


    public function im_account_netflix(Request $request)
    {
        try{

        $data = $request->input('data');

        if (!is_array($data)) {
            return response()->json(['error' => '📛 ข้อมูลไม่ถูกต้อง (ไม่ใช่ array)'], 400);
        }

        if (count($data) < 2) {
            return response()->json(['error' => '⚠️ ไฟล์ควรมีอย่างน้อย 1 แถวของข้อมูล'], 400);
        }


         // ✅ เอาจำนวน column จากหัวข้อ (row แรก)
         $header = $data[0];
         $expectedColumnCount = 9;

         if (count($header) !== $expectedColumnCount) {
            return response()->json([
                'error' => "❌ หัวตารางควรมี $expectedColumnCount ช่อง แต่พบ " . count($header) . " ช่อง"
            ], 400);
        }
    
        foreach ($data as $row) {

            // ป้องกัน array ขนาดไม่ครบ
            $row = array_pad($row, 9, null);
    
            // แปลงวันที่
            if (!isset($row[3]) || trim($row[3]) === '') {
                $formattedDate = null;
            } else {
                $dateParts = explode('/', $row[3]); // ex: 17/04/2025
                $formattedDate = count($dateParts) === 3 ? "{$dateParts[2]}-{$dateParts[0]}-{$dateParts[1]}" : null;
            }

            if($formattedDate=='0000-00-00'){
                $formattedDate=null;
            }
    
            $name     = trim($row[0]);
            $email    = strtolower(trim($row[1]));
            $email01  = strtolower(trim($row[5] ?? ''));
            $email02  = strtolower(trim($row[7] ?? ''));
    
            $exists = \App\Models\users_in::where('name', $name)
                ->orWhere(function ($query) use ($email, $email01, $email02) {
                    $query->where('email', $email)
                          ->orWhere('email01', $email)
                          ->orWhere('email02', $email)
                          ->orWhere('email', $email01)
                          ->orWhere('email01', $email01)
                          ->orWhere('email02', $email01)
                          ->orWhere('email', $email02)
                          ->orWhere('email01', $email02)
                          ->orWhere('email02', $email02);
                })
                ->exists();
    
            if ($exists) {
                continue;
            }
    
            \App\Models\users_in::create([
                'name'       => $name,
                'email'      => $email,
                'password'   => $row[2],
                'date_end'   => $formattedDate,
                'date_ee'    => $row[4] ?? null,
                'email01'    => $email01,
                'password01' => $row[6] ?? null,
                'email02'    => $email02,
                'password02' => $row[8] ?? null,
                'type_f'     => null,
            ]);
        }
    
        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        \Log::error('❌ ERROR: ' . $e->getMessage());
        return response()->json(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
    }

    
    }

    public function otp_his(){
        $item=users::whereNotNull('otp_status_mail')->orderBy('otp_status_mail','desc')->get();
        $item2=users::whereNotNull('otp_status_phone')->orderBy('otp_status_phone','desc')->get();

        return view('backend.users_all.otp_his',[
            'item'=>$item,
            'item2'=>$item2,
            'page'=>"all",
            'list'=>"otp_his",
        ]);
    }

    public function api_log_clear(){
        $item=api_log_clear::orderBy('id','desc')->get();

        return view('backend.users_all.api_log_clear',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"api_log_clear",
        ]);
    }

    public function save_pass(Request $r){

        if($r->ttt=0){
            $item=delete_pass::first();
            if($item==null){
                $item=new delete_pass();
            }
            $item->text=$r->text;
            $item->save();
        }elseif($r->ttt=1){
            $item=delete_pass::first();
            if($item==null){
                $item=new delete_pass();
            }
            $item->title1=$r->title1;
            $item->title2=$r->title2;
            $item->save();
        }
       
        return redirect()->back()->with('message','Sucess!');
    }

    public function users_in_line($id){

        $all=users_in_in::where('id_user_in',$id)->pluck('id_user')->ToArray();
        $item=users::whereIn('id',$all)->pluck('link_line')->ToArray();

        return view('backend.users_in.users_in_line',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"users_in",
        ]);
    }


    public function y_users_in_line($id){

        $all=users_in_in::where('id_user_in',$id)->pluck('id_user')->ToArray();
        $item=users::whereIn('id',$all)->pluck('link_line')->ToArray();

        return view('backend.users_in_youtube.y_users_in_line',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"users_in_youtube",
        ]);
    }



    public function users_all_destroy($id){
        $fff=users::where('id',$id)->first();
        $item=users::whereNull('password')->where('username',$fff->username)->pluck('id')->toArray();


        $vv = users_in_in::whereIn('id_user',$item)->pluck('id')->toArray();

     
        $aaa = users_in_in_history::whereIn('id_user_in_in',$vv)->update(['status_check' => 1]);

        $de = users_in_in::whereIn('id_user',$item)->delete();

        $ggg=users::whereNull('password')->where('username',$fff->username)->delete();


        return redirect()->back()->with('message','Sucess!');
    }


    public function youtube_in_yay(Request $r){
        $id=$r->id;
        $id_user_in=$r->id_user_in;

        // $user = (new users_in())->getEligibleUser_youtube();
        $date = date('Y-m-d');
        $user = users_in::where('open',0)->where('id','!=',$id_user_in)->whereNotNull('type_f')->whereNull('t_house')->where(function ($query) use ($date) {
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

        if ($user !== null) {
            $save=users_in_in::where('id',$id)->first();
            $save->id_user_in=$user->id;
            $save->save();
        }    

        // if (@$id!=null) {
        //  $save=users_in_in::where('id',$id)->first();
        //     $save->id_user_in=$id_user_in;
        //     $save->save();
        // }

         

         if ($user !== null) {
         return redirect()->to('y_users_in_edit/'.$user->id)->with('success','Success.');
         }else{
            return redirect()->back()->with('success','ไม่มี Account ว่าง.');
         }
      
     }

     public function edit_time_netflix_send(Request $r){

        $date_start=$r->date_start;
        $date_end=$r->date_end;
        $id=$r->selected_ids;
       

        if (!empty($id)) {
         $item=users_in::whereNull('type_f')->whereIn('id',$id)->pluck('id')->ToArray();
         foreach($item as $items){
            $save=users_in::whereNull('type_f')->where('id',$items)->first();
            $save->date_start=$date_start;
            $save->date_end=$date_end;
            $save->save();
         }
        }

         return redirect()->back()->with('success','Success.');
      
     }



       public function edit_time_netflix(Request $r){

         $item=users_in::whereNull('type_f')->orderby('id','desc')->get();
         $search = $r->search;
         $status_account = $r->status_account;

         // ตรวจสอบว่า search เป็นวันที่ในรูปแบบ 14/03/2025 หรือไม่
           $date_new = null;
           if (!empty($search) && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $search)) {
               $date_parts = explode('/', $search);
               $date_new = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0]; // แปลงเป็น Y-m-d
           }

           if (!empty($search) or !empty($status_account)) {
               $item = users_in::whereNull('type_f')->where(function ($query) use ($search, $status_account, $date_new) {
                   // ถ้า search เป็นวันที่ ให้ใช้ date_new แทน search
                   if ($date_new !== null) {
                       $query->where('date_end',$date_new);
                   } else {
                       $query->where('name', 'LIKE', '%' . $search . '%')
                           ->orWhere('email', 'LIKE', '%' . $search . '%')
                           ->orWhere('country', 'LIKE', '%' . $search . '%');
                   }
               });

               if ($status_account == '0') {
                   $item = $item->where('date_end', '>=', $date);
               } elseif ($status_account == '1') {
                   $item = $item->where('date_end', '<', $date);
               } elseif ($status_account == '2') {
                   $item = $item->whereBetween('date_end', [$date, date('Y-m-d', strtotime('+3 days', strtotime($date)))]);
               }

               $item = $item->orderBy('id', 'desc')->get();
           }

         return view('backend.users_all.edit_time_netflix',[
             'item'=>$item,
             'page'=>"all",
             'list'=>"users_in",

             'search'=>$search,
             'status_account'=>$status_account,
         ]);
     }


     public function edit_time_youtube_send(Request $r){

        $date_start=$r->date_start;
        $time=$r->time;
        $id=$r->selected_ids;
       

        if (!empty($id)) {
            $item = users_in::whereNotNull('type_f')->whereIn('id', $id)->pluck('id')->toArray();
            foreach ($item as $items) {
                $save = users_in::whereNotNull('type_f')->where('id', $items)->first();
                $save->date_start = $date_start;
                $save->time = $time;
                $save->save();
            }
        }

        

         return redirect()->back()->with('success','Success.');
      
     }



     public function edit_time_youtube(Request $r){

         $item=users_in::whereNotNull('type_f')->orderby('id','desc')->get();
         $search = $r->search;
         $status_account = $r->status_account;

         // ตรวจสอบว่า search เป็นวันที่ในรูปแบบ 14/03/2025 หรือไม่
           $date_new = null;
           if (!empty($search) && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $search)) {
               $date_parts = explode('/', $search);
               $date_new = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0]; // แปลงเป็น Y-m-d
           }

           if (!empty($search) or !empty($status_account)) {
               $item = users_in::whereNotNull('type_f')->where(function ($query) use ($search, $status_account, $date_new) {
                   // ถ้า search เป็นวันที่ ให้ใช้ date_new แทน search
                   if ($date_new !== null) {
                       $query->where('date_end',$date_new);
                   } else {
                       $query->where('name', 'LIKE', '%' . $search . '%')
                           ->orWhere('email', 'LIKE', '%' . $search . '%')
                           ->orWhere('country', 'LIKE', '%' . $search . '%');
                   }
               });

               if ($status_account == '0') {
                   $item = $item->where('date_end', '>=', $date);
               } elseif ($status_account == '1') {
                   $item = $item->where('date_end', '<', $date);
               }
               elseif ($status_account == '11') {
                   $item = $item->whereNull('t_house');
               }elseif ($status_account == '22') {
                   $item = $item->where('t_house','บ้านบล็อก');
               }elseif ($status_account == '33') {
                   $item = $item->where('t_house','บ้านอุทธรณ์');
               }elseif ($status_account == '44') {
                   $item = $item->where('t_house','บ้านต่ออายุ');
               }

               $item = $item->orderBy('id', 'desc')->get();
           }

         return view('backend.users_all.edit_time_youtube',[
             'item'=>$item,
             'page'=>"all",
             'list'=>"users_in_youtube",

             'search'=>$search,
             'status_account'=>$status_account,
         ]);
     }

    
public function dashbord_all(Request $r){
  return view('backend.users_all.dashbord_all',[
    'page'=>"all",
    'list'=>"dashbord_all",
  ]);
}

    public function his_dash(Request $r){
    //    $item = log_dash::whereNull('type_f')->orderBy('id','desc')->get();

       $item = log_dash::whereHas('user_in_his', function ($query) {
        $query->whereHas('user_in', function ($subQuery) {
            $subQuery->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
        });
        })
        ->orderby('id','desc')
        ->get();

      return view('backend.users_all.his_dash',[
          'item'=>$item,
          'page'=>"all",
          'list'=>"dashbord",
      ]);
  }

  public function his_dash_y(Request $r){
    // $item = log_dash::whereNotNull('type_f')->orderBy('id','desc')->get();

    $item = log_dash::whereHas('user_in_his', function ($query) {
        $query->whereHas('user_in', function ($subQuery) {
            $subQuery->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
        });
    })
    ->orderby('id','desc')
    ->get();

   return view('backend.users_all.his_dash_y',[
       'item'=>$item,
       'page'=>"all",
       'list'=>"dashbord_y",
   ]);
}

public function dashbord_y(Request $r){
   $date=date('Y-m-d');
   $startDate = date('Y-m-d', strtotime('+4 days', strtotime($date))); // มากกว่า 3 วัน (เริ่มจากวันที่ 4)
   $endDate = date('Y-m-d', strtotime('+7 days', strtotime($date))); // ไม่เกิน 7 วัน

   $ddd = users_in_in::pluck('id')->ToArray();

   $item = users_in_in_history::whereNotIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->groupBy('id_user_in')
   ->orderBy('id_user_in','asc')->get();

   $nub = users_in_in_history::whereNotIn('id_user_in_in',$ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->orderBy('id_user_in','asc')
   ->count();


   $itemb = users_in_in_history::whereIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->whereDate('date_end',date('Y-m-d', strtotime('+3 days', strtotime($date))))
   ->groupBy('id_user_in')
   ->orderBy('id_user_in', 'asc')
   ->get();

   $nubb = users_in_in_history::whereIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->whereDate('date_end',date('Y-m-d', strtotime('+3 days', strtotime($date))))
//    ->groupBy('id_user_in')
   ->orderBy('id_user_in', 'asc')
   ->count();

   $itemc = users_in_in_history::whereIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->whereDate('date_end',date('Y-m-d', strtotime('+2 days', strtotime($date))))
   ->groupBy('id_user_in')
   ->orderBy('id_user_in', 'asc')
   ->get();

   $nubc = users_in_in_history::whereIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->whereDate('date_end',date('Y-m-d', strtotime('+2 days', strtotime($date))))
//    ->groupBy('id_user_in')
   ->orderBy('id_user_in', 'asc')
   ->count();

   $itemd = users_in_in_history::whereIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->whereDate('date_end',date('Y-m-d', strtotime('+1 days', strtotime($date))))
   ->groupBy('id_user_in')
   ->orderBy('id_user_in', 'asc')
   ->get();

   $nubd = users_in_in_history::whereIn('id_user_in_in', $ddd)
   ->whereNull('status_check')
   ->whereHas('user_in', function ($query) {
       $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
       })
   ->whereDate('date_end',date('Y-m-d', strtotime('+1 days', strtotime($date))))
//    ->groupBy('id_user_in')
   ->orderBy('id_user_in', 'asc')
   ->count();

   // $itemc = users_in_in_history::whereIn('id_user_in_in', $ddd)
   //     ->whereNull('status_check')
   //     ->whereBetween('date_end', [$startDate, $endDate]) // เฉพาะ date_end ที่อยู่ในช่วงนี้
   //     ->groupBy('id_user_in')
   //     ->orderBy('id_user_in', 'asc')
   //     ->get();

   //     $nubc = users_in_in_history::whereIn('id_user_in_in', $ddd)
   //     ->whereNull('status_check')
   //     ->whereBetween('date_end', [$startDate, $endDate]) // เฉพาะ date_end ที่อยู่ในช่วงนี้
   //     ->groupBy('id_user_in')
   //     ->orderBy('id_user_in', 'asc')
   //     ->count();


//    $acc = users_in::whereNotNull('type_f')
//    ->whereBetween('date_end', [$date, date('Y-m-d', strtotime('+1 days', strtotime($date)))])
//    ->count();

$acc_a = users_in::whereNotNull('type_f')
->where('t_house','บ้านบล็อก')
->count();
$acc_b = users_in::whereNotNull('type_f')
->where('t_house','บ้านอุทธรณ์')
->count();
$acc_c = users_in::whereNotNull('type_f')
->where('t_house','บ้านต่ออายุ')
->count();

$acc = users_in::whereNotNull('type_f')
->whereNull('t_house')
->count();

  return view('backend.users_all.dashbord_y',[
    'item'=>$item,
    'itemb'=>$itemb,
    'itemc'=>$itemc,
    'itemd'=>$itemd,
    'nub'=>$nub,
    'nubb'=>$nubb,
    'nubc'=>$nubc,
    'nubd'=>$nubd,

    'acc'=>$acc,
    'acc_a'=>$acc_a,
    'acc_b'=>$acc_b,
    'acc_c'=>$acc_c,

      'page'=>"all",
      'list'=>"dashbord_y",
  ]);
}


    public function dashbord(Request $r){
        $date=date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('+4 days', strtotime($date))); // มากกว่า 3 วัน (เริ่มจากวันที่ 4)
        $endDate = date('Y-m-d', strtotime('+7 days', strtotime($date))); // ไม่เกิน 7 วัน

        $ddd = users_in_in::pluck('id')->ToArray();

        $item = users_in_in_history::whereNotIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->groupBy('id_user_in')
        ->orderBy('id_user_in','asc')->get();

        $nub = users_in_in_history::whereNotIn('id_user_in_in',$ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->orderBy('id_user_in','asc')
        ->count();


        $itemb = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+3 days', strtotime($date))))
        ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->get();

        $nubb = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+3 days', strtotime($date))))
        // ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->count();

        $itemc = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+2 days', strtotime($date))))
        ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->get();
        

        $nubc = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+2 days', strtotime($date))))
        // ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->count();


        $itemd = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+1 days', strtotime($date))))
        ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->get();

        $nubd = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->whereHas('user_in', function ($query) {
            $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+1 days', strtotime($date))))
        // ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->count();

        // $itemc = users_in_in_history::whereIn('id_user_in_in', $ddd)
        //     ->whereNull('status_check')
        //     ->whereBetween('date_end', [$startDate, $endDate]) // เฉพาะ date_end ที่อยู่ในช่วงนี้
        //     ->groupBy('id_user_in')
        //     ->orderBy('id_user_in', 'asc')
        //     ->get();

        //     $nubc = users_in_in_history::whereIn('id_user_in_in', $ddd)
        //     ->whereNull('status_check')
        //     ->whereBetween('date_end', [$startDate, $endDate]) // เฉพาะ date_end ที่อยู่ในช่วงนี้
        //     ->groupBy('id_user_in')
        //     ->orderBy('id_user_in', 'asc')
        //     ->count();


        $acc = users_in::where('open',0)->whereNull('type_f')
        ->whereBetween('date_end', [$date, date('Y-m-d', strtotime('+1 days', strtotime($date)))])
        ->count();

        $accs = users_in::where('open',0)->whereNull('type_f')
        ->whereBetween('date_end', [$date, date('Y-m-d', strtotime('+1 days', strtotime($date)))])
        ->get();

       return view('backend.users_all.dashbord',[
           'item'=>$item,
           'itemb'=>$itemb,
           'itemc'=>$itemc,
           'itemd'=>$itemd,
           'nub'=>$nub,
           'nubb'=>$nubb,
           'nubc'=>$nubc,
           'nubd'=>$nubd,

           'acc'=>$acc,
           'accs'=>$accs,

           'page'=>"all",
           'list'=>"dashbord",
       ]);
   }

   
   public function day_his($item,$id){
    $sss = users_in_in_history::where('id',$id)->first();
    $id=$sss->id_user_in;

    $date=date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('+4 days', strtotime($date))); // มากกว่า 3 วัน (เริ่มจากวันที่ 4)
    $endDate = date('Y-m-d', strtotime('+7 days', strtotime($date))); // ไม่เกิน 7 วัน
 
    $ddd = users_in_in::pluck('id')->ToArray();
 
    if(@$item==0){
    $detail='แบบหมดอายุ';
    $item = users_in_in_history::whereNotIn('id_user_in_in', $ddd)
    ->whereNull('status_check')
    ->where('id_user_in',$id)
    ->whereHas('user_in', function ($query) {
        $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
        })
    ->groupBy('id_user_in')
    ->orderBy('id_user_in','asc')->update(['status_check' => 1]);
    }
 
 
    if(@$item==3){
    $detail='แบบ3วัน';
    $itemb = users_in_in_history::whereIn('id_user_in_in', $ddd)
    ->whereNull('status_check')
    ->where('id_user_in',$id)
    ->whereHas('user_in', function ($query) {
        $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
        })
    ->whereDate('date_end',date('Y-m-d', strtotime('+3 days', strtotime($date))))
    ->groupBy('id_user_in')
    ->orderBy('id_user_in', 'asc')
    ->update(['status_check' => 1]);
    }
 

    if(@$item==2){
    $detail='แบบ2วัน';
    $itemc = users_in_in_history::whereIn('id_user_in_in', $ddd)
    ->whereNull('status_check')
    ->where('id_user_in',$id)
    ->whereHas('user_in', function ($query) {
        $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
        })
    ->whereDate('date_end',date('Y-m-d', strtotime('+2 days', strtotime($date))))
    ->groupBy('id_user_in')
    ->orderBy('id_user_in', 'asc')
    ->update(['status_check' => 1]);
    }
 

    if(@$item==1){
    $detail='แบบ1วัน';
    $itemd = users_in_in_history::whereIn('id_user_in_in', $ddd)
    ->whereNull('status_check')
    ->where('id_user_in',$id)
    ->whereHas('user_in', function ($query) {
        $query->whereNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
        })
    ->whereDate('date_end',date('Y-m-d', strtotime('+1 days', strtotime($date))))
    ->groupBy('id_user_in')
    ->orderBy('id_user_in', 'asc')
    ->update(['status_check' => 1]);
    }

    $aaa_his = new log_dash();
    $aaa_his->id_user = Auth::guard('admin')->user()->id;
    $aaa_his->id_in_in_history = $sss->id;
    $aaa_his->detail =$detail;
    $aaa_his->save();

    return redirect()->back()->with('message','Sucess!');
    }




    public function day_his_y($item,$id){
        $sss = users_in_in_history::where('id',$id)->first();
        $id=$sss->id_user_in;
    
        $date=date('Y-m-d');
        $startDate = date('Y-m-d', strtotime('+4 days', strtotime($date))); // มากกว่า 3 วัน (เริ่มจากวันที่ 4)
        $endDate = date('Y-m-d', strtotime('+7 days', strtotime($date))); // ไม่เกิน 7 วัน
     
        $ddd = users_in_in::pluck('id')->ToArray();
     
        if(@$item==0){
        $detail='แบบหมดอายุ';
        $item = users_in_in_history::whereNotIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->where('id_user_in',$id)
        ->whereHas('user_in', function ($query) {
            $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->groupBy('id_user_in')
        ->orderBy('id_user_in','asc')->update(['status_check' => 1]);
        }
     
     
        if(@$item==3){
        $detail='แบบ3วัน';
        $itemb = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->where('id_user_in',$id)
        ->whereHas('user_in', function ($query) {
            $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+3 days', strtotime($date))))
        ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->update(['status_check' => 1]);
        }
     
    
        if(@$item==2){
        $detail='แบบ2วัน';
        $itemc = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->where('id_user_in',$id)
        ->whereHas('user_in', function ($query) {
            $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+2 days', strtotime($date))))
        ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->update(['status_check' => 1]);
        }
     
    
        if(@$item==1){
        $detail='แบบ1วัน';
        $itemd = users_in_in_history::whereIn('id_user_in_in', $ddd)
        ->whereNull('status_check')
        ->where('id_user_in',$id)
        ->whereHas('user_in', function ($query) {
            $query->whereNotNull('type_f'); // กรองเฉพาะ type_f ที่ไม่เป็น NULL
            })
        ->whereDate('date_end',date('Y-m-d', strtotime('+1 days', strtotime($date))))
        ->groupBy('id_user_in')
        ->orderBy('id_user_in', 'asc')
        ->update(['status_check' => 1]);
        }
    
        $aaa_his = new log_dash();
        $aaa_his->id_user = Auth::guard('admin')->user()->id;
        $aaa_his->id_in_in_history = $sss->id;
        $aaa_his->detail =$detail;
        $aaa_his->save();
    
        return redirect()->back()->with('message','Sucess!');
        }

   

    public function change_user($id){
        $item=users_in_in::where('id_user_in',$id)->get();
        foreach($item as $items){
            $userData=users::where('id',$items->id_user)->first();
            $aaa=users_in_in::where('id',$items->id)->first();

            $aaaaaa = users_in_in_history::where('id_user_in_in',@$items->id)->update(['status_check' => 1]);

            if($userData['type']=='MOBILE'){
                $user = (new users_in())->getEligibleUser();

                if(@$userData['username']!=null and @$userData['password']!=null ){
                if ($user !== null) {
                    $aaa->id_user = @$userData->id;
                    $aaa->id_user_in = $user->id;
                    $aaa->type = 'MOBILE';

                    $aaa->date_start=$user->date_start; 
                    $aaa->date_end=$user->date_end;
                    $aaa->save();
    
                    $aaa_his = new users_in_in_history();
                    $aaa_his->id_user = @$userData->id;
                    $aaa_his->id_user_in = $user->id;
                    $aaa_his->type = 'MOBILE';
                    $aaa_his->id_user_in_in = $aaa->id;

                    $aaa_his->date_start=$user->date_start; 
                    $aaa_his->date_end=$user->date_end;
                    $aaa_his->save();

                    $acc=$user->id;

                }
                }

                } else {
                $user = (new users_in())->getEligibleUser_pc();

                if(@$userData['username']!=null and @$userData['password']!=null ){
                if ($user !== null) {
                // นับจำนวน users_in_in ที่มีอยู่แล้ว
                $countExisting = users_in_in::where('id_user_in', $user->id)->count();

                // คำนวณค่า type_mail (1 หรือ 2)
                $newTypeMail = ($countExisting % 2) + 1;

                    $aaa->id_user = @$userData->id;
                    $aaa->id_user_in = $user->id;
                    $aaa->type = 'PC';
                    $aaa->type_mail = $newTypeMail;
                    $aaa->date_start=$user->date_start; 
                    $aaa->date_end=$user->date_end;
                    $aaa->save();
    
                    $aaa_his = new users_in_in_history();
                    $aaa_his->id_user = @$userData->id;
                    $aaa_his->id_user_in = $user->id;
                    $aaa_his->type = 'PC';
                    $aaa_his->id_user_in_in = $aaa->id;
                    $aaa_his->type_mail = $newTypeMail;
                    $aaa_his->date_start=$user->date_start; 
                    $aaa_his->date_end=$user->date_end;
                    $aaa_his->save();

                    $acc=$user->id;

                }
                }
                }

        }
        return redirect()->back()->with('message','Sucess!');
    }


     ///login---------------
   public function login(){
    return view('auth.login');
    }

 ///LOGOUT---------------
    public function logout(){
        // Auth::logout();
        Auth::guard('admin')->logout();
        return redirect()->to('/login')->with('message','Sucess!');
    }

     ///register---------------
   public function register(){
    abort(404);
    exit; // หยุดการทำงานที่เหลือ
        return view('auth.register');
    }

     ///verify---------------
    public function verify(){
        abort(404);
        exit; // หยุดการทำงานที่เหลือ
        return view('auth.verify');
    }



 ///Backend Login---------------
    public function login_backend(Request $r)
    {
        $admin=admin::where('email',$r->email)->first();
        if($admin){
        if(Hash::check($r->password, $admin->password)){
            if($admin->open==0){
                Auth::guard('admin')->login($admin);
                return redirect("/backend");
            }else{
                return redirect()->to('/login')->with('message','You User Are Close!');
            }
        }else{
            return redirect()->to('/login')->with('message','Password Wrong!');
        }
        }else{
            return redirect()->to('/login')->with('message','Email Wrong!');
        }
    }


     ///login---------------
   public function his_created(){
    $item = created_history::selectRaw('MAX(id) as id, number, MAX(created_at) as created_at, MAX(id_admin) as id_admin')
    ->groupBy('number')  // กรุ๊ปข้อมูลตาม number
    ->orderBy('id', 'desc')
    ->with('netflix') // โหลดความสัมพันธ์ youtube มาด้วย
    ->whereHas('netflix')
    ->paginate(10);
   return view('backend.users.his_created',[
    'item'=>$item,
    'page'=>"all",
    'list'=>"users",
   ]);
   }



     // OPEN/CLOSE-------admin
     public function admin_open_close(Request $r)
     {
         $item = admin::where('id', $r->id)->first();
     
         if($item!=null){
         if (@$item->open==0) {
             $item->open = 1;
             $item->save();
         }else{
            $item->open = 0;
            $item->save();
         }
     
             return response()->json(['success' => true, 'open' => $item->open]);
         }
     
         return response()->json(['success' => false]);
     }


      //country//
      public function country(){
        $item=country ::orderby('id','desc')->cursor();
        return view('backend.country.index',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"country",
        ]);
    }
    public function country_store(Request $r){
        $item=new country();
        $item->title=$r->title;
        $item->save();
        return redirect()->to('country')->with('message','Sucess!');

    }
    public function country_update(Request $r,$id){
        $item=country::where('id',$id)->first();
        $item->title=$r->title;
        $item->save();
        return redirect()->to('country_edit/'.$id)->with('message','Sucess!');
    }
    public function country_edit($id){
        $item=country::where('id',$id)->first();
        return view('backend.country.edit',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"country",
        ]);
    }
    public function country_destroy($id){
        $item=country::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('message','Sucess!');
    }
    public function country_add(){
        return view('backend.country.add',[
            'page'=>"all",
            'list'=>"country",
        ]);
    }
    //country//



     //admin//
     public function admin(){
        $item=admin ::orderby('id','desc')->cursor();
        return view('backend.admin.index',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"admin",
        ]);
    }
    public function admin_store(Request $r){
        if(Auth::guard('admin')->user()->type != 0){
            return redirect()->to('/backend')->with('message','You NOT Super Admin!');
        }
        $item=new admin();
        $ch=admin::where('email',$r->email)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
            }

        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=$r->type;
        $item->name=$r->name;
        $item->email=$r->email;

            if($r->picture!=null){
                $uploadedFile=$r->picture;
                $fileName = $uploadedFile->getClientOriginalName();
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
                if (in_array($fileExtension, $allowedExtensions)) {
                $path =public_path().'/img/upload/'.$item->picture;
                if(File::exists($path)){
                File::delete($path);
                }
                $picture = $_FILES['picture']['name'];
                $picture = date('YmdHis').'_'.$picture;
                $r->picture->move(public_path() . '/img/upload', $picture);
                $item->picture = $picture;
                }
                }

        $item->save();
        return redirect()->to('admin')->with('message','Sucess!');

    }
    public function admin_update(Request $r,$id){
        if(Auth::guard('admin')->user()->type != 0){
            return redirect()->to('/backend')->with('message','You NOT Super Admin!');
        }
        $item=admin::where('id',$id)->first();
        $ch=admin::where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
            }

        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=$r->type;
        $item->name=$r->name;
        $item->email=$r->email;

        if($r->picture!=null){
            $uploadedFile=$r->picture;
            $fileName = $uploadedFile->getClientOriginalName();
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
            if (in_array($fileExtension, $allowedExtensions)) {
            $path =public_path().'/img/upload/'.$item->picture;
            if(File::exists($path)){
            File::delete($path);
            }
            $picture = $_FILES['picture']['name'];
            $picture = date('YmdHis').'_'.$picture;
            $r->picture->move(public_path() . '/img/upload', $picture);
            $item->picture = $picture;
            }
            }

        $item->save();
        return redirect()->to('admin_edit/'.$id)->with('message','Sucess!');
    }
    public function admin_edit($id){
        $item=admin::where('id',$id)->first();
        return view('backend.admin.edit',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"admin",
        ]);
    }
    public function admin_destroy($id){
        $item=admin::where('id',$id)->first();
        // $path =public_path().'/img/upload/'.$item->picture;
        // if(File::exists($path)){
        // File::delete($path);
        // }
        $item->delete();
        return redirect()->back()->with('message','Sucess!');
    }
    public function admin_add(){
        return view('backend.admin.add',[
            'page'=>"all",
            'list'=>"admin",
        ]);
    }
    //admin//



    public function users_status_edit($id){
        $item=users::where('id',$id)->first();
        $item->status_edit=null;
        $item->save();

        return redirect()->to('users');
     }




     // OPEN/CLOSE-------users
     public function users_open_close(Request $r)
     {
         $item = users::where('id', $r->id)->first();
     
         if($item!=null){
         if (@$item->open==0) {
             $item->open = 1;
             $item->save();
         }else{
            $item->open = 0;
            $item->save();
         }
     
             return response()->json(['success' => true, 'open' => $item->open]);
         }
     
         return response()->json(['success' => false]);
     }


     public function alert(Request $r){
        $item=alert::orderBy('created_at','desc')->get();
        return view('backend.users_all.alert',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"alert",
        ]);
     }


     //User//
     public function updateStatusOnExit(Request $r){
        $item=users::where('id',$r->userId)->first();
        $item->status_edit=null;
        $item->save();
     }

     public function users_all(Request $r){
       


       $item=users ::orderByRaw(
           '(SELECT id_user_in FROM tb_users_in_in WHERE tb_users_in_in.id_user = tb_users.id ORDER BY id_user_in DESC LIMIT 1) DESC'
       )->groupBy('username')->paginate(20);

       $search = $r->search;
       
       if (!empty($search)) {
           $item = users::where(function ($query) use ($search) {
               $query->where('name', 'LIKE', '%' . $search . '%')
                     ->orWhere('username', 'LIKE', '%' . $search . '%')
                     ->orWhere('phone', 'LIKE', '%' . $search . '%')
                     ->orWhere('line', 'LIKE', '%' . $search . '%')
                     ->orWhereHas('userIn', function($query) use ($search) {
                         $query->where('tb_users_in.name', 'LIKE', '%' . $search . '%'); // ระบุชื่อคอลัมน์จากตาราง tb_users_in
                     });
           });
       
           $item = $item->orderByRaw(
               '(SELECT id_user_in FROM tb_users_in_in WHERE tb_users_in_in.id_user = tb_users.id ORDER BY id_user_in DESC LIMIT 1) DESC'
           )->groupBy('username')->paginate(20);
       }

       return view('backend.users_all.index',[
           'item'=>$item,
           'page'=>"all",
           'list'=>"users_all",

           'search'=>$search,
       ]);
   }
     
     public function users(Request $r){
       

        $item=users ::whereNotNull('type_netflix')->orderByRaw(
            '(SELECT id_user_in FROM tb_users_in_in WHERE tb_users_in_in.id_user = tb_users.id ORDER BY id_user_in DESC LIMIT 1) DESC'
        )->groupBy('username')->paginate(20);

        $search = $r->search;
        $status_account = $r->status_account;
        $status_user = $r->status_user;

           // ตรวจสอบว่า search เป็นวันที่ในรูปแบบ 14/03/2025 หรือไม่
           $date_new = null;
           if (!empty($search) && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $search)) {
               $date_parts = explode('/', $search);
               $date_new = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0]; // แปลงเป็น Y-m-d
           }
        
        if (!empty($search) or ($status_account !== null)) {
            $item = users::whereNotNull('type_netflix')->where(function ($query) use ($search, $status_account,$date_new) {
                if ($date_new !== null) {
                    $query->where('date_end',$date_new);
                } else {
                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('username', 'LIKE', '%' . $search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search . '%')
                      ->orWhere('line', 'LIKE', '%' . $search . '%')
                      ->orWhereHas('userIn', function($query) use ($search) {
                          $query->where('tb_users_in.name', 'LIKE', '%' . $search . '%'); // ระบุชื่อคอลัมน์จากตาราง tb_users_in
                      });
                }
            });
        
            if ($status_account == '999' and $status_account !== null) {
                // ไม่มีการกรอง
            } else {
                $item = $item->where('status_account', $status_account);
            }

            if ($status_user == 2) {
                $item = $item->whereNull('password');
            }

            if ($status_user == 3) {
                $item = $item->whereNotNull('password');
            }
        
            $item = $item->orderByRaw(
                '(SELECT id_user_in FROM tb_users_in_in WHERE tb_users_in_in.id_user = tb_users.id ORDER BY id_user_in DESC LIMIT 1) DESC'
            )->groupBy('username')->paginate(20);
        }

        return view('backend.users.index',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"users",

            'search'=>$search,
            'status_account'=>$status_account,
            'status_user'=>$status_user,
        ]);
    }
    public function users_store(Request $r){
        $xxz=null;
        $acc=null;
        $item=new users();
        $ca=users::whereNotNull('type_netflix')->whereNotNull('email')->where('email',$r->email)->orderby('id','desc')->first();

        if($ca!=null){
                return redirect()->back()->with('message','Email Already Have in Data!');
            }

        // if($r->password!=null){
        //     $item->password=Hash::make($r->password);
        // }
        $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$r->package)->first();
        $item->id_package=@$pack_id->id;

        $item->password=$r->password;

        $item->username=$r->username;
        $item->name=$r->name;
        $item->email=$r->email;
        $item->link_line=$r->link_line;
        $item->line=$r->line;
        $item->phone=$r->phone;
        $item->code=$r->code;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->type=$r->type;
        $item->package=$r->package;
        $item->type_netflix=1;

        // $caa=users::where('username',$r->username)->orderby('id','desc')->first();
        // if($caa!=null){
        //     return redirect()->back()->with('message','Username Already Have in Data!');
        // }
        
        if($item->save()){

        if($r->type=='MOBILE'){
        $user = (new users_in())->getEligibleUser();

        if($r->username!=null and $r->password!=null){
        if (@$user!=null) {
            $aaa=new users_in_in();
            $aaa->id_user=$item->id;  
            $aaa->id_user_in=$user->id;    
            $aaa->type='MOBILE';

            $aaa->date_start=$r->date_start; 
            $aaa->date_end=$r->date_end; 
            $aaa->save();

            $aaa_his=new users_in_in_history();
            $aaa_his->id_user=$item->id;  
            $aaa_his->id_user_in=$user->id;    
            $aaa_his->type='MOBILE';
            $aaa_his->id_user_in_in = $aaa->id;

            $aaa_his->date_start=$r->date_start; 
            $aaa_his->date_end=$r->date_end;
            $aaa_his->save();

            $acc=$user->id;

        }else{
            $item->status_account=1;
            $item->save();
            $xxz=1;
            // return redirect()->to('users')->with('message','สร้างสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
        }
        }else{
            $item->status_account=1;
            $item->save();
        }

        }else{
            $user = (new users_in())->getEligibleUser_pc();

        if($r->username!=null and $r->password!=null){
        if ($user !== null) {
            // นับจำนวน users_in_in ที่มีอยู่แล้ว
            $countExisting = users_in_in::where('id_user_in', $user->id)->count();

            // คำนวณค่า type_mail (1 หรือ 2)
            $newTypeMail = ($countExisting % 2) + 1;

            $aaa = new users_in_in();
            $aaa->id_user = $item->id;  
            $aaa->id_user_in = $user->id;    
            $aaa->type = 'PC';
            $aaa->type_mail = $newTypeMail;
            $aaa->date_start = $r->date_start; 
            $aaa->date_end = $r->date_end; 
            $aaa->save();

            // บันทึกลงประวัติ
            $aaa_his = new users_in_in_history();
            $aaa_his->id_user = $item->id;  
            $aaa_his->id_user_in = $user->id;    
            $aaa_his->type = 'PC';
            $aaa_his->id_user_in_in = $aaa->id;
            $aaa_his->type_mail = $newTypeMail;
            $aaa_his->date_start = $r->date_start; 
            $aaa_his->date_end = $r->date_end;
            $aaa_his->save();

            $acc=$user->id;

        } else {
            $item->status_account = 1;
            $item->save();
            $xxz=1;
            // return redirect()->to('users')->with('message', 'สร้างสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Manual');
        }
        }else{
            $item->status_account=1;
            $item->save();
        }

        }

        }

        if($acc!=null){
            $gg=users_in::where('id',$acc)->first();
            $acc=@$gg->name;

            if($aaa->type_mail!=null){
                if($aaa->type_mail==1){
                    $email=@$gg->email01;
                    $pa=@$gg->password01;
                }else{
                    $email=@$gg->email02;
                    $pa=@$gg->password02;
                }
            }else{
                $email=@$gg->email;
                $pa=@$gg->password;
            }
            @$acc_id=$gg->id;
        }else{
            if($r->username!=null and $r->password!=null){
            $acc='Account เต็ม';
            }else{
            $acc='ตัวแทน';
            }
        }

        if($r->type=='PC'){
            $e_type='TV';
        }else{
            $e_type='ยกเว้นทีวี';
        }

        $randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $his=new created_history();
        $his->id_admin=Auth::guard('admin')->user()->id;
        $his->id_user=$item->id;
        $his->id_user_in=@$acc_id;
        $his->id_user_in_in=@$aaa->id;
        $his->number=$randomNumber;
        $his->detail = 'สร้าง&nbsp;&nbsp;&nbsp;Account: '.$acc.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile: '.$item->name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Package: '.@$e_type.' '.$item->package.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: '.@$email.'&nbsp;&nbsp;Password: '.@$pa;

        $his->save();


        $dash_regis_to=new dash_regis_to();
        $dash_regis_to->id_user=$item->id; 
        $dash_regis_to->id_package=$item->id_package; 
        $dash_regis_to->id_admin=Auth::guard('admin')->user()->id;
        $dash_regis_to->date=date('Y-m-d');
        $dash_regis_to->type=0;
        $dash_regis_to->save();


        if(@$xxz!=null){
            return redirect()->back()->with('message','ต่ออายุสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
        }else{
            return redirect()->to('users')->with('message','Sucess!');
        }

    }
    public function users_update(Request $r,$id){
        $item=users::where('id',$id)->first();
        $ca=users::whereNotNull('type_netflix')->whereNotNull('email')->where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();
        if($ca!=null){
                return redirect()->back()->with('message','Email Already Have in Data!');
            }

        // if($r->password!=null){
        //     $item->password=Hash::make($r->password);
        // }

        $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$r->package)->first();
        $item->id_package=@$pack_id->id;

        $item->password=$r->password;

        $item->username=$r->username;
        $item->name=$r->name;
        $item->email=$r->email;
        $item->line=$r->line;
        $item->link_line=$r->link_line;
        $item->phone=$r->phone;
        $item->code=$r->code;
        // $item->date_start=$r->date_start;
        // $item->date_end=$r->date_end;
        $item->type=$r->type;
        $item->package=$r->package;

        // $caa=users::where('id','!=',$id)->where('username',$r->username)->orderby('id','desc')->first();
        // if($caa!=null){
        //     return redirect()->back()->with('message','Username Already Have in Data!');
        // }
        $item->save();
        return redirect()->back()->with('message','Sucess!');
    }

    public function users_update_date(Request $r){
        $xxz=null;
        $item=users::where('id',$r->id)->first();
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->type=$r->type;
        $item->package=$r->package;

        $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$r->package)->first();
        $item->id_package=@$pack_id->id;

        if($item->save()){

            if($item->type=='MOBILE'){


                $aaa=users_in_in::where('id_user',@$r->id)->first();
                if(@$aaa==null){
                    $user = (new users_in())->getEligibleUser();
                }else{
                    $user = users_in::where('id', @$aaa->id_user_in)->first();
                }

            // $user = (new users_in())->getEligibleUser();
            // $aaa=users_in_in::where('id_user',@$r->id)->first();
    
            if($item->username!=null and $item->password!=null){
            if (@$user!=null) {
                $aaa=users_in_in::where('id_user',@$r->id)->first();

                if(@$aaa==null){
                    $aaa_his=new users_in_in_history();
                    $aaa_his->id_user=$item->id;  
                    $aaa_his->id_user_in=$user->id;    
                }else{
                    $aaa_his=users_in_in_history::where('id_user_in_in',@$aaa->id)->first();
                }   

                if(@$aaa==null){
                    $aaa=new users_in_in();
                    $aaa->id_user=$item->id;  
                    $aaa->id_user_in=$user->id;
                }
                $aaa->type='MOBILE';
                $aaa->date_start=$r->date_start;
                $aaa->date_end=$r->date_end;
                $aaa->save();
    
                
                $aaa_his->type='MOBILE';
                $aaa_his->id_user_in_in = $aaa->id;

                $aaa_his->date_start=$r->date_start;
                $aaa_his->date_end=$r->date_end;
                $aaa_his->save();

                $item->status_account=0;
                $item->save();
    
            }else{
                $item->status_account=1;
                $item->save();
                $xxz=1;
                // return redirect()->back()->with('message','ต่ออายุสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
            }
            }else{
            $item->status_account=1;
            $item->save();
            }

            }else{

                $aaa=users_in_in::where('id_user',@$r->id)->first();
                if(@$aaa==null){
                    $user = (new users_in())->getEligibleUser_pc();
                }else{
                    $user = users_in::where('id', @$aaa->id_user_in)->first();
                }

                // $user = (new users_in())->getEligibleUser_pc();
                // $aaa=users_in_in::where('id_user',@$r->id)->first();
                
    
            if($item->username!=null and $item->password!=null){
            if (@$user!=null) {

            // นับจำนวน users_in_in ที่มีอยู่แล้ว
            $countExisting = users_in_in::where('id_user_in', $user->id)->count();

            // คำนวณค่า type_mail (1 หรือ 2)
            $newTypeMail = ($countExisting % 2) + 1;

            $aaa=users_in_in::where('id_user',@$r->id)->first();

            if(@$aaa==null){
                $aaa_his=new users_in_in_history();
                $aaa_his->id_user=$item->id;  
                $aaa_his->id_user_in=$user->id;    
            }else{
                $aaa_his=users_in_in_history::where('id_user_in_in',@$aaa->id)->first();
            }   

                if(@$aaa==null){
                    $aaa=new users_in_in();
                    $aaa->id_user=$item->id;  
                    $aaa->id_user_in=$user->id;
                }
                $aaa->type='PC';
                $aaa->type_mail = $newTypeMail;
                $aaa->date_start=$r->date_start; 
                $aaa->date_end=$r->date_end;
                $aaa->save();
       
                $aaa_his->type='PC';
                $aaa_his->id_user_in_in = $aaa->id;
                $aaa_his->type_mail = $newTypeMail;
                $aaa_his->date_start=$r->date_start; 
                $aaa_his->date_end=$r->date_end;
                $aaa_his->save();

                $item->status_account=0;
                $item->save();
    
            }else{
                $item->status_account=1;
                $item->save();
                $xxz=1;
                // return redirect()->back()->with('message','ต่ออายุสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
            }
            }else{
                $item->status_account=1;
                $item->save();
            }

            }
    
            }



            $dash_regis_to=new dash_regis_to();
        $dash_regis_to->id_user=$item->id; 
        $dash_regis_to->id_package=$item->id_package; 
        $dash_regis_to->id_admin=Auth::guard('admin')->user()->id;
        $dash_regis_to->date=date('Y-m-d');
        $dash_regis_to->type=1;
        $dash_regis_to->save();


        if(@$xxz!=null){
            return redirect()->back()->with('message','ต่ออายุสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
        }else{
            return redirect()->back()->with('message','Sucess!');
        }
    }

    public function users_edit($id){
        $item=users::where('id',$id)->first();
        $item->status_edit=Auth::guard('admin')->user()->id;
        $item->save();

        return view('backend.users.edit',[
            'item'=>$item,
            'page'=>"all",
            'list'=>"users",
        ]);
    }

    public function users_edit_status_check_admin($id){
        $item=created_history::where('id',$id)->first();
        $item->status=1;
        $item->save();

        return redirect()->back()->with('message','Sucess!');
    }

    public function users_edit_status_check_admin_all($id){
        $item = created_history::where('number', $id)->update(['status' => 1]);

        return redirect()->back()->with('message','Sucess!');
    }

    public function users_destroy($id){
        $item=users::where('id',$id)->first();
        $item->delete();
        $vv = users_in_in::where('id_user',$id)->pluck('id')->toArray();

        $de = users_in_in::where('id_user', $id)->delete();

        

        $aaa = users_in_in_history::whereIn('id_user_in_in',$vv)->update(['status_check' => 1]);
        return redirect()->back()->with('message','Sucess!');
    }
    public function users_add(Request $r){
        return view('backend.users.add',[
            'page'=>"all",
            'list'=>"users",

            'check'=>$r->id,
        ]);
    }

    public function users_add_many(Request $r){
        if(@$r->number==null){
            abort(404);
        }
        return view('backend.users.add_many',[
            'page'=>"all",
            'list'=>"users",

            'number'=>$r->number,
            'id'=>$r->id,
        ]);
    }

    public function users_store_many(Request $r){
        if (!isset($r->users) || !is_array($r->users)) {
            return redirect()->back()->with('error', 'ไม่มีข้อมูลที่ถูกต้อง');
        }
    
        $randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $check='';
        foreach ($r->users as $userData) {
            $acc=null;

            $item = new users();
            $item->password = $userData['password'];
            $item->username = $userData['username'];
            $item->package = $userData['package'];
            $item->name = $userData['name'] ?? null;
            $item->email = $userData['email'] ?? null;
            $item->link_line = $userData['link_line'] ?? null;
            $item->line = $userData['line'] ?? null;
            $item->phone = $userData['phone'] ?? null;
            $item->code = $userData['code'] ?? null;
            $item->date_start = $userData['date_start'] ?? null;
            $item->date_end = $userData['date_end'] ?? null;
            $item->type = $userData['type'];
            $item->type_netflix = 1;

            $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$userData['package'])->first();
            $item->id_package=@$pack_id->id;
    
            if ($item->save()) {

                if($userData['type']=='MOBILE'){

                if($r->id==null){
                    $user = (new users_in())->getEligibleUser();
                }else{
                    $user=users_in::where('id',@$r->id)->first();
                    $bcc=users_in_in::where('id_user_in',@$user->id)->whereNull('type_mail')->count();
                    if($bcc<5){}else{$user=null;}
                }

                if(@$userData['username']!=null and @$userData['password']!=null ){
                if ($user !== null) {
                    $aaa = new users_in_in();
                    $aaa->id_user = $item->id;
                    $aaa->id_user_in = $user->id;
                    $aaa->type = 'MOBILE';

                    $aaa->date_start=$userData['date_start'] ?? null; 
                    $aaa->date_end=$userData['date_end'] ?? null;
                    $aaa->save();
    
                    $aaa_his = new users_in_in_history();
                    $aaa_his->id_user = $item->id;
                    $aaa_his->id_user_in = $user->id;
                    $aaa_his->type = 'MOBILE';
                    $aaa_his->id_user_in_in = $aaa->id;

                    $aaa_his->date_start=$userData['date_start'] ?? null; 
                    $aaa_his->date_end=$userData['date_end'] ?? null;
                    $aaa_his->save();

                    $acc=$user->id;

                } else {
                    $check=1;
                    $item->status_account = 1;
                    $item->save();
                }
                }else{
                    $item->status_account=1;
                    $item->save();
                }

                }else{

                if($r->id==null){
                $user = (new users_in())->getEligibleUser_pc();
                }else{
                    $user=users_in::where('id',@$r->id)->first();
                    $bcc=users_in_in::where('id_user_in',@$user->id)->whereNotNull('type_mail')->count();
                    if($bcc<2){}else{$user=null;}
                }

                if(@$userData['username']!=null and @$userData['password']!=null ){
                if ($user !== null) {
                     // นับจำนวน users_in_in ที่มีอยู่แล้ว
            $countExisting = users_in_in::where('id_user_in', $user->id)->count();

            // คำนวณค่า type_mail (1 หรือ 2)
            $newTypeMail = ($countExisting % 2) + 1;

                    $aaa = new users_in_in();
                    $aaa->id_user = $item->id;
                    $aaa->id_user_in = $user->id;
                    $aaa->type = 'PC';
                    $aaa->type_mail = $newTypeMail;
                    $aaa->date_start=$userData['date_start'] ?? null; 
                    $aaa->date_end=$userData['date_end'] ?? null;
                    $aaa->save();
    
                    $aaa_his = new users_in_in_history();
                    $aaa_his->id_user = $item->id;
                    $aaa_his->id_user_in = $user->id;
                    $aaa_his->type = 'PC';
                    $aaa_his->id_user_in_in = $aaa->id;
                    $aaa_his->type_mail = $newTypeMail;
                    $aaa_his->date_start=$userData['date_start'] ?? null; 
                    $aaa_his->date_end=$userData['date_end'] ?? null;
                    $aaa_his->save();

                    $acc=$user->id;

                } else {
                    $check=1;
                    $item->status_account = 1;
                    $item->save();
                }
                }else{
                    $item->status_account=1;
                    $item->save();
                }
                

                }



                if($acc!=null){
                    $gg=users_in::where('id',$acc)->first();
                    $acc=@$gg->name;
                    if($aaa->type_mail!=null){
                        if($aaa->type_mail==1){
                            $email=@$gg->email01;
                            $pa=@$gg->password01;
                        }else{
                            $email=@$gg->email02;
                            $pa=@$gg->password02;
                        }
                    }else{
                        $email=@$gg->email;
                        $pa=@$gg->password;
                    }
                    @$acc_id=$gg->id;
                }else{
                    $acc='Account เต็ม';
                }

                if($userData['type']=='PC'){
                    $e_type='TV';
                }else{
                    $e_type='ยกเว้นทีวี';
                }
        
        
                $his=new created_history();
                $his->id_admin=Auth::guard('admin')->user()->id;
                $his->id_user=$item->id;
                $his->id_user_in=@$acc_id;
                $his->id_user_in_in=@$aaa->id;
                $his->number=$randomNumber;
                $his->detail = 'สร้าง&nbsp;&nbsp;&nbsp;Account: '.$acc.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile: '.$item->name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Package: '.@$e_type.' '.$item->package.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: '.@$email.'&nbsp;&nbsp;Password: '.@$pa;

                $his->save();


                $dash_regis_to=new dash_regis_to();
                $dash_regis_to->id_user=$item->id; 
                $dash_regis_to->id_package=$item->id_package; 
                $dash_regis_to->id_admin=Auth::guard('admin')->user()->id;
                $dash_regis_to->date=date('Y-m-d');
                $dash_regis_to->type=0;
                $dash_regis_to->save();


            }
        }


        if($r->id!=null){
            if($check==1){
                return redirect()->to('users_in_edit/'.$r->id)->with('message', 'สร้างผู้ใช้สำเร็จ แต่มีบาง User ที่ไม่มี Account!');
            }else{
                return redirect()->to('users_in_edit/'.$r->id)->with('message', 'สร้างผู้ใช้สำเร็จ!');
            }
        }else{
            if($check==1){
                return redirect()->to('users')->with('message', 'สร้างผู้ใช้สำเร็จ แต่มีบาง User ที่ไม่มี Account!');
            }else{
                return redirect()->to('users')->with('message', 'สร้างผู้ใช้สำเร็จ!');
            }
        }

      
    }

    //users//




    public function users_store_form_in(Request $r){
        $item=new users();
        // $ch=users::where('email',$r->email)->orderby('id','desc')->first();
        // $ca=users::where('username',$r->username)->orderby('id','desc')->first();

        // if($ch!=null){
        //     return redirect()->back()->with('message','Email Already Have in Data!');
        //     }
            
            // elseif($ca!=null){
            //     return redirect()->back()->with('message','Username Already Have in Data!');
            // }

        $item->password=$r->password;

        $item->username=$r->username;
        $item->name=$r->name;
        $item->email=$r->email;
        $item->link_line=$r->link_line;
        $item->line=$r->line;
        $item->phone=$r->phone;
        $item->code=$r->code;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->day=$r->day;
        $item->type=$r->type;
        $item->package=$r->package;

        $item->type_netflix=1;

        $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$r->package)->first();
        $item->id_package=@$pack_id->id;

        // $caa=users::where('username',$r->username)->orderby('id','desc')->first();
        // if($caa!=null){
        //     return redirect()->back()->with('message','Username Already Have in Data!');
        // }

        $item->save();

        

        if($r->username!=null and $r->password!=null ){
        if($r->type_mail==null){
        $user_in_in_count=users_in_in::where('id_user_in',@$r->id_user_in)->count();
        if($user_in_in_count >= 5){
        $item->status_account=1;
        $item->save();
        return redirect()->back()->with('message','สร้างสำเร็จแต่นำเข้า Account นี้ไม่ได้เนื่องจาก จำนวนผู้ใช้งานครบแล้ว!');
        }else{
        $aaa=new users_in_in();
        $aaa->id_user=$item->id;  
        $aaa->id_user_in=$r->id_user_in;    
        $aaa->type=$item->type;

        $aaa->date_start=$r->date_start; 
        $aaa->date_end=$r->date_end;
        $aaa->save();

        $aaa_his=new users_in_in_history();
        $aaa_his->id_user=$item->id;  
        $aaa_his->id_user_in=$r->id_user_in;    
        $aaa_his->type=$item->type;
        $aaa_his->id_user_in_in = $aaa->id;

        $aaa_his->date_start=$r->date_start; 
        $aaa_his->date_end=$r->date_end;
        $aaa_his->save();


        $dash_regis_to=new dash_regis_to();
        $dash_regis_to->id_user=$item->id; 
        $dash_regis_to->id_package=$item->id_package; 
        $dash_regis_to->id_admin=Auth::guard('admin')->user()->id;
        $dash_regis_to->date=date('Y-m-d');
        $dash_regis_to->type=0;
        $dash_regis_to->save();

        return redirect()->back()->with('message','Sucess!');
        }

        }else{
            $user_in_in_count_PC=users_in_in::where('id_user_in',$r->id_user_in)->where('type','PC')->where('type_mail',$r->type_mail)->orderby('id','desc')->count();

            if($user_in_in_count_PC==0){
            $aaa=new users_in_in();
            $aaa->id_user=$item->id;  
            $aaa->id_user_in=$r->id_user_in;    
            $aaa->type='PC';
            $aaa->type_mail=$r->type_mail;

            $aaa->date_start=$r->date_start; 
            $aaa->date_end=$r->date_end;
            $aaa->save();
    
            $aaa_his=new users_in_in_history();
            $aaa_his->id_user=$item->id;  
            $aaa_his->id_user_in=$r->id_user_in;    
            $aaa_his->type='PC';
            $aaa_his->type_mail=$r->type_mail;
            $aaa_his->id_user_in_in = $aaa->id;

            $aaa_his->date_start=$r->date_start; 
            $aaa_his->date_end=$r->date_end;
            $aaa_his->save();


            $dash_regis_to=new dash_regis_to();
            $dash_regis_to->id_user=$item->id; 
            $dash_regis_to->id_package=$item->id_package; 
            $dash_regis_to->id_admin=Auth::guard('admin')->user()->id;
            $dash_regis_to->date=date('Y-m-d');
            $dash_regis_to->type=0;
            $dash_regis_to->save();

            return redirect()->back()->with('message','Sucess!');
            }else{
                return redirect()->back()->with('message','Fail มีคนใช้อีเมลนี้แล้ว!');
            }
        }
        }

      

    }







       // OPEN/CLOSE-------users_in
       public function users_in_open_close(Request $r)
       {
           $item = users_in::where('id', $r->id)->first();
       
           if($item!=null){
           if (@$item->open==0) {
               $item->open = 1;
               $item->save();
           }else{
              $item->open = 0;
              $item->save();
           }
       
               return response()->json(['success' => true, 'open' => $item->open]);
           }
       
           return response()->json(['success' => false]);
       }
  
  
       //User_in//
       public function users_in(Request $r){
        

          $item=users_in::whereNull('type_f')->orderby('id','desc')->paginate(10);
          $search = $r->search;
          $status_account = $r->status_account;

          // ตรวจสอบว่า search เป็นวันที่ในรูปแบบ 14/03/2025 หรือไม่
            $date_new = null;
            if (!empty($search) && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $search)) {
                $date_parts = explode('/', $search);
                $date_new = $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0]; // แปลงเป็น Y-m-d
            }

            if (!empty($search) or !empty($status_account)) {
                $item = users_in::whereNull('type_f')->where(function ($query) use ($search, $status_account, $date_new) {
                    // ถ้า search เป็นวันที่ ให้ใช้ date_new แทน search
                    if ($date_new !== null) {
                        if ($status_account == '3') {
                            $query->where('date_ee',$search);
                        }else{
                            $query->where('date_end',$date_new);
                        }
                    } else {

                        if ($status_account == '3') {
                            $query->where('date_ee',$search);
                        }else{
                            $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%')
                            ->orWhere('country', 'LIKE', '%' . $search . '%');
                         }   
                        
                    }
                });

                if ($status_account == '0') {
                    $item = $item->where('date_end', '>=', $date);
                } elseif ($status_account == '1') {
                    $item = $item->where('date_end', '<', $date);
                } elseif ($status_account == '2') {
                    $item = $item->whereBetween('date_end', [$date, date('Y-m-d', strtotime('+3 days', strtotime($date)))]);
                }

                elseif ($status_account == '4') {
                    $item = $item->where('open',0);
                }
                elseif ($status_account == '5') {
                    $item = $item->where('open',1);
                }

                $item = $item->orderBy('id', 'desc')->paginate(10);
            }

          return view('backend.users_in.index',[
              'item'=>$item,
              'page'=>"all",
              'list'=>"users_in",

              'search'=>$search,
              'status_account'=>$status_account,
          ]);
      }
      public function users_in_store(Request $r){
          $item=new users_in();
          $ch=users_in::whereNotNull('email')->where('email',$r->email)->orderby('id','desc')->first();
          $nh=users_in::where('name',$r->name)->orderby('id','desc')->first();
  
  
          if($ch!=null){
              return redirect()->back()->with('message','Email Already Have in Data!');
              }else{
                $ch=users_in::whereNotNull('email01')->where('email01',$r->email)->orderby('id','desc')->first();
                if($ch!=null){
                return redirect()->back()->with('message','Email Already Have in Data!');
                }else{
                    $ch=users_in::whereNotNull('email02')->where('email02',$r->email)->orderby('id','desc')->first();
                    if($ch!=null){
                    return redirect()->back()->with('message','Email Already Have in Data!');
                    } 
                }
              }


              if($r->email01!=null){
              $ch1=users_in::where('email',$r->email01)->orderby('id','desc')->first();

              if($ch1!=null){
                return redirect()->back()->with('message','Email Already Have in Data!');
                }else{
                  $ch1=users_in::where('email01',$r->email01)->orderby('id','desc')->first();
                  if($ch1!=null){
                  return redirect()->back()->with('message','Email Already Have in Data!');
                  }else{
                      $ch1=users_in::where('email02',$r->email01)->orderby('id','desc')->first();
                      if($ch1!=null){
                      return redirect()->back()->with('message','Email Already Have in Data!');
                      } 
                  }
                }
                }


                if($r->email02!=null){
                $ch2=users_in::where('email',$r->email02)->orderby('id','desc')->first();

                if($ch2!=null){
                  return redirect()->back()->with('message','Email Already Have in Data!');
                  }else{
                    $ch2=users_in::where('email01',$r->email02)->orderby('id','desc')->first();
                    if($ch2!=null){
                    return redirect()->back()->with('message','Email Already Have in Data!');
                    }else{
                        $ch2=users_in::where('email02',$r->email02)->orderby('id','desc')->first();
                        if($ch2!=null){
                        return redirect()->back()->with('message','Email Already Have in Data!');
                        } 
                    }
                  }
                    }


              if($nh!=null){
                return redirect()->back()->with('message','Name Profile Already Have in Data!');
                }   
  
          $item->password=$r->password;

          $item->date_ss=$r->date_ss;
          $item->date_ee=$r->date_ee;
  
          $item->name=$r->name;
          $item->email=$r->email;
          $item->date_start=$r->date_start;
          $item->date_end=$r->date_end;
          $item->country=$r->country;

          $item->email01=$r->email01;
          $item->email02=$r->email02;
          $item->code=$r->code;

          $item->password01=$r->password01;
          $item->password02=$r->password02;
  
          $item->save();
          return redirect()->to('users_in_edit/'.$item->id)->with('message','Sucess!');
  
      }
      public function users_in_update(Request $r,$id){
          $item=users_in::where('id',$id)->first();
          $ch=users_in::where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();
          $nh=users_in::where('id','!=',$id)->where('name',$r->name)->orderby('id','desc')->first();

          $qr = users_in::where(function($query) use ($r) {
            $query->where('email', $r->email01)
                  ->whereNotNull('email');
        })
        ->orWhere(function($query) use ($r) {
            $query->where('email', $r->email02)
                  ->whereNotNull('email');
        })
        ->first();
          if($qr!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
          }
          $qr = users_in::where(function($query) use ($r) {
            $query->where('email01', $r->email)
                  ->whereNotNull('email01');
        })
        ->orWhere(function($query) use ($r) {
            $query->where('email02', $r->email)
                  ->whereNotNull('email02');
        })
        ->first();
          if($qr!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
          }

          
  
          if($ch!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
            }else{
              $ch=users_in::where('id','!=',$id)->where('email01',$r->email)->orderby('id','desc')->first();
              if($ch!=null){
              return redirect()->back()->with('message','Email Already Have in Data!');
              }else{
                  $ch=users_in::where('id','!=',$id)->where('email02',$r->email)->orderby('id','desc')->first();
                  if($ch!=null){
                  return redirect()->back()->with('message','Email Already Have in Data!');
                  } 
              }
            }

            if($r->email01!=null){
            $ch1=users_in::where('id','!=',$id)->where('email',$r->email01)->orderby('id','desc')->first();

            if($ch1!=null){
              return redirect()->back()->with('message','Email Already Have in Data!');
              }else{
                $ch1=users_in::where('id','!=',$id)->where('email01',$r->email01)->orderby('id','desc')->first();
                if($ch1!=null){
                return redirect()->back()->with('message','Email Already Have in Data!');
                }else{
                    $ch1=users_in::where('id','!=',$id)->where('email02',$r->email01)->orderby('id','desc')->first();
                    if($ch1!=null){
                    return redirect()->back()->with('message','Email Already Have in Data!');
                    } 
                }
              }
                }


                if($r->email02!=null){
              $ch2=users_in::where('id','!=',$id)->where('email',$r->email02)->orderby('id','desc')->first();

              if($ch2!=null){
                return redirect()->back()->with('message','Email Already Have in Data!');
                }else{
                  $ch2=users_in::where('id','!=',$id)->where('email01',$r->email02)->orderby('id','desc')->first();
                  if($ch2!=null){
                  return redirect()->back()->with('message','Email Already Have in Data!');
                  }else{
                      $ch2=users_in::where('id','!=',$id)->where('email02',$r->email02)->orderby('id','desc')->first();
                      if($ch2!=null){
                      return redirect()->back()->with('message','Email Already Have in Data!');
                      } 
                  }
                }
                }

              if($nh!=null){
                return redirect()->back()->with('message','Name Profile Already Have in Data!');
                } 
  
           $item->password=$r->password;
  
           $item->date_ss=$r->date_ss;
           $item->date_ee=$r->date_ee;

          $item->name=$r->name;
          $item->email=$r->email;
          $item->date_start=$r->date_start;
          $item->date_end=$r->date_end;
          $item->country=$r->country;

          $item->email01=$r->email01;
          $item->email02=$r->email02;
          $item->code=$r->code;

          $item->password01=$r->password01;
          $item->password02=$r->password02;
  
          $item->save();
          return redirect()->to('users_in_edit/'.$id)->with('message','Sucess!');
      }
      public function users_in_edit($id){
          $item=DB::table('tb_users_in')->where('id',$id)->first();

          return view('backend.users_in.edit',[
              'item'=>$item,
              'page'=>"all",
              'list'=>"users_in",
          ]);
      }
      public function users_in_destroy($id){
          $item=users_in::where('id',$id)->first();
          $item->delete();
          $ge = users_in_in::where('id_user_in',$id)->pluck('id_user')->toArray();

          $vv = users_in_in::where('id_user_in',$id)->pluck('id')->toArray();

          $de = users_in_in::where('id_user_in',$id)->delete();
          $ff = users::whereIn('id',$ge)->update(['status_account' => 1]);

          $aaa = users_in_in_history::whereIn('id_user_in_in',$vv)->update(['status_check' => 1]);

          return redirect()->back()->with('message','Sucess!');
      }
      public function users_in_add(){
          return view('backend.users_in.add',[
              'page'=>"all",
              'list'=>"users_in",
          ]);
      }
      //users_in//

      
    









     //users_in_in//
      public function add_user_in_in(Request $r){
        $ch=users_in_in::where('id_user',$r->id_user)->where('type','MOBILE')->where('id_user_in',$r->id_user_in)->first();
  
        if($ch!=null){
            return redirect()->back()->with('message','User Already Have in Data!');
            }

            $ch2=users_in_in::where('id_user',$r->id_user)->where('type','PC')->where('id_user_in',$r->id_user_in)->first();
  
            if($ch2!=null){
                return redirect()->back()->with('message','User Already Have in Data!');
                }

        $user_in_in_count_PC=users_in_in::where('id_user_in',$r->id_user_in)->where('type','PC')->where('type_mail',$r->type_mail)->orderby('id','desc')->first();

        if($user_in_in_count_PC!=null and $r->type_mail!=null){
            return redirect()->back()->with('message','Fail มีคนใช้อีเมลนี้แล้ว!');
        }

        $check_c=users_in_in::where('id_user_in',$r->id_user_in)->where('type','PC')->orderby('id','desc')->count();
        if($check_c>=2 and $r->type_mail!=null){
            return redirect()->back()->with('message','Fail Email เสริมครบแล้ว!');
        }

        $user=users::where('id',$r->id_user)->first();
        $item=new users_in_in();
        $item->id_user=$r->id_user;  
        $item->id_user_in=$r->id_user_in;  
        if($r->type_mail!=null){
        $item->type='PC';
        $item->type_mail=$r->type_mail;
        }else{
        $item->type=@$user->type;
        }
        // $item->type=$r->type;

        $item->date_start=@$user->date_start; 
        $item->date_end=@$user->date_end;

        $user_in_in_count=users_in_in::where('type','MOBILE')->where('id_user_in',@$r->id_user_in)->count();
        if($user_in_in_count >= 5 and $r->type_mail==null){
        return redirect()->back()->with('message','จำนวนผู้ใช้งานครบแล้ว!');
        }else{
        $item->save();

        $item_his=new users_in_in_history();
        $item_his->id_user=$r->id_user;  
        $item_his->id_user_in=$r->id_user_in; 
        $item_his->id_user_in_in = $item->id;   
        if($r->type_mail!=null){
            $item_his->type='PC';
            $item_his->type_mail=$r->type_mail;
            }else{
            $item_his->type=@$user->type;
            }

            $item_his->date_start=@$user->date_start; 
            $item_his->date_end=@$user->date_end;

        $item_his->save();
        }

        $user->status_account=0;
        $user->save();

       
        return redirect()->back()->with('message','Sucess!');

    }

    public function users_in_in_open_close(Request $r)
    {
        $item = users_in_in::where('id', $r->id)->first();
    
        if($item!=null){
        if (@$item->open==0) {
            $item->open = 1;
            $item->save();
        }else{
           $item->open = 0;
           $item->save();
        }
    
            return response()->json(['success' => true, 'open' => $item->open]);
        }
    
        return response()->json(['success' => false]);
    }

    public function users_in_in_destroy($id){
        $item=users_in_in::where('id',$id)->first();
        $user=users::where('id',@$item->id_user)->first();
        if($user!=null){
            $user->status_account=1;
            $user->save();
        }
        
        $item->delete();

        $aaa = users_in_in_history::where('id_user_in_in',$id)->update(['status_check' => 1]);
        
        return redirect()->back()->with('message','Sucess!');
    }
    //users_in_in//



    // Auto
    public function autoCreateUsersInIn(Request $r)
{
    $date = date('Y-m-d'); // วันที่ปัจจุบัน

    // ดึง users ที่ยังไม่หมดอายุและยังไม่ถูกเชื่อมกับ user_in_in
    $users = users::whereNotNull('type_netflix')->whereDoesntHave('users_in_in') // ยังไม่มีการเชื่อมกับ users_in_in
                ->where('open',0)
                ->whereNotNull('username')
                ->whereNotNull('password')
                ->whereDate('date_start', '<=', $date) // ยังไม่หมดอายุ (start <= ปัจจุบัน)
                ->whereDate('date_end', '>=', $date) // ยังไม่หมดอายุ (end >= ปัจจุบัน)
                ->limit(5)->get();

    // เช็คว่ามี users หรือไม่
    if ($users->isEmpty()) {
        return redirect()->back()->with('message','ไม่มี User ที่ใช้ได้ในขณะนี้');
    }

    // สร้างข้อมูลใน users_in_in แบบอัตโนมัติ
    foreach ($users as $user) {

        $check_tan=users_in_in::where('id_user_in',@$r->id_user_in)->where('tan',1)->count();

        if(@$check_tan<2){
            
        $aaa=users::where('id',$user->id)->first();
        $item=new users_in_in();
        $item->id_user=$user->id;  
        $item->id_user_in=$r->id_user_in;    
        $item->type=@$aaa->type;

        $item->date_start=@$aaa->date_start; 
        $item->date_end=@$aaa->date_end;

        $user_in_in_count=users_in_in::where('type','MOBILE')->where('id_user_in',@$r->id_user_in)->count();
        if($user_in_in_count >= 5){
        return redirect()->back()->with('message','จำนวนผู้ใช้งานครบแล้ว!');
        }else{
        $item->save();

        $item_his=new users_in_in_history();
        $item_his->id_user=$user->id;  
        $item_his->id_user_in=$r->id_user_in;    
        $item_his->type=@$aaa->type;
        $item_his->id_user_in_in = $item->id;

        $item_his->date_start=@$aaa->date_start; 
        $item_his->date_end=@$aaa->date_end;
        $item_his->save();

        $aaa->status_account=0;
        $aaa->save();
        }
        }
    }

    return redirect()->back()->with('message','Sucess!');
}
// Auto





 // Auto
 public function autoCreateUsersInIn_aaa(Request $r)
 {
     $date = date('Y-m-d'); // วันที่ปัจจุบัน
 
     // ดึง users ที่ยังไม่หมดอายุและยังไม่ถูกเชื่อมกับ user_in_in
     $users = users::whereNotNull('type_netflix')->whereDoesntHave('users_in_in') // ยังไม่มีการเชื่อมกับ users_in_in
                 ->where('open',0)
                 ->whereNull('password')
                 ->whereDate('date_start', '<=', $date) // ยังไม่หมดอายุ (start <= ปัจจุบัน)
                 ->whereDate('date_end', '>=', $date) // ยังไม่หมดอายุ (end >= ปัจจุบัน)
                 ->limit(2)->get();
 
     // เช็คว่ามี users หรือไม่
     if ($users->isEmpty()) {
         return redirect()->back()->with('message','ไม่มี User ที่ใช้ได้ในขณะนี้');
     }
 
     // สร้างข้อมูลใน users_in_in แบบอัตโนมัติ
     foreach ($users as $user) {
         $check_tan=users_in_in::where('id_user_in',@$r->id_user_in)->where('tan',1)->count();

         if(@$check_tan<2){
         $hol=1; 

         $aaa=users::where('id',$user->id)->first();
         $item=new users_in_in();
         $item->id_user=$user->id;  
         $item->id_user_in=$r->id_user_in;    
         $item->type=@$aaa->type;
         $item->tan=1;
 
         $item->date_start=@$aaa->date_start; 
         $item->date_end=@$aaa->date_end;
 
         $user_in_in_count=users_in_in::where('type','MOBILE')->where('id_user_in',@$r->id_user_in)->count();
         if($user_in_in_count >= 5){
         return redirect()->back()->with('message','จำนวนผู้ใช้งานครบแล้ว!');
         }else{
         $item->save();
 
         $item_his=new users_in_in_history();
         $item_his->id_user=$user->id;  
         $item_his->id_user_in=$r->id_user_in;    
         $item_his->type=@$aaa->type;
         $item_his->tan=1;
         $item_his->id_user_in_in = $item->id;
 
         $item_his->date_start=@$aaa->date_start; 
         $item_his->date_end=@$aaa->date_end;
         $item_his->save();

         $aaa->status_account=0;
         $aaa->save();
         }

        }
     }
 
     if(@$hol!=null){
        return redirect()->back()->with('message','Sucess!');
     }else{
        return redirect()->back()->with('message','ตัวแทนเต็มแล้ว');
     }
 }
 // Auto
    





}
