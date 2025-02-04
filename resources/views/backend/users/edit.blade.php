@extends('layouts.menubar')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">USERS/EDIT</h5>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-block">

                                    <form method="post" id=""
                                        action="{{ url('users_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->

                                        <?php
                                        $runnum=DB::table('tb_users')->orderby('id','desc')->count();
                                        $runtotal=$runnum+1;
                                        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
                                        $run = "NF{$xxxx}";

                                        if(@$item->username!=null){
                                            $run=@$item->username;
                                        }

                                        if(@$item->password!=null){
                                            $password=@$item->password;
                                        }else{
                                            $password = rand(111111, 999999);
                                        }

                                        ?>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Profile</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="{{@$item->name}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username*</label>
                                                <input type="username" name="username" class="form-control" id=""  maxlength = "25"
                                                     required value="{{@$run}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$password}}" placeholder="รหัสผ่าน" >
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id=""  
                                                      value="{{@$item->email}}">
                                            </div>
                                        </div> -->

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">เบอรโทรศัพท์</label>
                                                <input type="text" name="phone" class="form-control" id=""  maxlength = "10" placeholder="เบอรโทรศัพท์ (ถ้ามี)"
                                                      value="{{@$item->phone}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ชื่อไลน์ลูกค้า</label>
                                                <input type="text" name="line" class="form-control" id=""  
                                                      value="{{@$item->line}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ลิงก์ไลน์ลูกค้า</label>
                                                <input type="text" name="link_line" class="form-control" id=""  
                                                      value="{{@$item->link_line}}">
                                            </div>
                                        </div>

                                        <input type="hidden" name="type"  value="MOBILE">

                                        <div class="form-group row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package*</label>
                                        <select name="package" id="package" class="form-control add_select2" required  >
                                        <option value="30 วัน" @if(@$item->package=='30 วัน') selected  @endif >30 วัน</option>
                                        <option value="60 วัน" @if(@$item->package=='60 วัน') selected  @endif >60 วัน</option>
                                        <option value="90 วัน" @if(@$item->package=='90 วัน') selected  @endif >90 วัน</option>
                                        <option value="120 วัน" @if(@$item->package=='120 วัน') selected  @endif >120 วัน</option>
                                        <option value="180 วัน" @if(@$item->package=='180 วัน') selected  @endif >180 วัน</option>
                                        <option value="365 วัน" @if(@$item->package=='365 วัน') selected  @endif >365 วัน</option>
                                        </select>
                                        </div>
                                        </div>

                                        <?php
                                        $date_s=date('Y-m-d');
                                        if(@$item->date_start!=null){
                                            $date_s=@$item->date_start;
                                        }
                                        ?>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id=""
                                                      value="{{@$item->date_start}}" readonly required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id=""
                                                      value="{{@$item->date_end}}" readonly required >
                                            </div>
                                        </div>

                                     

                                        <p class="text-right">
                                            <a href="{{ url('users') }}"
                                                style="color:white;" class="btn btn-warning"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>


                                <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">ต่ออายุ Account</h1>
                                <br><br>
                                <form method="post" id=""
                                        action="{{ url('users_update_date') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <input type="hidden" name="id" value="{{@$item->id}}">

                                <div class="form-group row">
                                <div class="col-sm-2">
                                    <label class="col-form-label">Select Days</label>
                                    <select class="form-control" id="day_select">
                                        <option value="">Select days</option>
                                        <option value="30">30 วัน</option>
                                        <option value="60">60 วัน</option>
                                        <option value="90">90 วัน</option>
                                        <option value="120">120 วัน</option>
                                        <option value="180">180 วัน</option>
                                        <option value="365">365 วัน</option>
                                    </select>
                                </div>
                                        <div class="col-sm-2">
                                            <label class="col-form-label">Enter Days*</label>
                                            <input type="number" class="form-control" id="day_input" name="day" placeholder="Enter number of days" required >
                                        </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id="date_start"
                                                      value="" readonly required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                      value="" readonly required >
                                            </div>
                                        </div>
                                        <p class="">
                                            <button type="submit" class="btn btn-danger" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> ต่ออายุ </button>
                                        </p>
                                        </form>
                                        </div>
                                        </div>


                                        



                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->

                <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const dateStartInput = document.getElementById('date_start');
                    const dateEndInput = document.getElementById('date_end');
                    const dayInput = document.getElementById('day_input');
                    const daySelect = document.getElementById('day_select');

                    // ตั้งค่าวันที่เริ่มต้นเป็นวันนี้
                    const today = new Date().toISOString().split('T')[0];
                    dateStartInput.value = today;

                    // ฟังก์ชันคำนวณวันที่สิ้นสุด
                    function updateEndDate(days) {
                        if (!isNaN(days) && days > 0) {
                            const startDate = new Date(dateStartInput.value);
                            startDate.setDate(startDate.getDate() + days);
                            dateEndInput.value = startDate.toISOString().split('T')[0];
                        } else {
                            dateEndInput.value = '';
                        }
                    }

                    // เมื่อเลือกจำนวนวันจาก select ให้ไปใส่ใน input และคำนวณวันสิ้นสุด
                    daySelect.addEventListener('change', () => {
                        dayInput.value = daySelect.value;
                        updateEndDate(parseInt(daySelect.value, 10));
                    });

                    // เมื่อกรอกจำนวนวันเอง ให้คำนวณวันสิ้นสุด
                    dayInput.addEventListener('input', () => {
                        updateEndDate(parseInt(dayInput.value, 10));
                    });

                    // เมื่อเปลี่ยนวันที่เริ่มต้น ให้คำนวณวันสิ้นสุดใหม่
                    dateStartInput.addEventListener('change', () => {
                        updateEndDate(parseInt(dayInput.value, 10));
                    });
                });
                </script>







                <?php
                 $accounts=App\Models\users_in_in::where('id_user',@$item->id)->orderby('id','desc')->cursor();
                ?>
                 <!-- Page body2 start -->
                 <div class="page-body">
                 <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">Account ที่เชื่อมต่อปัจจุบัน</h1>
                                <br>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>วันที่เชื่อมต่อ</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($accounts as $key=>$accountss)
                                            <?php
                                             $accountsss=App\Models\users_in::where('id',@$accountss->id_user_in)->first();
                                            ?>
                                            <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        @if($accountss->type=='MOBILE' or $accountss->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @else
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{@$accountsss->name}}</td>
                                                    @if($accountss->type=='MOBILE' or $accountss->type=='')
                                                    <td>{{@$accountsss->email}}</td>
                                                    <td>{{@$accountsss->password}}</td>
                                                        @else
                                                        <?php  
                                                        if($accountss->type_mail==1){
                                                            $mail_r=$accountsss->email01;
                                                            $pass_r=$accountsss->password01;
                                                        }elseif($accountss->type_mail==2){
                                                            $mail_r=$accountsss->email02;
                                                            $pass_r=$accountsss->password02;
                                                        }
                                                        
                                                        ?>
                                                        <td>{{@$mail_r}}</td>
                                                        <td>{{@$pass_r}}</td>
                                                        @endif
                                                    <td>{{@$accountss->created_at}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body2 end -->


                <?php
                 $user_r=App\Models\users::where('id','!=',@$item->id)->where('username',@$item->username)->orderby('id','desc')->cursor();
                ?>
                 <!-- Page body3 start -->
                 <div class="page-body">
                 <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">User ที่เกี่ยวข้อง</h1>
                                <br>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th>Name Profile</th>
                                                    <th>ชื่อไลน์ลูกค้า</th>
                                                    <th>วันที่ใช้งานคงเหลือ</th>
                                                    <th>สถานะ Account</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($user_r as $key=>$user_rs)
                                            <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$user_rs->username}}</td>
                                                    <td>{{$user_rs->name}}</td>
                                                    <td>{{$user_rs->line}}</td>
                                                    <?php
                                                    $date_start = $user_rs->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    $date_end = $user_rs->date_end; // วันที่สิ้นสุด (Y-m-d)
                                                    $today = date('Y-m-d'); // วันที่ปัจจุบัน

                                                    if ($date_start && $date_end) {
                                                        if (strtotime($today) < strtotime($date_start)) {
                                                            $status = "ยังไม่เข้าช่วง";
                                                        } elseif (strtotime($today) >= strtotime($date_start) && strtotime($today) <= strtotime($date_end)) {
                                                            $days_remaining = (strtotime($date_end) - strtotime($today)) / (60 * 60 * 24);
                                                            $status = "เหลืออีก $days_remaining วัน";
                                                        } else {
                                                            $status = "หมดอายุแล้ว";
                                                        }
                                                    } else {
                                                        $status = "ไม่มีข้อมูลวันที่";
                                                    }

                                                    if ($date_start) {
                                                        $formatted_date1 = date('d/m/Y', strtotime($date_start));
                                                    } else {
                                                        $formatted_date1 = null;
                                                    }
                                                    if ($date_end) {
                                                        $formatted_date2 = date('d/m/Y', strtotime($date_end));
                                                    } else {
                                                        $formatted_date2 = null;
                                                    }
                                                    ?>
                                                    <td>{{@$formatted_date1}} ถึง {{@$formatted_date2}} ({{@$status}})</td>
                                                    <td>
                                                        @if($user_rs->status_account == 0)
                                                            <span class="status-active">มีแอคเคาท์</span>
                                                        @elseif($user_rs->status_account == 1)
                                                            <span class="status-inactive">ไม่มีแอคเคาท์</span>
                                                        @else
                                                            <span class="status-expired">หมดอายุ</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                    <a href="{{url('users_edit/'.$user_rs->id)}}" class="btn btn-sm btn-info" target="_blank" style="color:white;"><i class="fa fa-gear"></i>View</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body3 end -->






                <?php
                 $accountsa=App\Models\users_in_in_history::where('id_user',@$item->id)->orderby('id','desc')->cursor();
                ?>
                 <!-- Page body4 start -->
                 <div class="page-body">
                 <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">ประวัติ Account ที่เคยเชื่อมต่อ</h1>
                                <br>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>วันที่เชื่อมต่อ</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($accountsa as $key=>$accountsas)
                                            <?php
                                             $accountsass=App\Models\users_in::where('id',@$accountsas->id_user_in)->first();
                                             $ch_his=App\Models\users_in_in::where('id_user',@$accountsas->id_user)
                                             ->where('id_user_in',@$accountsas->id_user_in)
                                             ->where('created_at',@$accountsas->created_at)
                                             ->first();
                                            ?>
                                            @if(@$ch_his==null)
                                            <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @else
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{@$accountsass->name}}</td>
                                                    @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                    <td>{{@$accountsass->email}}</td>
                                                    <td>{{@$accountsass->password}}</td>
                                                        @else
                                                        <?php  
                                                        if($accountsas->type_mail==1){
                                                            $mail_r=$accountsass->email01;
                                                            $pass_r=$accountsass->password01;
                                                        }elseif($accountsas->type_mail==2){
                                                            $mail_r=$accountsass->email02;
                                                            $pass_r=$accountsass->password02;
                                                        }
                                                        
                                                        ?>
                                                        <td>{{@$mail_r}}</td>
                                                        <td>{{@$pass_r}}</td>
                                                        @endif
                                                    <td>{{@$accountsass->created_at}}</td>
                                                </tr>
                                                @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body4 end -->




              



            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>



    @endsection

    @section('script')


    @endsection