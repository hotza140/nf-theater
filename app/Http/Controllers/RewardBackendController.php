<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Mail\Coupon_Code;
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
use App\Models\Reward;
use App\Models\RewardUserLog;

class RewardBackendController extends Controller
{
    // OPEN/CLOSE-------reward
    public function reward_open_close(Request $r)
    {
        $item = Reward::where('id', $r->id)->first();

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


    //reward//
    public function reward(Request $r){
        $date=date('Y-m-d');

        $item=Reward::select('*');
        $search = $r->search;
        $status_account = $r->status_account;
        if (!empty($search) or !empty($status_account) ) {
            $item = Reward::where(function ($query) use ($search, $status_account) {
                $query->where('reward_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('reward_Code', 'LIKE', '%' . $search . '%');
            });

            if ($status_account == '0') {
                $item = $item->where('date_end','>=',$date);
            }elseif($status_account == '1'){
                $item = $item->where('date_end','<',$date);
            }
        }
        
        $item = $item->orderBy('package_Code', 'asc')->cursor();
        return view('backend.reward.index',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"reward",

            'search'=>$search,
            'status_account'=>$status_account,
        ]);
    }
    public function reward_store(Request $r){
        $item=new Reward();

        $runnum=DB::table('tb_reward')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "RNF-{$xxxx}";

        $item->reward_Name=$r->reward_Name;
        $item->reward_Code=$run;
        $item->reward_Day=$r->reward_Day;
        // $item->reward_giftName=$r->reward_giftName;
        $item->reward_Score=$r->reward_Score;
        $item->package_Code=$r->package_Code;
        $item->save();
        return redirect()->to('reward_edit/'.$item->id)->with('message','Sucess!');

    }

    public function reward_update(Request $r,$id){
    $item=Reward::where('id',$id)->first();

    $item->reward_Name=$r->reward_Name;
    $item->reward_Code=$r->reward_Code;
    $item->reward_Day=$r->reward_Day;
    // $item->reward_giftName=$r->reward_giftName;
    $item->reward_Score=$r->reward_Score;
    $item->package_Code=$r->package_Code;
    $item->save();
    return redirect()->to('reward_edit/'.$id)->with('message','Sucess!');
    }
    public function reward_edit($id){
    $item=Reward::where('id',$id)->first();

    return view('backend.reward.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"reward",
    ]);
    }
    public function reward_destroy($id){
    $item=Reward::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function reward_add(){
    return view('backend.reward.add',[
        'page'=>"admin",
        'list'=>"reward",
    ]);
    }
    //reward//

}
