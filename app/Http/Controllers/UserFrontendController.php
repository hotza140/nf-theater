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
use App\Models\Packagewatch;
use App\Models\PackageSubwatch;
use App\Models\Reward;
use App\Models\RewardUserLog;
use App\Mail\CustConfirmMail;
use App\Models\OrderPayPackage;
use App\Models\PayPackNotmatch;

use App\Models\alert;

use App\Models\ReferFriend;
use App\Models\DefaultConfig;
use App\Models\PointSumbalance;
use App\Models\OrderPayPackageTruewallet;

class UserFrontendController extends Controller
{
    ///login---------------
   public function login(){
    return view('frontend.login');
    }

 ///LOGOUT---------------
    public function logoutfrontend(){
        // Auth::logout();
        Auth::guard('users')->logout();
        return redirect()->route('frontend.login')->with('message','Sucess!');
    }

//      ///register---------------
//    public function register(){
//     abort(404);
//     exit; // หยุดการทำงานที่เหลือ
//         return view('auth.register');
//     }

//      ///verify---------------
//     public function verify(){
//         abort(404);
//         exit; // หยุดการทำงานที่เหลือ
//         return view('auth.verify');
//     }



 ///frontend Login---------------
    public function login_frontend(Request $r)
    {
        // ลบเช็คเวลา
        $date=date('Y-m-d');
        $users_check = users_in_in::whereDate('date_end', '<', $date)->pluck('id')->toArray();
        $users_check_user = users_in_in::whereDate('date_end', '<', $date)->pluck('id_user')->toArray();
        $accounts=users_in_in::whereIn('id',@$users_check)->delete();
        $users_update = users::whereIn('id',@$users_check_user)->update(['status_account' => 2]);
        // ลบเช็คเวลา

        if($r->type=='netflix'){
            $users=users::where('username',$r->username)->where('password',$r->password)->whereNotNull('type_netflix')->orderBy('id','asc')->first();
        }else{
            $users=users::where('username',$r->username)->where('password',$r->password)->whereNotNull('type_youtube')->orderBy('id','asc')->first();
        }

        if($users){
                Auth::guard('users')->login($users); 

                return redirect()->route('frontend.profile');
                // if($r->type=='netflix'){
                //     return redirect("/profile");
                // }else{
                //     return redirect("/profile");
                // }
        }else{
            return redirect()->to('/frontlogin')->with('message','Username or Password Wrong!');
        }
    }

    public function change_profile($id)
    {
        // ลบเช็คเวลา
        $date=date('Y-m-d');
        $users_check = users_in_in::whereDate('date_end', '<', $date)->pluck('id')->toArray();
        $users_check_user = users_in_in::whereDate('date_end', '<', $date)->pluck('id_user')->toArray();
        $accounts=users_in_in::whereIn('id',@$users_check)->delete();
        $users_update = users::whereIn('id',@$users_check_user)->update(['status_account' => 2]);
        // ลบเช็คเวลา
        $users=users::where('id',$id)->first();
        Auth::guard('users')->login($users); 
        return redirect()->to('profile');
    }

    public function nFYtPackage(Request $r) {
        $id = $r->id;
        $Packagewatch = Packagewatch::find($id); 
        $PackageSubwatch = PackageSubwatch::where('package_Code',$Packagewatch->package_Code)->get();
        if($r->id==1) return view('frontend.netflix-pricing',compact('Packagewatch','PackageSubwatch','id'));
        else if($r->id==2) return view('frontend.youtube-pricing',compact('Packagewatch','PackageSubwatch','id'));
    }

    public function rewardsRead(Request $r) {
        $Reward = Reward::select('*')->orderby('reward_Score')->get();
        return view('frontend.rewards',compact('Reward'));
    }

    public function RewardUserLog_store(Request $r) {
        $userIs = \Auth::guard('users')->user();
        $RewardUserLog = new RewardUserLog();

        $RewardUserLog->username = $userIs->username;
        $RewardUserLog->reward_Name = $r->reward_Name;
        $RewardUserLog->reward_Code = $r->reward_Code;

        $RewardUserLog->save();

        return redirect()->back()->with('message','Sucess!');
    }

    public function profileRdSh (Request $request) {
        // ลบเช็คเวลา
        $date=date('Y-m-d');
        $users_check = users_in_in::whereDate('date_end', '<', $date)->pluck('id')->toArray();
        $users_check_user = users_in_in::whereDate('date_end', '<', $date)->pluck('id_user')->toArray();
        $accounts=users_in_in::whereIn('id',@$users_check)->delete();
        $users_update = users::whereIn('id',@$users_check_user)->update(['status_account' => 2]);
        // ลบเช็คเวลา
        
        $users = Auth::guard('users')->user();

        // ตรวจสอบ referee_username ผู้ถูกแนะนำได้ดำเนินการให้คะแนนผู้แนะนำแล้ว
        $ReferFriend = ReferFriend::where('referee_username',$users->username)->first();
        $ProfileNows = 1;

        $selectNfYt = @$request->selectNfYt??\Session::get('selectNfYt');
        if(@$request->selectNfYt) \Session::put('selectNfYt',$request->selectNfYt);
        
        $RewardUserLog = RewardUserLog::where('username',$users->username)->get();
        $userProfile = users::select(
                'tb_users.id',
                'tb_users.username',
                'tb_users.email as useremail',
                'tb_users.password as userpass',
                'tb_users.name as utypename',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type as typeinin',
                'tb_users_in_in.type_mail',
                'tb_users_in.name','tb_users_in.email','tb_users_in.email01','tb_users_in.email02',
                'tb_users_in.password','tb_users_in.password01','tb_users_in.password02',
                'tb_package_subwatch.Subpackage_Name','tb_package_subwatch.Subpackage_Dayuse',
                'tb_package_subwatch.Subpackage_Paymoney'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->leftJoin('tb_package_subwatch', 'tb_users.id_package','tb_package_subwatch.id')
            ->where('tb_users.id', $users->id)->first();


            $userProfile_all_netflix = users::select(
                'tb_users.id',
                'tb_users.username',
                'tb_users.email as useremail',
                'tb_users.password as userpass',
                'tb_users.name as utypename',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type as typeinin',
                'tb_users_in_in.type_mail',
                'tb_users_in.name','tb_users_in.email','tb_users_in.email01','tb_users_in.email02',
                'tb_users_in.password','tb_users_in.password01','tb_users_in.password02',
                'tb_package_subwatch.Subpackage_Name','tb_package_subwatch.Subpackage_Dayuse',
                'tb_package_subwatch.Subpackage_Paymoney'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->leftJoin('tb_package_subwatch', 'tb_users.id_package','tb_package_subwatch.id')
            ->where('tb_users.username', $users->username)->whereNotNull('type_netflix')->orderBy('id','asc')->get();

            $userProfile_all_youtube = users::select(
                'tb_users.id',
                'tb_users.username',
                'tb_users.email as useremail',
                'tb_users.password as userpass',
                'tb_users.name as utypename',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type as typeinin',
                'tb_users_in_in.type_mail',
                'tb_users_in.name','tb_users_in.email','tb_users_in.email01','tb_users_in.email02',
                'tb_users_in.password','tb_users_in.password01','tb_users_in.password02',
                'tb_package_subwatch.Subpackage_Name','tb_package_subwatch.Subpackage_Dayuse',
                'tb_package_subwatch.Subpackage_Paymoney'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->leftJoin('tb_package_subwatch', 'tb_users.id_package','tb_package_subwatch.id')
            ->where('tb_users.username', $users->username)->whereNotNull('type_youtube')->orderBy('id','asc')->get();

            if($users->type_netflix!=null){
                $selectNfYt='NetFlix';
            }else{
                $selectNfYt='YouTube';
            }

        return view('frontend.profile',compact('users','RewardUserLog','userProfile','userProfile_all_netflix','userProfile_all_youtube','selectNfYt','ReferFriend','ProfileNows'));
    }


    public function profile_change (Request $request) {
        // ลบเช็คเวลา
        $date=date('Y-m-d');
        $users_check = users_in_in::whereDate('date_end', '<', $date)->pluck('id')->toArray();
        $users_check_user = users_in_in::whereDate('date_end', '<', $date)->pluck('id_user')->toArray();
        $accounts=users_in_in::whereIn('id',@$users_check)->delete();
        $users_update = users::whereIn('id',@$users_check_user)->update(['status_account' => 2]);
        // ลบเช็คเวลา
        
        $users = Auth::guard('users')->user();

        // ตรวจสอบ referee_username ผู้ถูกแนะนำได้ดำเนินการให้คะแนนผู้แนะนำแล้ว
        $ReferFriend = ReferFriend::where('referee_username',$users->username)->first();
        $ProfileNows = 1;

        $selectNfYt = @$request->selectNfYt??\Session::get('selectNfYt');
        if(@$request->selectNfYt) \Session::put('selectNfYt',$request->selectNfYt);
        
        $RewardUserLog = RewardUserLog::where('username',$users->username)->get();
        $userProfile = users::select(
                'tb_users.id',
                'tb_users.username',
                'tb_users.email as useremail',
                'tb_users.password as userpass',
                'tb_users.name as utypename',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type as typeinin',
                'tb_users_in_in.type_mail',
                'tb_users_in.name','tb_users_in.email','tb_users_in.email01','tb_users_in.email02',
                'tb_users_in.password','tb_users_in.password01','tb_users_in.password02',
                'tb_package_subwatch.Subpackage_Name','tb_package_subwatch.Subpackage_Dayuse',
                'tb_package_subwatch.Subpackage_Paymoney'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->leftJoin('tb_package_subwatch', 'tb_users.id_package','tb_package_subwatch.id')
            ->where('tb_users.id', $users->id)->first();


            $userProfile_all_netflix = users::select(
                'tb_users.id',
                'tb_users.username',
                'tb_users.email as useremail',
                'tb_users.password as userpass',
                'tb_users.name as utypename',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type as typeinin',
                'tb_users_in_in.type_mail',
                'tb_users_in.name','tb_users_in.email','tb_users_in.email01','tb_users_in.email02',
                'tb_users_in.password','tb_users_in.password01','tb_users_in.password02',
                'tb_package_subwatch.Subpackage_Name','tb_package_subwatch.Subpackage_Dayuse',
                'tb_package_subwatch.Subpackage_Paymoney'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->leftJoin('tb_package_subwatch', 'tb_users.id_package','tb_package_subwatch.id')
            ->where('tb_users.username', $users->username)->whereNotNull('type_netflix')->orderBy('id','asc')->get();

            $userProfile_all_youtube = users::select(
                'tb_users.id',
                'tb_users.username',
                'tb_users.email as useremail',
                'tb_users.password as userpass',
                'tb_users.name as utypename',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type as typeinin',
                'tb_users_in_in.type_mail',
                'tb_users_in.name','tb_users_in.email','tb_users_in.email01','tb_users_in.email02',
                'tb_users_in.password','tb_users_in.password01','tb_users_in.password02',
                'tb_package_subwatch.Subpackage_Name','tb_package_subwatch.Subpackage_Dayuse',
                'tb_package_subwatch.Subpackage_Paymoney'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->leftJoin('tb_package_subwatch', 'tb_users.id_package','tb_package_subwatch.id')
            ->where('tb_users.username', $users->username)->whereNotNull('type_youtube')->orderBy('id','asc')->get();

            if($users->type_netflix!=null){
                $selectNfYt='NetFlix';
            }else{
                $selectNfYt='YouTube';
            }

        return view('frontend.profile_change',compact('users','RewardUserLog','userProfile','userProfile_all_netflix','userProfile_all_youtube','selectNfYt','ReferFriend','ProfileNows'));
    }

    public function SendOrderPackage (Request $request) {
        // package_Name,Subpackage_Code ,Subpackage_Name ,Subpackage_Paymoney Orderemail
        $id = $request->id;
        $package_Name = $request->package_Name;
        $Subpackage_Code = $request->Subpackage_Code;
        $Subpackage_Name = $request->Subpackage_Name;
        $Subpackage_Paymoney = $request->Subpackage_Paymoney;
        $Orderemail = $request->Orderemail;
        return view('frontend.orderPayment',compact('id','package_Name','Subpackage_Code' ,'Subpackage_Name' ,'Subpackage_Paymoney' ,'Orderemail'));
    }

    public function SaveOrderPackage ($request) {
        // package_Name,Subpackage_Code ,Subpackage_Name ,Subpackage_Paymoney Orderemail
        $YY = date('y');
        $mm = date('m');
        $CkORD = "ORF{$YY}{$mm}";
        $runnum=DB::table('tb_order_pay_package')->whereRaw("SUBSTR(OrderPayCode,1,7) = '$CkORD'")->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "ORF{$YY}{$mm}{$xxxx}";
        $filename = $run.'_'.date('YmdHis').'.'.$request->file('qr_code_image')->getClientOriginalExtension();
        $userIs = \Auth::guard('users')->user();

        $users = users::where('id', $userIs->id)->first();

        $OrderPayPackage = new OrderPayPackage();
        $OrderPayPackage->OrderPayCode =$run;

        $OrderPayPackage->username =@$users->username;
        $OrderPayPackage->id_users =@$users->id;
        $OrderPayPackage->profile =@$users->name;
        $OrderPayPackage->id_users_backup =$userIs->id;

        $OrderPayPackage->package_Name =$request->package_Name;
        $OrderPayPackage->Subpackage_Code =$request->Subpackage_Code;
        $OrderPayPackage->Subpackage_Name =$request->Subpackage_Name;
        $OrderPayPackage->Subpackage_Paymoney =$request->Subpackage_Paymoney;
        $OrderPayPackage->Orderemail =$request->Orderemail;
        $OrderPayPackage->RefPayment =$request->RefPayment;
        $OrderPayPackage->imgSlip = $filename;
        $OrderPayPackage->save();
        $id = $request->id;

        // Save Slip in frongdrv storage.....
        \Storage::disk('frongdrv')->put('Frongdrv/'.$filename, file_get_contents($request->file('qr_code_image')));
        
        // return redirect()->route($id==1?'frontend.netflix':'frontend.youtube',['id'=>$id])->with('message','Sucess!');


        // ลบเช็คเวลา
        $date=date('Y-m-d');
        $users_check = users_in_in::whereDate('date_end', '<', $date)->pluck('id')->toArray();
        $users_check_user = users_in_in::whereDate('date_end', '<', $date)->pluck('id_user')->toArray();
        $accounts=users_in_in::whereIn('id',@$users_check)->delete();
        $users_update = users::whereIn('id',@$users_check_user)->update(['status_account' => 2]);
        // ลบเช็คเวลา

         ///ส่วนเพิ่มวัน auto
         $account = users_in_in::where('id_user', $userIs->id)->orderBy('id','desc')->first();
         $uu = users::where('id', $userIs->id)->first();
            $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$request->Subpackage_Name)->first();
            $new_date_end = date('Y-m-d', strtotime($account->date_end . ' + ' . $pack_id->Subpackage_Dayuse . ' days'));

            $account->date_end=$new_date_end;
            $account->save();

            $account = users_in_in::where('id_user', $userIs->id)->orderBy('id','desc')->first();
            $aaa_his = new users_in_in_history();
            $aaa_his->id_user = $account->id_user;
            $aaa_his->id_user_in = $account->id_user_in;
            $aaa_his->type = $account->type;
            $aaa_his->type_mail = $account->type_mail;
            $aaa_his->date_start=$account->date_start;
            $aaa_his->date_end=$account->date_end;
            $aaa_his->save();

            $uu->date_start=$account->date_start;
            $uu->date_end=$account->date_end;
            $uu->package=$pack_id->Subpackage_Name;
            $uu->id_package=@$pack_id->id;
            $uu->type=$account->type;
            $uu->save();
         ///ส่วนเพิ่มวัน auto

    }

    public function SaveOrdPkTrueMoneyWallet($request) {
        // package_Name,Subpackage_Code ,Subpackage_Name ,Subpackage_Paymoney Orderemail
        $YY = date('y');
        $mm = date('m');
        $CkORD = "ORT{$YY}{$mm}";
        $runnum=DB::table('tb_order_pay_package_truewallet')->whereRaw("SUBSTR(OrderPayCode,1,7) = '$CkORD'")->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "ORT{$YY}{$mm}{$xxxx}";
        $filename = $run.'_'.date('YmdHis').'.'.$request->file('qr_code_imagetruewallet')->getClientOriginalExtension();
        $userIs = \Auth::guard('users')->user();

        $users = users::where('id', $userIs->id)->first();

        $OrderPayPackage = new OrderPayPackageTruewallet();
        $OrderPayPackage->OrderPayCode =$run;

        $OrderPayPackage->username =@$users->username;
        $OrderPayPackage->id_users =@$users->id;
        $OrderPayPackage->profile =@$users->name;
        $OrderPayPackage->id_users_backup =$userIs->id;

        $OrderPayPackage->package_Name =$request->package_Name;
        $OrderPayPackage->Subpackage_Code =$request->Subpackage_Code;
        $OrderPayPackage->Subpackage_Name =$request->Subpackage_Name;
        $OrderPayPackage->Subpackage_Paymoney =$request->Subpackage_Paymoney;
        $OrderPayPackage->Orderemail =$request->Orderemail;
        $OrderPayPackage->imgSlip = $filename;
        $OrderPayPackage->save();
        $id = $request->id;

        // Save Slip in frongdrv storage.....
        \Storage::disk('frongdrv')->put('Frongdrv/Truewallet/'.$filename, file_get_contents($request->file('qr_code_imagetruewallet')));
    }

    public function afterSaveOrderPackage (Request $request) {
        $truemoneywallet = @$request->truemoneywallet??null;
        if($truemoneywallet) {
            self::SaveOrdPkTrueMoneyWallet($request);
        }
        $id = $request->id;
        return redirect()->route($id==1?'frontend.netflix':'frontend.youtube',['id'=>$id])->with('message','Sucess! '.'Please wait to Admin Check.');
    }

    public function upCheckQR(Request $request) { 
        // Validate the file input
        $request->validate([
            'qr_code_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the uploaded file  Subpackage_Paymoney
        $file = $request->file('qr_code_image');

        if ( $file && $file->isValid()) { // $file && $file->isValid() && 0

            // Prepare the cURL request body with the file
            $body = [
                'log' => true,
                'files' => new \CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
                "amount"=> $request->Subpackage_Paymoney,
            ];

            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.slipok.com/api/line/apikey/40388");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body); // Pass the file directly here
            $headers = [
                'Content-Type: multipart/form-data',  // Change to multipart/form-data for file uploads
                "x-authorization: SLIPOKO90KAEX"      // Your API key
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Execute the request
            $result = curl_exec($ch);

            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Error handling
            if (curl_error($ch)) {
                $statis = ['error' => curl_error($ch), 'status_code' => $statusCode];
            } else {
                $res = json_decode($result, true);
                $statis = [
                    'response' => $res,
                    'status_code' => $statusCode
                ];
            }

            // Close cURL
            curl_close($ch);

            if($statusCode==200) { // || @$statis['response']['code']code: 1012 200 error 400 ส่งซ้ำ  || @$statis['response']['code']==1012
                $request['RefPayment'] = @$statis['response']['data']['transRef'];
                self::SaveOrderPackage($request);
            } else if($statusCode==400) {
                if(@$statis) {
                    self::SavePayNotMacth($request,$statis);  // กรณีที่โอนยอดไม่ตรงที่กำหนดไว้....
                }
            }

            // Return the status
            return response()->json(['statis'=>$statis],$statusCode);
        } else {
            // File upload failed or is not valid
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }
    }

    public function SavePayNotMacth ($request,$statis) { 
        // package_Name,Subpackage_Code ,Subpackage_Name ,Subpackage_Paymoney Orderemail
        try {
            //code...
            $PayPackNotmatchCk = PayPackNotmatch::where('RefPayment',$statis['response']['data']['transRef'])->first();
            if(empty($PayPackNotmatchCk)) {
                $YY = date('y');
                $mm = date('m');
                $CkORD = "ERR{$YY}{$mm}";
                $runnum=DB::table('tb_pay_pack_notmatch')->whereRaw("SUBSTR(OrderPayCode,1,7) = '$CkORD'")->orderby('id','desc')->count();
                $runtotal=$runnum+1;
                $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
                $run = "ERR{$YY}{$mm}{$xxxx}";
                $filename = $run.'_'.date('YmdHis').'.'.$request->file('qr_code_image')->getClientOriginalExtension();
                $userIs = \Auth::guard('users')->user();
                $PayPackNotmatch = new PayPackNotmatch();
                $PayPackNotmatch->OrderPayCode =$run;
                $PayPackNotmatch->username =$userIs->username;
                $PayPackNotmatch->package_Name =$request->package_Name;
                $PayPackNotmatch->Subpackage_Code =$request->Subpackage_Code;
                $PayPackNotmatch->Subpackage_Name =$request->Subpackage_Name;
                $PayPackNotmatch->Subpackage_Paymoney =$request->Subpackage_Paymoney;
                $PayPackNotmatch->Cus_Paymoney = $statis['response']['data']['amount'];
                $PayPackNotmatch->Orderemail =$request->Orderemail;
                $PayPackNotmatch->RefPayment =$statis['response']['data']['transRef'];
                $PayPackNotmatch->messageslip =$statis['response']['message'];
                $PayPackNotmatch->imgSlip = $filename;
                
                $PayPackNotmatch->save();

                // Save Slip in frongdrv storage.....
                \Storage::disk('frongdrv')->put('Frongdrv/Err/'.$filename, file_get_contents($request->file('qr_code_image')));
            }
            
            $id = $request->id;
        } catch (\Throwable $th) {
            //throw $th;
        }

        // return redirect()->route($id==1?'frontend.netflix':'frontend.youtube',['id'=>$id])->with('message','Sucess!');
    }

    public function changepassusercus(Request $request) {
        $validator = \Validator::make($request->all(), [
            'oldpass' => 'required',
            'newpass' => 'required|min:6',
            'newpassre' => 'required|same:newpass',
        ]);
        
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->with('message','Password Wrong!');
        }
        
        $users = users::where('username',$request->username)->where('password',$request->oldpass)->get();
        if(count($users)>0) {
            foreach ($users as $key => $value) {
                # code...
                $value->password=$request->newpass;
                $value->save();
            }
        } else return redirect()->back()->with('message','Password Wrong!');

        return redirect()->back()->with('message','Success!');
    }

    public function SendMailSMTPT1() {
        // 'from' => array('address' => 'myusername@gmail.com', 'name' => 'hawle'),
        // $mailData = '';
        // $apply_email = 'egchai.pookham.org@gmail.com';// $value->apply_email;
        // $MailSend = Mail::to($apply_email);
        // if(@$ccEmails) $MailSend->cc($ccEmails);
        // if(@$bccEmails) $MailSend->bcc($bccEmails);
        // $MailSend->send(new CustConfirmMail($mailData));

        // Mail::send('frontend.mailcus.mailtocusauto', [ 'content' => 'testmail'],    
        // function ($m) {
        //     $m->from('abc@gmail.com', 'ABC'); 
        //     $m->to('egchai.pookham.org@gmail.com', 'XYZ')->subject('TestMailSubject!');
        // }
        
        // );
    
        // if (Mail::failures()) {
        //         return response()->Fail('Sorry! Please try again latter');
        //         // return redirect()->back()->withErrors(['name' => 'The name is required']);
        // }else{
        //         return response()->success('Great! Successfully send in your mail');
        //         // return redirect()->back()->withSuccess(['name' => 'The name is required']);
        // }

        Mail::to('egachai.pookham.org@gmail.com')->send(new CustConfirmMail());

        return 'Test email sent!';
    }

    public function getimgSlipBase64(Request $request) {
        $filerd = \Storage::disk('frongdrv')->get('Frongdrv/'.(@$request->path?$request->path.'/':'').$request->img);
        $base64 = base64_encode($filerd);
        
        // If you need to include the MIME type (for displaying in an `img` tag)
        $mime = \Storage::disk('frongdrv')->mimeType('Frongdrv/'.(@$request->path?$request->path.'/':'').$request->img);
        $base64WithMime = 'data:' . $mime . ';base64,' . $base64;

        return response()->json(["img"=>$base64WithMime],200); // Output Base64 image string
    }

    public function confirmReferrer(Request $request) {
        // confirmReferrer
        // usernameReferrer,noshowReferrerCk
        $saveOK = 0;
        $users = Auth::guard('users')->user();

        $usersCKReferrer = users::where('username',@$request->usernameReferrer)->first();
        $DefaultConfig = DefaultConfig::find(1);
        if(@$request->usernameReferrer) {
            if(@$usersCKReferrer&&@$request->usernameReferrer!=$users->username) {
                $ReferFriendCK = ReferFriend::where('referee_username',$users->username)->where('referrer_username',$request->usernameReferrer)->first();
                $ReferFriend = new ReferFriend();
                if(!@$ReferFriendCK) {
                    $ReferFriend = new ReferFriend();
                    $ReferFriend->referee_user_id = $users->id;
                    $ReferFriend->referee_username = $users->username;
                    $ReferFriend->referrer_username = @$request->usernameReferrer;
                    $ReferFriend->referrer_score = $DefaultConfig->referrer_point;
                    $ReferFriend->save();
                }

                // check user sum&use&balance point
                $PointSumbalanceCHK = PointSumbalance::where('usernamepoint',@$ReferFriend->referrer_username)->first();
                $PointSumbalance = new PointSumbalance();
                if(!@$PointSumbalanceCHK&&@$ReferFriend->referrer_username) {
                    $PointSumbalance->user_id = $users->id;
                    $PointSumbalance->usernamepoint = @$ReferFriend->referrer_username;
                    $PointSumbalance->save();
                }

                // บันทึกเพิ่ม point ให้กับผู้แนะนำ และนำค่าที่บันทึกบวกเข้ารายการสะสมแต้ม
                if(@$ReferFriend->referrer_username) {
                    $PointSumbalanceRChg = PointSumbalance::where('usernamepoint',@$ReferFriend->referrer_username)->first();
                    $PointSumbalanceRChg->point_sum = $PointSumbalanceRChg->point_sum+$DefaultConfig->referrer_point;
                    $PointSumbalanceRChg->point_balance = $PointSumbalanceRChg->point_sum-$PointSumbalanceRChg->point_use;
                    $PointSumbalanceRChg->save();
                }

                $saveOK = 1;
            }
        } else if(@$request->noshowReferrerCk) {
            $ReferFriend = new ReferFriend();
            $ReferFriend->referee_user_id = $users->id;
            $ReferFriend->referee_username = $users->username;
            $ReferFriend->save();
            $saveOK = 2;
        }
        return response()->json(["usernameReferrer"=>$request->usernameReferrer,"noshowReferrerCk"=>$request->noshowReferrerCk,'saveOK'=>$saveOK]);
    }

    public function confirmReferrerFRST(Request $request) {
        // confirmReferrerFRST
        // usernameReferrer
        $saveOK = 0;
        $users = Auth::guard('users')->user();

        $usersCKReferrer = users::where('username',@$request->usernameReferrer)->first();
        $DefaultConfig = DefaultConfig::find(1);
        if(@$request->usernameReferrer) {
            if(@$usersCKReferrer&&@$request->usernameReferrer!=$users->username) {
                $ReferFriend = ReferFriend::where('referee_username',$users->username)->first();
                $ReferFriend->referrer_username = @$request->usernameReferrer;
                $ReferFriend->referrer_score = $DefaultConfig->referrer_point;
                $ReferFriend->save();

                // check user sum&use&balance point
                $PointSumbalanceCHK = PointSumbalance::where('usernamepoint',@$ReferFriend->referrer_username)->first();
                $PointSumbalance = new PointSumbalance();
                if(!@$PointSumbalanceCHK&&@$ReferFriend->referrer_username) {
                    $PointSumbalance->user_id = $users->id;
                    $PointSumbalance->usernamepoint = @$ReferFriend->referrer_username;
                    $PointSumbalance->save();
                }

                // บันทึกเพิ่ม point ให้กับผู้แนะนำ และนำค่าที่บันทึกบวกเข้ารายการสะสมแต้ม
                if(@$ReferFriend->referrer_username) {
                    $PointSumbalanceRChg = PointSumbalance::where('usernamepoint',@$ReferFriend->referrer_username)->first();
                    $PointSumbalanceRChg->point_sum = $PointSumbalanceRChg->point_sum+$DefaultConfig->referrer_point;
                    $PointSumbalanceRChg->point_balance = $PointSumbalanceRChg->point_sum-$PointSumbalanceRChg->point_use;
                    $PointSumbalanceRChg->save();
                }


                $saveOK = 1;
            }
        } 
        return response()->json(["usernameReferrer"=>$request->usernameReferrer,'saveOK'=>$saveOK]);
    }
}
