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
            $query->where('name', 'LIKE', '%' . $search . '%');
            $query->orwhere('email', 'LIKE', '%' . $search . '%');
            $query->orwhere('country', 'LIKE', '%' . $search . '%');
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
    $ch=Coupon::where('email',$r->email)->orderby('id','desc')->first();
    $nh=Coupon::where('name',$r->name)->orderby('id','desc')->first();

    if($ch!=null){
        return redirect()->back()->with('message','Email Already Have in Data!');
        }

        if($nh!=null){
            return redirect()->back()->with('message','Name Profile Already Have in Data!');
            }   

    $item->password=$r->password;

    $item->name=$r->name;
    $item->email=$r->email;
    $item->date_start=$r->date_start;
    $item->date_end=$r->date_end;
    $item->country=$r->country;

    $item->email01=$r->email01;
    $item->email02=$r->email02;

    $item->save();
    return redirect()->to('coupon_edit/'.$item->id)->with('message','Sucess!');

    }
    public function coupon_update(Request $r,$id){
    $item=Coupon::where('id',$id)->first();
    $ch=Coupon::where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();
    $nh=Coupon::where('id','!=',$id)->where('name',$r->name)->orderby('id','desc')->first();

    if($ch!=null){
        return redirect()->back()->with('message','Email Already Have in Data!');
        }

        if($nh!=null){
            return redirect()->back()->with('message','Name Profile Already Have in Data!');
            } 

        $item->password=$r->password;

    $item->name=$r->name;
    $item->email=$r->email;
    $item->date_start=$r->date_start;
    $item->date_end=$r->date_end;
    $item->country=$r->country;

    $item->email01=$r->email01;
    $item->email02=$r->email02;

    $item->save();
    return redirect()->to('coupon_edit/'.$id)->with('message','Sucess!');
    }
    public function coupon_edit($id){
    $item=Coupon::where('id',$id)->first();
dd($item);
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
