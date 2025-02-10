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
use App\Models\PackageSubwatch;

class PackageSubBackendController extends Controller
{
    // OPEN/CLOSE-------package.subpackage
    public function subpackage_open_close(Request $r)
    {
        $item = PackageSubwatch::where('id', $r->id)->first();

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


    //package.subpackage//
    public function subpackage(Request $r){
    $date=date('Y-m-d');

    $item=subPackageSubwatch::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = subPackageSubwatch::where(function ($query) use ($search, $status_account) {
            $query->where('subpackage_Name', 'LIKE', '%' . $search . '%');
            $query->orwhere('subpackage_Code', 'LIKE', '%' . $search . '%');
        });

        if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
        }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
        }
    }
    
    $item = $item->orderBy('id', 'desc')->paginate(10);
    return view('backend.package.subpackage.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"subpackage",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function subpackage_store(Request $r){
        $item=new PackageSubwatch();

        $runnum=DB::table('tb_package_subwatch')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "SPNF-{$xxxx}";

        $item->package_Code=@$r->package_Code??'';
        $item->Subpackage_Name=$r->Subpackage_Name;
        $item->Subpackage_Code=$run;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->save();
        return redirect()->to('package_edit/'.$r->package_id)->with('message','Sucess!');

    }

    public function subpackage_update(Request $r,$id){
    $package_Code = @$r->package_Code??'';
    $package_id = @$r->package_id??'';
    $item=PackageSubwatch::where('id',$id)->first();

    $item->Subpackage_Name=$r->Subpackage_Name;
    $item->Subpackage_Code=$r->Subpackage_Code;
    $item->date_start=$r->date_start;
    $item->date_end=$r->date_end;

    $item->save();
    return redirect()->to('package_edit/'.$package_id)->with('message','Sucess!');
    }
    public function subpackage_edit($id,Request $r){
    $package_Code = @$r->package_Code??'';
    $package_id = @$r->package_id??'';
    $item=PackageSubwatch::where('id',$id)->first();

    return view('backend.package.subpackage.edit',[
        'package_Code'=>$package_Code,
        'package_id'=>$package_id,
        'item'=>$item,
        'page'=>"admin",
        'list'=>"subpackage",
    ]);
    }
    public function subpackage_destroy($id){
    $item=PackageSubwatch::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function subpackage_add(Request $r){
        $package_Code = @$r->package_Code??'';
        $package_id = @$r->package_id??'';
    return view('backend.package.subpackage.add',[
        'package_Code'=>$package_Code,
        'package_id'=>$package_id,
        'page'=>"admin",
        'list'=>"subpackage",
    ]);
    }
    //package.subpackage//
}
