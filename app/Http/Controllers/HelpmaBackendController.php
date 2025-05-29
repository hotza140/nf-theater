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
use App\Models\Helpma;

class HelpmaBackendController extends Controller
{
    // OPEN/CLOSE-------helpma
    public function helpma_open_close(Request $r)
    {
        $item = Helpma::where('id', $r->id)->first();

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


    //helpma//
    public function helpma(Request $r){
    $date=date('Y-m-d');

    $item=Helpma::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = Helpma::where(function ($query) use ($search, $status_account) {
            $query->where('helpma_Name', 'LIKE', '%' . $search . '%');
            $query->orwhere('helpma_Code', 'LIKE', '%' . $search . '%');
        });

        if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
        }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
        }
    }
    
    $item = $item->orderBy('type_no', 'asc')->paginate(10);
    return view('backend.helpma.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"helpma",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function helpma_store(Request $r){
        $item=new helpma();

        $runnum=DB::table('tb_helpma')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "HpNF-{$xxxx}";

        if($r->picture!=null){
            $uploadedFile=$r->picture;
            $fileName = $uploadedFile->getClientOriginalName();
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // , 'pdf', 'doc', 'docx', 'xls', 'xlsx'
            if (in_array($fileExtension, $allowedExtensions)) {
                $path =public_path().'/img/upload/helpma/'.$item->picture;
                if(File::exists($path)){
                    File::delete($path);
                }
                $picture = $_FILES['picture']['name'];
                $picture = date('YmdHis').'_'.$picture;
                $r->picture->move(public_path() . '/img/upload/helpma', $picture);
                $item->picture = $picture;
            }
        }

        $item->helpma_Name=$r->helpma_Name;
        $item->helpma_Code=$run;
        $item->type_no=$runtotal;
        $item->save();
        return redirect()->to('helpma_edit/'.$item->id)->with('message','Sucess!');

    }

    public function helpma_update(Request $r,$id){
    $item=Helpma::where('id',$id)->first();

    if($r->picture!=null){
        $uploadedFile=$r->picture;
        $fileName = $uploadedFile->getClientOriginalName();
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // , 'pdf', 'doc', 'docx', 'xls', 'xlsx'
        if (in_array($fileExtension, $allowedExtensions)) {
            $path =public_path().'/img/upload/helpma/'.$item->picture;
            if(File::exists($path)){
                File::delete($path);
            }
            $picture = $_FILES['picture']['name'];
            $picture = date('YmdHis').'_'.$picture;
            $r->picture->move(public_path() . '/img/upload/helpma', $picture);
            $item->picture = $picture;
        }
    }

    $item->helpma_Name=$r->helpma_Name;
    $item->helpma_Code=$r->helpma_Code;
    $item->type_no=$r->type_no;

    $item->save();
    return redirect()->to('helpma_edit/'.$id)->with('message','Sucess!');
    }
    public function helpma_edit($id){
    $item=Helpma::where('id',$id)->first();

    return view('backend.helpma.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"helpma",
    ]);
    }
    public function helpma_destroy($id){
    $item=Helpma::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function helpma_add(){
    return view('backend.helpma.add',[
        'page'=>"admin",
        'list'=>"helpma",
    ]);
    }
    //helpma//
}
