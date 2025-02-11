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

class UserFrontendController extends Controller
{
    ///login---------------
   public function login(){
    return view('frontend.login');
    }

//  ///LOGOUT---------------
//     public function logout(){
//         Auth::logout();
//         return redirect()->to('/login')->with('message','Sucess!');
//     }

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
        $users=users::where('email',$r->email)->first();
        if($users){
        if(Hash::check($r->password, $users->password)){
            // if($users->open==0){
                Auth::guard('users')->login($users);
                return redirect("/frontend");
            // }else{
            //     return redirect()->to('/login')->with('message','You User Are Close!');
            // }
        }else{
            return redirect()->to('/login')->with('message','Password Wrong!');
        }
        }else{
            return redirect()->to('/login')->with('message','Email Wrong!');
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
}
