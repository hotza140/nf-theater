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
        return view('frontend.profile',compact('users','RewardUserLog'));
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
        $OrderPayPackage = new OrderPayPackage();
        $OrderPayPackage->OrderPayCode =$run;
        $OrderPayPackage->username =$userIs->username;
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

        // Get the uploaded file
        $file = $request->file('qr_code_image');

        if ( $file && $file->isValid()) { // $file && $file->isValid() && 0

            // Prepare the cURL request body with the file
            $body = [
                'log' => true,
                'files' => new \CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
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
            }

            // Return the status
            return response()->json(['statis'=>$statis],$statusCode);
        } else {
            // File upload failed or is not valid
            return response()->json(['error' => 'No valid file uploaded'], 400);
        }
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
        $filerd = \Storage::disk('frongdrv')->get('Frongdrv/'.$request->img);
        $base64 = base64_encode($filerd);

        // If you need to include the MIME type (for displaying in an `img` tag)
        $mime = \Storage::disk('frongdrv')->mimeType('Frongdrv/'.$request->img);
        $base64WithMime = 'data:' . $mime . ';base64,' . $base64;

        return response()->json(["img"=>$base64WithMime],200); // Output Base64 image string
    }
}
