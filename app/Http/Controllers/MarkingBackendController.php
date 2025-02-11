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

class MarkingBackendController extends Controller
{
    // OPEN/CLOSE-------marking
    public function marking_open_close(Request $r)
    {
        $item = Marking::where('id', $r->id)->first();

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


    //marking//
    public function marking(Request $r){
    $date=date('Y-m-d');

    $item=Marking::select('*');
    $search = $r->search;
    $status_account = $r->status_account;
    if (!empty($search) or !empty($status_account) ) {
        $item = Marking::where(function ($query) use ($search, $status_account) {
            $query->where('Marking_Name', 'LIKE', '%' . $search . '%');
            $query->orwhere('Marking_Payment', 'LIKE', '%' . $search . '%');
        });

        if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
        }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
        }
    }
    
    $item = $item->orderBy('Marking_Payment', 'asc')->paginate(10);
    return view('backend.marking.index',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"marking",

        'search'=>$search,
        'status_account'=>$status_account,
    ]);
    }
    public function marking_store(Request $r){
        $item=new Marking();

        $runnum=DB::table('tb_marking')->orderby('id','desc')->count();
        $runtotal=$runnum+1;
        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
        $run = "MKNF-{$xxxx}";

        $item->Marking_Name=$r->Marking_Name;
        $item->Marking_Code=$run;
        $item->Marking_Payment=$r->Marking_Payment;
        $item->Marking_Score=$r->Marking_Score;
        $item->Marking_Score=$r->Marking_Score;
        $item->save();
        return redirect()->to('marking_edit/'.$item->id)->with('message','Sucess!');

    }

    public function marking_update(Request $r,$id){
    $item=Marking::where('id',$id)->first();

    $item->Marking_Name=$r->Marking_Name;
    $item->Marking_Code=$r->Marking_Code;
    $item->Marking_Payment=$r->Marking_Payment;
    $item->Marking_Score=$r->Marking_Score;
    $item->Marking_Score=$r->Marking_Score;
    $item->save();
    return redirect()->to('marking_edit/'.$id)->with('message','Sucess!');
    }
    public function marking_edit($id){
    $item=Marking::where('id',$id)->first();

    return view('backend.marking.edit',[
        'item'=>$item,
        'page'=>"admin",
        'list'=>"marking",
    ]);
    }
    public function marking_destroy($id){
    $item=Marking::where('id',$id)->first();
    $item->delete();
    return redirect()->back()->with('message','Sucess!');
    }
    public function marking_add(){
    return view('backend.marking.add',[
        'page'=>"admin",
        'list'=>"marking",
    ]);
    }
    //marking//
}
