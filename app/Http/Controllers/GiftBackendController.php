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
use App\Models\Gift;

class GiftBackendController extends Controller
{
    // OPEN/CLOSE-------gift
    public function gift_open_close(Request $r)
    {
        $item = Gift::where('id', $r->id)->first();

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


    //gift//
    public function gift(Request $r){
    $date=date('Y-m-d');

    $item=Gift::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = Gift::where(function ($query) use ($search, $status_account) {
            $query->where('gift_Name', 'LIKE', '%' . $search . '%');
            $query->orwhere('gift_Code', 'LIKE', '%' . $search . '%');
        });

        if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
        }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
        }
    }
    
    $item = $item->orderBy('id', 'desc')->paginate(10);
    return view('backend.gift.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"gift",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function gift_store(Request $r){
        $item=new Gift();

        $runnum=DB::table('tb_gift')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "GNF-{$xxxx}";

        if($r->picture!=null){
            $uploadedFile=$r->picture;
            $fileName = $uploadedFile->getClientOriginalName();
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $path =public_path().'/img/upload/'.$item->picture;
                if(File::exists($path)){
                    File::delete($path);
                }
                $picture = $_FILES['picture']['name'];
                $picture = date('YmdHis').'_'.$picture;
                $r->picture->move(public_path() . '/img/upload', $picture);
                $item->picture = $picture;
            }
        }

        $item->Gift_Name=$r->Gift_Name;
        $item->Gift_Code=$run;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->conditional=$r->conditional;
        $item->save();
        return redirect()->to('gift_edit/'.$item->id)->with('message','Sucess!');

    }

    public function gift_update(Request $r,$id){
    $item=Gift::where('id',$id)->first();

    if($r->picture!=null){
        $uploadedFile=$r->picture;
        $fileName = $uploadedFile->getClientOriginalName();
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $path =public_path().'/img/upload/'.$item->picture;
            if(File::exists($path)){
                File::delete($path);
            }
            $picture = $_FILES['picture']['name'];
            $picture = date('YmdHis').'_'.$picture;
            $r->picture->move(public_path() . '/img/upload', $picture);
            $item->picture = $picture;
        }
    }

    $item->Gift_Name=$r->Gift_Name;
    $item->Gift_Code=$r->Gift_Code;
    $item->date_start=$r->date_start;
    $item->date_end=$r->date_end;
    $item->conditional=$r->conditional;

    $item->save();
    return redirect()->to('gift_edit/'.$id)->with('message','Sucess!');
    }
    public function gift_edit($id){
    $item=Gift::where('id',$id)->first();

    return view('backend.gift.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"gift",
    ]);
    }
    public function gift_destroy($id){
    $item=Gift::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function gift_add(){
    return view('backend.gift.add',[
        'page'=>"admin",
        'list'=>"gift",
    ]);
    }
    //gift//
}
