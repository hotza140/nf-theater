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
        $Packagewatch = Packagewatch::find($r->id); 
        $PackageSubwatch = PackageSubwatch::where('package_Code',$Packagewatch->package_Code)->get();
        if($r->id==1) return view('frontend.netflix-pricing',compact('Packagewatch','PackageSubwatch'));
        else if($r->id==2) return view('frontend.youtube-pricing',compact('Packagewatch','PackageSubwatch'));
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
}
