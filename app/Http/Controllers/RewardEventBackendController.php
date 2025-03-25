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
use App\Models\RewardEvent;

class RewardEventBackendController extends Controller
{
    // OPEN/CLOSE-------reward
    public function rewardevent_open_close(Request $r)
    {
        $item = RewardEvent::where('id', $r->id)->first();

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


    //rewardevent//
    public function rewardevent(Request $r){
    $date=date('Y-m-d');

    $item=RewardEvent::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = RewardEvent::where(function ($query) use ($search, $status_account) {
            $query->where('username_reward', 'LIKE', '%' . $search . '%');
        });

        // if ($status_account == '0') {
        //     $item = $item->where('date_end','>=',$date);
        // }elseif($status_account == '1'){
        //     $item = $item->where('date_end','<',$date);
        // }
    }
    
    $item = $item->orderBy('id', 'desc')->cursor();
    return view('backend.rewardevent.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"rewardevent",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function rewardevent_store(Request $r){
        $item=new RewardEvent();

        $runnum=DB::table('tb_reward_event')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "EVR-{$xxxx}";

        $item->rewardevent_Code=$run;
        $item->username_reward=$r->username_reward;
        $item->reward_what=$r->reward_what;
        $item->reward_start=$r->reward_start;
        $item->reward_stop=$r->reward_stop;
        $item->reward_event_status=$r->reward_event_status;
        $item->save();
        return redirect()->to('rewardevent_edit/'.$item->id)->with('message','Sucess!');

    }

    public function rewardevent_update(Request $r,$id){
    $item=RewardEvent::where('id',$id)->first();

    $item->reward_what=$r->reward_what;
    $item->reward_start=$r->reward_start;
    $item->reward_stop=$r->reward_stop;
    $item->reward_event_status=$r->reward_event_status;
    $item->save();
    return redirect()->to('rewardevent_edit/'.$id)->with('message','Sucess!');
    }
    public function rewardevent_edit($id){
    $item=RewardEvent::where('id',$id)->first();

    return view('backend.rewardevent.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"rewardevent",
    ]);
    }
    public function rewardevent_destroy($id){
    $item=RewardEvent::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function rewardevent_add(){
    return view('backend.rewardevent.add',[
        'page'=>"admin",
        'list'=>"rewardevent",
    ]);
    }
    //rewardevent//

}
