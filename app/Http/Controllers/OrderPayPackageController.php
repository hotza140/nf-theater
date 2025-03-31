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
use App\Models\Marking;
use App\Models\OrderPayPackage;
use App\Models\PayPackNotmatch;
use App\Models\OrderPayPackageTruewallet;

class OrderPayPackageController extends Controller
{
    // OPEN/CLOSE-------orderpaypackage
    public function orderpaypackage_open_close(Request $r)
    {
        $item = OrderPayPackage::where('id', $r->id)->first();

        if($item!=null){
        if (@$item->OrderCheck==0) {
            $item->OrderCheck = 1;
            $item->save();
        }else{
        $item->OrderCheck = 0;
        $item->save();
        }

            return response()->json(['success' => true, 'OrderCheck' => $item->OrderCheck]);
        }

        return response()->json(['success' => false]);
    }


    //orderpaypackage//
    public function orderpaypackage(Request $r){
        $date=date('Y-m-d');

        $item=OrderPayPackage::select('*');
        $search = $r->search;
        $status_account = $r->status_account;
        if (!empty($search) or !empty($status_account) ) {
            $item = OrderPayPackage::where(function ($query) use ($search, $status_account) {
                $query->where('username', 'LIKE', '%' . $search . '%');
                $query->orwhere('package_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('Subpackage_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('RefPayment', 'LIKE', '%' . $search . '%');
            });

            if ($status_account == '0') {
                $item = $item->where('date_end','>=',$date);
            }elseif($status_account == '1'){
                $item = $item->where('date_end','<',$date);
            }
        }
        
        $item = $item->orderBy('Subpackage_Name', 'asc')->paginate(10);
        return view('backend.orderpaypackage.index',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"orderpaypackage",

            'search'=>$search,
            'status_account'=>$status_account,
        ]);
    }
    //paypacknotmatch//
    public function paypacknotmatch(Request $r){
        $date=date('Y-m-d');
    
        $item=PayPackNotmatch::select('*');
        $search = $r->search;
        $status_account = $r->status_account;
        if (!empty($search) or !empty($status_account) ) {
            $item = PayPackNotmatch::where(function ($query) use ($search, $status_account) {
                $query->where('username', 'LIKE', '%' . $search . '%');
                $query->orwhere('package_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('Subpackage_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('RefPayment', 'LIKE', '%' . $search . '%');
            });
    
            if ($status_account == '0') {
                $item = $item->where('date_end','>=',$date);
            }elseif($status_account == '1'){
                $item = $item->where('date_end','<',$date);
            }
        }
        
        $item = $item->orderBy('OrderCheck','asc','Subpackage_Name', 'asc')->paginate(10);
        return view('backend.orderpaypackage.indexNotMatch',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"orderpaypackage",
    
            'search'=>$search,
            'status_account'=>$status_account,
        ]);
    }
    //OrderPayPackageTruewallet//
    public function paypackbytruewallet(Request $r){
        $date=date('Y-m-d');
    
        $item=OrderPayPackageTruewallet::select('*');
        $search = $r->search;
        $status_account = $r->status_account;
        if (!empty($search) or !empty($status_account) ) {
            $item = OrderPayPackageTruewallet::where(function ($query) use ($search, $status_account) {
                $query->where('username', 'LIKE', '%' . $search . '%');
                $query->orwhere('package_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('Subpackage_Name', 'LIKE', '%' . $search . '%');
                // $query->orwhere('RefPayment', 'LIKE', '%' . $search . '%');
            });
    
            if ($status_account == '0') {
                $item = $item->where('date_end','>=',$date);
            }elseif($status_account == '1'){
                $item = $item->where('date_end','<',$date);
            }
        }
        
        $item = $item->orderBy('OrderCheck','asc','Subpackage_Name', 'asc')->paginate(10);
        return view('backend.orderpaypackage.indexTrueWalletPay',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"orderpaypackage",
    
            'search'=>$search,
            'status_account'=>$status_account,
        ]);
    }

    public function orderpaypackage_store(Request $r){
        $item=new OrderPayPackage();

        $runnum=DB::table('tb_orderpaypackage')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "MKNF-{$xxxx}";

        $item->package_Name=$r->package_Name;
        $item->orderpaypackage_Code=$run;
        $item->orderpaypackage_Payment=$r->orderpaypackage_Payment;
        $item->orderpaypackage_Score=$r->orderpaypackage_Score;
        $item->orderpaypackage_Score=$r->orderpaypackage_Score;
        $item->save();
        return redirect()->to('orderpaypackage_edit/'.$item->id)->with('message','Sucess!');

    }

    public function orderpaypackage_update(Request $r,$id){
    $item=OrderPayPackage::where('id',$id)->first();

    $item->package_Name=$r->package_Name;
    $item->orderpaypackage_Code=$r->orderpaypackage_Code;
    $item->orderpaypackage_Payment=$r->orderpaypackage_Payment;
    $item->orderpaypackage_Score=$r->orderpaypackage_Score;
    $item->orderpaypackage_Score=$r->orderpaypackage_Score;
    $item->save();
    return redirect()->to('orderpaypackage_edit/'.$id)->with('message','Sucess!');
    }
    public function orderpaypackage_edit($id){
    $item=OrderPayPackage::where('id',$id)->first();

    return view('backend.orderpaypackage.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"orderpaypackage",
    ]);
    }
    public function orderpaypackage_destroy($id){
    $item=OrderPayPackage::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function orderpaypackage_add(){
    return view('backend.orderpaypackage.add',[
        'page'=>"admin",
        'list'=>"orderpaypackage",
    ]);
    }
    //orderpaypackage//
}
