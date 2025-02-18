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
use App\Models\Coupon;

class CouponBackendController extends Controller
{
    // OPEN/CLOSE-------coupon
    public function coupon_open_close(Request $r)
    {
        $item = Coupon::where('id', $r->id)->first();

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


    //Coupon//
    public function coupon(Request $r){
    $date=date('Y-m-d');

    $item=Coupon::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = Coupon::where(function ($query) use ($search, $status_account) {
            $query->where('Coupon_Name', 'LIKE', '%' . $search . '%');
            $query->orwhere('Coupon_Code', 'LIKE', '%' . $search . '%');
        });

        if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
        }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
        }
    }
    
    $item = $item->orderBy('id', 'desc')->paginate(10);
    return view('backend.coupon.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"coupon",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function coupon_store(Request $r){
        $item=new Coupon();

        $runnum=DB::table('tb_coupon')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "CNF-{$xxxx}";

        $item->Coupon_Name=$r->Coupon_Name;
        $item->Coupon_Code=$run;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->type=$r->type;
        $item->conditional=$r->conditional;
        $item->save();
        return redirect()->to('coupon_edit/'.$item->id)->with('message','Sucess!');

    }

    public function coupon_update(Request $r,$id){
    $item=Coupon::where('id',$id)->first();

    $item->Coupon_Name=$r->Coupon_Name;
    $item->Coupon_Code=$r->Coupon_Code;
    $item->date_start=$r->date_start;
    $item->date_end=$r->date_end;
    $item->type=$r->type;
    $item->conditional=$r->conditional;

    $item->save();
    return redirect()->to('coupon_edit/'.$id)->with('message','Sucess!');
    }
    public function coupon_edit($id){
    $item=Coupon::where('id',$id)->first();

    return view('backend.coupon.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"coupon",
    ]);
    }
    public function coupon_destroy($id){
    $item=Coupon::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function coupon_add(){
    return view('backend.coupon.add',[
        'page'=>"admin",
        'list'=>"coupon",
    ]);
    }
    //coupon//
}
