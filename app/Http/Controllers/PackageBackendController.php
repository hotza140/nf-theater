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
use App\Models\Packagewatch;
use App\Models\PackageSubwatch;
use App\Models\DefaultConfig;

class PackageBackendController extends Controller
{
    // OPEN/CLOSE-------package
    public function package_open_close(Request $r)
    {
        $item = Packagewatch::where('id', $r->id)->first();

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


    //package//
    public function package(Request $r){
    $date=date('Y-m-d');

    $item=Packagewatch::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = Packagewatch::where(function ($query) use ($search, $status_account) {
            $query->where('package_Name', 'LIKE', '%' . $search . '%');
            $query->orwhere('package_Code', 'LIKE', '%' . $search . '%');
        });

        if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
        }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
        }
    }
    
    $item = $item->orderBy('id', 'desc')->paginate(10);
    return view('backend.package.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"package",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function package_store(Request $r){
        $item=new Packagewatch();

        $runnum=DB::table('tb_packagewatch')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "PNF-{$xxxx}";

        $item->package_Name=$r->package_Name;
        $item->package_Code=$run;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->save();
        return redirect()->to('package_edit/'.$item->id)->with('message','Sucess!');

    }

    public function package_update(Request $r,$id){
    $item=Packagewatch::where('id',$id)->first();

    $item->package_Name=$r->package_Name;
    // $item->package_Code=$r->package_Code;
    // $item->date_start=$r->date_start;
    // $item->date_end=$r->date_end;

    $item->save();
    return redirect()->to('package_edit/'.$id)->with('message','Sucess!');
    }
    public function package_edit($id,Request $r){
        $item=Packagewatch::where('id',$id)->first();
        $itempk=PackageSubwatch::select('*')->where('package_Code',$item->package_Code);

        $date=date('Y-m-d');

        $search = $r->search;
        $status_account = $r->status_account;
        if (!empty($search) or !empty($status_account) ) {
            $itempk = PackageSubwatch::where(function ($query) use ($search, $status_account) {
                $query->where('Subpackage_Name', 'LIKE', '%' . $search . '%');
                $query->orwhere('Subpackage_Code', 'LIKE', '%' . $search . '%');
            });

            if ($status_account == '0') {
                $itempk = $itempk->where('date_end','>=',$date);
            }elseif($status_account == '1'){
                $itempk = $itempk->where('date_end','<',$date);
            }
        }
        $itempk = $itempk->paginate(10);
        
        return view('backend.package.edit',[
            'item'=>$item,
            'itempk'=>$itempk,
            'page'=>"admin",
            'list'=>"package",
        ]);
    }
    public function package_destroy($id){
    $item=Packagewatch::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function package_add(){
    return view('backend.package.add',[
        'page'=>"admin",
        'list'=>"package",
    ]);
    }
    //package//

    public function updateDefault(Request $request) {
        $DefaultConfig = DefaultConfig::find(1);
        // $DefaultConfig->referrer_point = $request->referrer_point;
        // $DefaultConfig->save();
        $saveData = $request->all();
        $DefaultConfig->update($saveData);
        return redirect()->to('package')->with('message','Sucess!');
    }
}
