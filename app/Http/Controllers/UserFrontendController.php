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
        $users=users::where('username',$r->username)->first();
        if($users){
            if($r->password==$users->password){ // ||Hash::check($r->password, $users->password)
                Auth::guard('users')->login($users); 
                return redirect("/profile");
            }else{
                return redirect()->to('/frontlogin')->with('message','Password Wrong!');
            }
        }else{
            return redirect()->to('/frontlogin')->with('message','Username Wrong!');
        }
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
        $users = Auth::guard('users')->user();
        $RewardUserLog = RewardUserLog::where('username',$users->username)->get();
        $userProfile = users::select(
                'tb_users.username',
                'tb_users.password as userpass',
                'tb_users.type_netflix',
                'tb_users.type_youtube',
                'tb_users_in_in.type',
                'tb_users_in_in.type_mail',
                'tb_users_in.*'
            )
            ->leftJoin('tb_users_in_in', 'tb_users.id', '=', 'tb_users_in_in.id_user')
            ->leftJoin('tb_users_in', 'tb_users_in_in.id_user_in', '=', 'tb_users_in.id')
            ->where('tb_users.username', $users->username)
            ->get();

            // $userData=users::where('id',$users->id)->first();
            // $aaa=users_in_in::where('id_user',$userData->id)->first();
            // $bbb=users_in::where('id',$aaa->id_user_in)->first();
            // dd($userData,$aaa,$bbb);
            // dd($userProfile);
        $checknetFlix = users::where('type_netflix',1)->where('username',$users->username)->first();
        $checkyouTube = users::where('type_youtube',1)->where('username',$users->username)->first();
        return view('frontend.profile',compact('users','RewardUserLog','userProfile','checknetFlix','checkyouTube'));
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

         ///ส่วนเพิ่มวัน auto
         $account = users_in_in::where('id_user', $userIs->id)->orderBy('id','desc')->first();
         $uu = users::where('id', $userIs->id)->first();
         if(@$account!=null){
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
         }else{
            $pack_id=DB::table('tb_package_subwatch')->where('Subpackage_Name',$request->Subpackage_Name)->first();
            $new_date_end = date('Y-m-d', strtotime(date('Y-m-d') . ' + ' . $pack_id->Subpackage_Dayuse . ' days'));
            $dates=date('Y-m-d');

            if($pack_id->type=='MOBILE'){
                $user = (new users_in())->getEligibleUser();
                if (@$user!=null) {
                    $aaa=new users_in_in();
                    $aaa->id_user=$uu->id;  
                    $aaa->id_user_in=$user->id;    
                    $aaa->type='MOBILE';
        
                    $aaa->date_start=$dates; 
                    $aaa->date_end=$new_date_end; 
                    $aaa->save();
        
                    $aaa_his=new users_in_in_history();
                    $aaa_his->id_user=$uu->id;  
                    $aaa_his->id_user_in=$user->id;    
                    $aaa_his->type='MOBILE';
        
                    $aaa_his->date_start=$dates; 
                    $aaa_his->date_end=$new_date_end;
                    $aaa_his->save();
        
                    $uu->date_start=$dates;
                    $uu->date_end=$new_date_end;
                    $uu->package=@$pack_id->Subpackage_Name;
                    $uu->id_package=@$pack_id->id;
                    $uu->type=@$pack_id->type;
                    $uu->save();
        
                }else{
                    $alert = new alert();
                    $alert->text='ไม่มี Account ที่ว่าง';
                    $alert->id_user=$userIs->id;
                    $alert->save();

                    $uu->status_account = 1;
                    $uu->save();
                }
                }else{
                    $user = (new users_in())->getEligibleUser_pc();
                if ($user !== null) {
                    // นับจำนวน users_in_in ที่มีอยู่แล้ว
                    $countExisting = users_in_in::where('id_user_in', $user->id)->count();
        
                    // คำนวณค่า type_mail (1 หรือ 2)
                    $newTypeMail = ($countExisting % 2) + 1;
        
                    $aaa = new users_in_in();
                    $aaa->id_user = $uu->id;  
                    $aaa->id_user_in = $user->id;    
                    $aaa->type = 'PC';
                    $aaa->type_mail = $newTypeMail;
                    $aaa->date_start = $dates; 
                    $aaa->date_end = $new_date_end; 
                    $aaa->save();
        
                    // บันทึกลงประวัติ
                    $aaa_his = new users_in_in_history();
                    $aaa_his->id_user = $uu->id;  
                    $aaa_his->id_user_in = $user->id;    
                    $aaa_his->type = 'PC';
                    $aaa_his->type_mail = $newTypeMail;
                    $aaa_his->date_start = $dates; 
                    $aaa_his->date_end = $new_date_end;
                    $aaa_his->save();

                    $uu->date_start=$dates;
                    $uu->date_end=$new_date_end;
                    $uu->package=@$pack_id->Subpackage_Name;
                    $uu->id_package=@$pack_id->id;
                    $uu->type=@$pack_id->type;
                    $uu->save();
                } else {
                    $alert = new alert();
                    $alert->text='ไม่มี Account ที่ว่าง';
                    $alert->id_user=$userIs->id;
                    $alert->save();

                    $item->status_account = 1;
                    $item->save();
                }
                }
         }
         ///ส่วนเพิ่มวัน auto

    }



    public function afterSaveOrderPackage (Request $request) {
        $id = $request->id;
        return redirect()->route($id==1?'frontend.netflix':'frontend.youtube',['id'=>$id])->with('message','Sucess!');
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
            $PayPackNotmatch->imgSlip = $filename;
            
            $PayPackNotmatch->save();

            // Save Slip in frongdrv storage.....
            \Storage::disk('frongdrv')->put('Frongdrv/Err/'.$filename, file_get_contents($request->file('qr_code_image')));
        }
        
        $id = $request->id;
        
        // return redirect()->route($id==1?'frontend.netflix':'frontend.youtube',['id'=>$id])->with('message','Sucess!');
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
}
