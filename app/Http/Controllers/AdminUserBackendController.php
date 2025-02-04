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

class AdminUserBackendController extends Controller
{


     ///login---------------
   public function login(){
    return view('auth.login');
    }

 ///LOGOUT---------------
    public function logout(){
        Auth::logout();
        return redirect()->to('/login')->with('message','Sucess!');
    }

     ///register---------------
   public function register(){
    abort(404);
    exit; // หยุดการทำงานที่เหลือ
        return view('auth.register');
    }

     ///verify---------------
    public function verify(){
        abort(404);
        exit; // หยุดการทำงานที่เหลือ
        return view('auth.verify');
    }



 ///Backend Login---------------
    public function login_backend(Request $r)
    {
        $admin=admin::where('email',$r->email)->first();
        if($admin){
        if(Hash::check($r->password, $admin->password)){
            if($admin->open==0){
                Auth::guard('admin')->login($admin);
                return redirect("/backend");
            }else{
                return redirect()->to('/login')->with('message','You User Are Close!');
            }
        }else{
            return redirect()->to('/login')->with('message','Password Wrong!');
        }
        }else{
            return redirect()->to('/login')->with('message','Email Wrong!');
        }
    }


     // OPEN/CLOSE-------admin
     public function admin_open_close(Request $r)
     {
         $item = admin::where('id', $r->id)->first();
     
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


     //admin//
     public function admin(){
        $item=admin ::orderby('id','desc')->cursor();
        return view('backend.admin.index',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"admin",
        ]);
    }
    public function admin_store(Request $r){
        if(Auth::guard('admin')->user()->type != 0){
            return redirect()->to('/backend')->with('message','You NOT Super Admin!');
        }
        $item=new admin();
        $ch=admin::where('email',$r->email)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
            }

        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=$r->type;
        $item->name=$r->name;
        $item->email=$r->email;

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

        $item->save();
        return redirect()->to('admin')->with('message','Sucess!');

    }
    public function admin_update(Request $r,$id){
        if(Auth::guard('admin')->user()->type != 0){
            return redirect()->to('/backend')->with('message','You NOT Super Admin!');
        }
        $item=admin::where('id',$id)->first();
        $ch=admin::where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
            }

        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=$r->type;
        $item->name=$r->name;
        $item->email=$r->email;

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

        $item->save();
        return redirect()->to('admin_edit/'.$id)->with('message','Sucess!');
    }
    public function admin_edit($id){
        $item=admin::where('id',$id)->first();
        return view('backend.admin.edit',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"admin",
        ]);
    }
    public function admin_destroy($id){
        $item=admin::where('id',$id)->first();
        // $path =public_path().'/img/upload/'.$item->picture;
        // if(File::exists($path)){
        // File::delete($path);
        // }
        $item->delete();
        return redirect()->back()->with('message','Sucess!');
    }
    public function admin_add(){
        return view('backend.admin.add',[
            'page'=>"admin",
            'list'=>"admin",
        ]);
    }
    //admin//




     // OPEN/CLOSE-------users
     public function users_open_close(Request $r)
     {
         $item = users::where('id', $r->id)->first();
     
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


     //User//
     public function users(Request $r){
         // ลบเช็คเวลา
         $date=date('Y-m-d');
         $users = users::whereDate('date_end', '<', $date)->pluck('id')->toArray();
         $accounts=users_in_in::whereIn('id_user',@$users)->delete();
         $users_update = users::whereDate('date_end', '<', $date)->update(['status_account' => 2]);
         // ลบเช็คเวลา


        $item=users ::orderby('id','desc')->paginate(10);

        $search = $r->search;
        $status_account = $r->status_account;
        if (!empty($search) or !empty($status_account)) {
            $item = users::where(function ($query) use ($search, $status_account) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('username', 'LIKE', '%' . $search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search . '%')
                      ->orWhere('line', 'LIKE', '%' . $search . '%');
            });
        
            if ($status_account != null and $status_account != '999') {
                $item = $item->where('status_account', $status_account);
            }
        
            $item = $item->orderBy('id', 'desc')->paginate(10);
        }

        return view('backend.users.index',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"users",

            'search'=>$search,
            'status_account'=>$status_account,
        ]);
    }
    public function users_store(Request $r){
        $item=new users();
        // $ca=users::where('username',$r->username)->orderby('id','desc')->first();

        // if($ca!=null){
        //         return redirect()->back()->with('message','Username Already Have in Data!');
        //     }

        // if($r->password!=null){
        //     $item->password=Hash::make($r->password);
        // }

        $item->password=$r->password;

        $item->username=$r->username;
        $item->name=$r->name;
        $item->email=$r->email;
        $item->link_line=$r->link_line;
        $item->line=$r->line;
        $item->phone=$r->phone;
        $item->code=$r->code;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->type=$r->type;

        // $caa=users::where('username',$r->username)->orderby('id','desc')->first();
        // if($caa!=null){
        //     return redirect()->back()->with('message','Username Already Have in Data!');
        // }

        if($item->save()){
        $user = (new users_in())->getEligibleUser();

        if (@$user!=null) {
            $aaa=new users_in_in();
            $aaa->id_user=$item->id;  
            $aaa->id_user_in=$user->id;    
            $aaa->type=$item->type;
            $aaa->save();

            $aaa_his=new users_in_in_history();
            $aaa_his->id_user=$item->id;  
            $aaa_his->id_user_in=$user->id;    
            $aaa_his->type=$item->type;
            $aaa_his->save();

        }else{
            $item->status_account=1;
            $item->save();
            return redirect()->to('users_edit/'.$item->id)->with('message','สร้างสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
        }

        }
        return redirect()->to('users_edit/'.$item->id)->with('message','Sucess!');

    }
    public function users_update(Request $r,$id){
        $item=users::where('id',$id)->first();
        // $ca=users::where('id','!=',$id)->where('username',$r->username)->orderby('id','desc')->first();
        // if($ca!=null){
        //         return redirect()->back()->with('message','Username Already Have in Data!');
        //     }

        // if($r->password!=null){
        //     $item->password=Hash::make($r->password);
        // }

        $item->password=$r->password;

        $item->username=$r->username;
        $item->name=$r->name;
        $item->email=$r->email;
        $item->line=$r->line;
        $item->link_line=$r->link_line;
        $item->phone=$r->phone;
        $item->code=$r->code;
        // $item->date_start=$r->date_start;
        // $item->date_end=$r->date_end;
        $item->type=$r->type;

        // $caa=users::where('id','!=',$id)->where('username',$r->username)->orderby('id','desc')->first();
        // if($caa!=null){
        //     return redirect()->back()->with('message','Username Already Have in Data!');
        // }
        $item->save();
        return redirect()->to('users_edit/'.$id)->with('message','Sucess!');
    }

    public function users_update_date(Request $r){
        $item=users::where('id',$r->id)->first();
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        if($item->save()){
            $user = (new users_in())->getEligibleUser();
    
            if (@$user!=null) {
                 // ลบเช็คเวลา
                if($item!=null){
                    $accounts=users_in_in::where('id_user',@$r->id)->delete();
                }
                // ลบเช็คเวลา

                $aaa=new users_in_in();
                $aaa->id_user=$item->id;  
                $aaa->id_user_in=$user->id;    
                $aaa->type=$item->type;
                $aaa->save();
    
                $aaa_his=new users_in_in_history();
                $aaa_his->id_user=$item->id;  
                $aaa_his->id_user_in=$user->id;    
                $aaa_his->type=$item->type;
                $aaa_his->save();
    
            }else{
                $item->status_account=1;
                $item->save();
                return redirect()->to('users_edit/'.$item->id)->with('message','ต่ออายุสำเร็จ! แต่ไม่มี Account ที่ว่างให้ใส่ใน User นี้ กรุณาเพิ่ม User นี้เข้า Account แบบ Mannual');
            }
    
            }

        return redirect()->to('users_edit/'.$r->id)->with('message','Sucess!');
    }

    public function users_edit($id){
        $item=users::where('id',$id)->first();
        
        // ลบเช็คเวลา
        $date=date('Y-m-d');
        $users = users::where('id',$id)->whereDate('date_end', '<', $date)->first();
        if($users!=null){
            $accounts=users_in_in::where('id_user',@$id)->delete();
            $item->status_account=2;
            $item->save();
        }
        // ลบเช็คเวลา

        return view('backend.users.edit',[
            'item'=>$item,
            'page'=>"admin",
            'list'=>"users",
        ]);
    }
    public function users_destroy($id){
        $item=users::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('message','Sucess!');
    }
    public function users_add(){
        return view('backend.users.add',[
            'page'=>"admin",
            'list'=>"users",
        ]);
    }

    public function users_add_many(Request $r){
        if(@$r->number==null){
            abort(404);
        }
        return view('backend.users.add_many',[
            'page'=>"admin",
            'list'=>"users",

            'number'=>$r->number,
        ]);
    }

    public function users_store_many(Request $r){
        if (!isset($r->users) || !is_array($r->users)) {
            return redirect()->back()->with('error', 'ไม่มีข้อมูลที่ถูกต้อง');
        }
    
        foreach ($r->users as $userData) {
            $item = new users();
            $item->password = $userData['password'];
            $item->username = $userData['username'];
            $item->name = $userData['name'] ?? null;
            $item->email = $userData['email'] ?? null;
            $item->link_line = $userData['link_line'] ?? null;
            $item->line = $userData['line'] ?? null;
            $item->phone = $userData['phone'] ?? null;
            $item->code = $userData['code'] ?? null;
            $item->date_start = $userData['date_start'] ?? null;
            $item->date_end = $userData['date_end'] ?? null;
            $item->type = $userData['type'];
    
            if ($item->save()) {
                $user = (new users_in())->getEligibleUser();
    
                if ($user !== null) {
                    $aaa = new users_in_in();
                    $aaa->id_user = $item->id;
                    $aaa->id_user_in = $user->id;
                    $aaa->type = $item->type;
                    $aaa->save();
    
                    $aaa_his = new users_in_in_history();
                    $aaa_his->id_user = $item->id;
                    $aaa_his->id_user_in = $user->id;
                    $aaa_his->type = $item->type;
                    $aaa_his->save();
                } else {
                    $item->status_account = 1;
                    $item->save();
                }
            }
        }
    
        return redirect()->to('users_list')->with('message', 'สร้างผู้ใช้สำเร็จ!');
    }

    //users//




    public function users_store_form_in(Request $r){
        $item=new users();
        $ch=users::where('email',$r->email)->orderby('id','desc')->first();
        // $ca=users::where('username',$r->username)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('message','Email Already Have in Data!');
            }
            
            // elseif($ca!=null){
            //     return redirect()->back()->with('message','Username Already Have in Data!');
            // }

        $item->password=$r->password;

        $item->username=$r->username;
        $item->name=$r->name;
        $item->email=$r->email;
        $item->link_line=$r->link_line;
        $item->line=$r->line;
        $item->phone=$r->phone;
        $item->code=$r->code;
        $item->date_start=$r->date_start;
        $item->date_end=$r->date_end;
        $item->day=$r->day;
        $item->type=$r->type;

        // $caa=users::where('username',$r->username)->orderby('id','desc')->first();
        // if($caa!=null){
        //     return redirect()->back()->with('message','Username Already Have in Data!');
        // }

        $item->save();

        

        if($r->type_mail==null){
        $user_in_in_count=users_in_in::where('id_user_in',@$r->id_user_in)->count();
        if($user_in_in_count >= 5){
        $item->status_account=1;
        $item->save();
        return redirect()->back()->with('message','สร้างสำเร็จแต่นำเข้า Account นี้ไม่ได้เนื่องจาก จำนวนผู้ใช้งานครบแล้ว!');
        }else{
        $aaa=new users_in_in();
        $aaa->id_user=$item->id;  
        $aaa->id_user_in=$r->id_user_in;    
        $aaa->type=$item->type;
        $aaa->save();

        $aaa_his=new users_in_in_history();
        $aaa_his->id_user=$item->id;  
        $aaa_his->id_user_in=$r->id_user_in;    
        $aaa_his->type=$item->type;
        $aaa_his->save();

        return redirect()->back()->with('message','Sucess!');
        }

        }else{
            $user_in_in_count_PC=users_in_in::where('id_user_in',$r->id_user_in)->where('type','PC')->where('type_mail',$r->type_mail)->orderby('id','desc')->count();

            if($user_in_in_count_PC==0){
            $aaa=new users_in_in();
            $aaa->id_user=$item->id;  
            $aaa->id_user_in=$r->id_user_in;    
            $aaa->type='PC';
            $aaa->type_mail=$r->type_mail;
            $aaa->save();
    
            $aaa_his=new users_in_in_history();
            $aaa_his->id_user=$item->id;  
            $aaa_his->id_user_in=$r->id_user_in;    
            $aaa_his->type='PC';
            $aaa_his->type_mail=$r->type_mail;
            $aaa_his->save();
            return redirect()->back()->with('message','Sucess!');
            }else{
                return redirect()->back()->with('message','Fail มีคนใช้อีเมลนี้แล้ว!');
            }
        }

      

    }







       // OPEN/CLOSE-------users_in
       public function users_in_open_close(Request $r)
       {
           $item = users_in::where('id', $r->id)->first();
       
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
  
  
       //User_in//
       public function users_in(Request $r){
         // ลบเช็คเวลา
         $date=date('Y-m-d');
         $users = users::whereDate('date_end', '<', $date)->pluck('id')->toArray();
         $accounts=users_in_in::whereIn('id_user',@$users)->delete();
         $users_update = users::whereDate('date_end', '<', $date)->update(['status_account' => 2]);
         // ลบเช็คเวลา

          $item=users_in ::orderby('id','desc')->paginate(10);
          $search = $r->search;
          $status_account = $r->status_account;
          if (!empty($search) or !empty($status_account) ) {
           $item = users_in::where(function ($query) use ($search, $status_account) {
                  $query->where('name', 'LIKE', '%' . $search . '%');
                  $query->orwhere('email', 'LIKE', '%' . $search . '%');
                  $query->orwhere('country', 'LIKE', '%' . $search . '%');
          });

            if ($status_account == '0') {
            $item = $item->where('date_end','>=',$date);
            }elseif($status_account == '1'){
            $item = $item->where('date_end','<',$date);
            }
            $item = $item->orderBy('id', 'desc')->paginate(10);
          }

          return view('backend.users_in.index',[
              'item'=>$item,
              'page'=>"admin",
              'list'=>"users_in",

              'search'=>$search,
              'status_account'=>$status_account,
          ]);
      }
      public function users_in_store(Request $r){
          $item=new users_in();
          $ch=users_in::where('email',$r->email)->orderby('id','desc')->first();
          $nh=users_in::where('name',$r->name)->orderby('id','desc')->first();
  
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
          return redirect()->to('users_in_edit/'.$item->id)->with('message','Sucess!');
  
      }
      public function users_in_update(Request $r,$id){
          $item=users_in::where('id',$id)->first();
          $ch=users_in::where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();
          $nh=users_in::where('id','!=',$id)->where('name',$r->name)->orderby('id','desc')->first();
  
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
          return redirect()->to('users_in_edit/'.$id)->with('message','Sucess!');
      }
      public function users_in_edit($id){
          $item=users_in::where('id',$id)->first();

        // ลบเช็คเวลา
          $ch=users_in_in::where('id_user_in',@$id)->get();
          $date=date('Y-m-d');
          foreach($ch as $chs){
          $users = users::where('id',$chs->id_user)->whereDate('date_end', '<', $date)->first();
          if($users!=null){
              $accounts=users_in_in::where('id',$chs->id)->delete();
              $item->status_account=2;
              $item->save();
          }
         }
         // ลบเช็คเวลา

          return view('backend.users_in.edit',[
              'item'=>$item,
              'page'=>"admin",
              'list'=>"users_in",
          ]);
      }
      public function users_in_destroy($id){
          $item=users_in::where('id',$id)->first();
          $item->delete();
          return redirect()->back()->with('message','Sucess!');
      }
      public function users_in_add(){
          return view('backend.users_in.add',[
              'page'=>"admin",
              'list'=>"users_in",
          ]);
      }
      //users_in//










     //users_in_in//
      public function add_user_in_in(Request $r){
        // $ch=users_in_in::where('id_user',$r->id_user)->where('id_user_in',$r->id_user_in)->first();
  
        // if($ch!=null){
        //     return redirect()->back()->with('message','User Already Have in Data!');
        //     }

        $user_in_in_count_PC=users_in_in::where('id_user_in',$r->id_user_in)->where('type','PC')->where('type_mail',$r->type_mail)->orderby('id','desc')->count();

        if($user_in_in_count_PC!=null and $r->type_mail!=null){
            return redirect()->back()->with('message','Fail มีคนใช้อีเมลนี้แล้ว!');
        }

        $user=users::where('id',$r->id_user)->first();
        $item=new users_in_in();
        $item->id_user=$r->id_user;  
        $item->id_user_in=$r->id_user_in;  
        if($r->type_mail!=null){
        $item->type='PC';
        $item->type_mail=$r->type_mail;
        }else{
        $item->type=@$user->type;
        }
        // $item->type=$r->type;

        $user_in_in_count=users_in_in::where('id_user_in',@$item->id)->count();
        if($user_in_in_count >= 5){
        return redirect()->back()->with('message','จำนวนผู้ใช้งานครบแล้ว!');
        }else{
        $item->save();

        $item_his=new users_in_in_history();
        $item_his->id_user=$r->id_user;  
        $item_his->id_user_in=$r->id_user_in;    
        if($r->type_mail!=null){
            $item_his->type='PC';
            $item_his->type_mail=$r->type_mail;
            }else{
            $item_his->type=@$user->type;
            }

        // $item_his->type=$r->type;

        $item_his->save();
        }

       
        return redirect()->back()->with('message','Sucess!');

    }

    public function users_in_in_open_close(Request $r)
    {
        $item = users_in_in::where('id', $r->id)->first();
    
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

    public function users_in_in_destroy($id){
        $item=users_in_in::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('message','Sucess!');
    }
    //users_in_in//



    // Auto
    public function autoCreateUsersInIn(Request $r)
{
    $date = date('Y-m-d'); // วันที่ปัจจุบัน

    // ดึง users ที่ยังไม่หมดอายุและยังไม่ถูกเชื่อมกับ user_in_in
    $users = users::whereDoesntHave('users_in_in') // ยังไม่มีการเชื่อมกับ users_in_in
                ->where('open',0)
                ->whereDate('date_start', '<=', $date) // ยังไม่หมดอายุ (start <= ปัจจุบัน)
                ->whereDate('date_end', '>=', $date) // ยังไม่หมดอายุ (end >= ปัจจุบัน)
                ->limit(5)->get();

    // เช็คว่ามี users หรือไม่
    if ($users->isEmpty()) {
        return redirect()->back()->with('message','ไม่มี User ที่ใช้ได้ในขณะนี้');
    }

    // สร้างข้อมูลใน users_in_in แบบอัตโนมัติ
    foreach ($users as $user) {
        $aaa=users::where('id',$user->id)->first();
        $item=new users_in_in();
        $item->id_user=$user->id;  
        $item->id_user_in=$r->id_user_in;    
        $item->type=@$aaa->type;

        $user_in_in_count=users_in_in::where('id_user_in',@$r->id_user_in)->count();
        if($user_in_in_count >= 5){
        return redirect()->back()->with('message','จำนวนผู้ใช้งานครบแล้ว!');
        }else{
        $item->save();

        $item_his=new users_in_in_history();
        $item_his->id_user=$user->id;  
        $item_his->id_user_in=$r->id_user_in;    
        $item_his->type=@$aaa->type;
        $item_his->save();
        }
    }

    return redirect()->back()->with('message','Sucess!');
}
// Auto

    





}
