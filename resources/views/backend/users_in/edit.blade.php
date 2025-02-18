@extends('layouts.menubar')
@section('content')

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 25px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 19px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #93D600; /* ใช้สีเขียวตามความชอบ */
    }

    input:checked + .slider:before {
        transform: translateX(25px);
    }
</style>


<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">USERS Account/EDIT</h5>

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
                                        action="{{ url('users_in_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->


                                     
                                        <?php
                                        $runnum=DB::table('tb_users_in')->orderby('id','desc')->count();
                                        $runtotal=$runnum+1;
                                        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
                                        $run = "NF-{$xxxx}";

                                        if(@$item->name!=null){
                                            $run=@$item->name;
                                        }

                                        ?>


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Account</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="{{@$run}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email*</label>
                                                <input type="email" name="email" class="form-control" id=""  maxlength = "25"
                                                     required value="{{@$item->email}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$item->password}}" placeholder="รหัสผ่าน" >
                                            </div>
                                        </div>

                                      

                                        <?php
                                        $date_s=date('Y-m-d');
                                        if(@$item->date_start!=null){
                                            $date_s=@$item->date_start;
                                        }

                                        ?>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id=""
                                                      value="{{@$date_s}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id=""
                                                      value="{{@$item->date_end}}">
                                            </div>
                                        </div>


                                        <?php $country=DB::table('dataset_country')->orderByRaw("CONVERT(ct_nameTHA USING tis620) ASC")->cursor(); ?>
                                        <!-- <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Country</label>
                                                <select name="country" id="country" class="form-control add_select2"  >
                                                @foreach($country as $key=>$countrys)
                                                <option value="{{@$countrys->ct_nameTHA}}" @if(@$item->country==@$countrys->ct_nameTHA) selected  @endif >{{@$countrys->ct_nameTHA}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div> -->

                                        <br><br>
                                        <h3>Email เสริม สำหรับ TV</h3>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email เสริม 1</label>
                                                <input type="email" name="email01" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->email01}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password เสริม 1</label>
                                                <input type="text" name="password01" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->password01}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email เสริม 2</label>
                                                <input type="email" name="email02" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->email02}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password เสริม 2</label>
                                                <input type="text" name="password02" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->password02}}">
                                            </div>
                                        </div>
                                        

                                        <p class="text-right">
                                            <a href="{{ url('users_in') }}"
                                                style="color:white;" class="btn btn-warning"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->




                <?php
                 $user_in_in=App\Models\users_in_in::where('id_user_in',@$item->id)->orderby('name','desc')->cursor();
                 $user_in_in_count=App\Models\users_in_in::where('id_user_in',@$item->id)->where('type','MOBILE')->orderby('id','desc')->count();
                $user_in_in_count_PC_1=App\Models\users_in_in::where('id_user_in',@$item->id)->where('type','PC')->where('type_mail',1)->orderby('id','desc')->count();
                $user_in_in_count_PC_2=App\Models\users_in_in::where('id_user_in',@$item->id)->where('type','PC')->where('type_mail',2)->orderby('id','desc')->count();
                ?>
                 <!-- Page body2 start -->
                 <div class="page-body">
                 <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">จัดการผู้ใช้ใน Account</h1>
                                <br>

                               

                                <div class="form-group row">

                                <form method="post" id="add_user_in_in" action="{{ url('add_user_in_in') }}" enctype="multipart/form-data" >
                                @csrf

                                <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >

                                    <?php 
                                    $date_ch_in=date('Y-m-d');
                                    $user=App\Models\users::where('open',0)
                                    ->whereDate('date_start', '<=',$date_ch_in) // ยังไม่หมดอายุ (start <= ปัจจุบัน)
                                    ->whereDate('date_end', '>=',$date_ch_in) // ยังไม่หมดอายุ (end >= ปัจจุบัน)
                                    ->orderby('id','desc')->cursor();
                                    ?>
                                    <div class="col-sm-3">
                                    <select name="id_user" id="id_user" class="form-control add_select2"  required >
                                    @foreach($user as $key=>$users)
                                    <option value="{{@$users->id}}" >{{@$users->name}} ({{@$users->username}})</option>
                                     @endforeach
                                    </select>
                                    </div>

                                    <!-- <div class="col-sm-1">
                                    <select name="type" id="type" class="form-control add_select2" required  >
                                        <option value="MOBILE" @if(@$item->type=='MOBILE') selected  @endif >ยกเว้นทีวี</option>
                                        <option value="PC" @if(@$item->type=='PC') selected  @endif >TV</option>
                                        </select>
                                        </div> -->

                                        <div class="col-sm-3">
                                    <select name="type_mail" id="type_mail" class="form-control add_select2"   >
                                        <option value="" @if(@$item->type_mail=='') selected  @endif >เมลหลัก (ยกเว้น TV)</option>
                                        @if($user_in_in_count_PC_1==0)
                                        <option value="1" @if(@$item->type_mail=='1') selected  @endif >เมลเสริม 1 (TV)</option>
                                        @endif
                                        @if($user_in_in_count_PC_2==0)
                                        <option value="2" @if(@$item->type_mail=='2') selected  @endif >เมลเสริม 2 (TV)</option>
                                        @endif
                                        </select>
                                        </div>
                                    
                                    <div class="col-sm-1">
                                        <button type="submit" style="color:white;" class="btn btn-success"  onclick="javascript:return confirm('Confirm?')">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    </div>    

                                    </form>  

                                    <div class="col-sm-2">
                                    <form method="post" id="autoCreateUsersInIn" action="{{ url('autoCreateUsersInIn') }}" enctype="multipart/form-data" >
                                    @csrf

                                    <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                    <button type="submit" style="color:white;" class="btn btn-danger"  onclick="javascript:return confirm('Confirm?')">
                                        <i class="fa fa-plus"></i> Add User Auto (เมลหลัก)
                                    </button>
                                    </form>  
                                    </div>  


                                </div>
                                </div>

                                <div class="card">
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('users_store_form_in') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                        <!-- -------EDIT---------- -->

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Profile</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="">
                                            </div>
                                        </div>
                                        
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

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id=""  
                                                      value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" id=""  maxlength = "10"
                                                      value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Line</label>
                                                <input type="text" name="line" class="form-control" id=""  
                                                      value="">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Link Line</label>
                                                <input type="text" name="link_line" class="form-control" id=""  
                                                      value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package*</label>
                                        <select name="type" id="type" class="form-control" required onchange="updatePackage()"  >
                                        <option value="MOBILE" @if(@$none->type=='MOBILE') selected  @endif >ยกเว้นทีวี</option>
                                        <option value="PC" @if(@$none->type=='PC') selected  @endif >TV</option>
                                        </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="col-form-label">แพ็คเกจ*</label>
                                            <select name="package" id="package" class="form-control" required>
                                                <!-- ตัวเลือกจะแสดงผลอัตโนมัติ -->
                                            </select>
                                        </div>

                                        <script>
                                        function updatePackage() {
                                            var type = document.getElementById("type").value;
                                            var packageSelect = document.getElementById("package");
                                            var selectedPackage = "{{ @$item->package }}"; // นำค่าจากฐานข้อมูลมาใช้

                                            // ล้างค่าเดิม
                                            packageSelect.innerHTML = "";

                                            // กำหนดตัวเลือกแพ็กเกจ
                                            var options;
                                            if (type === "PC") {
                                                options = [
                                                    { value: "1 เดือน 139 บาท", text: "1 เดือน 139 บาท" },
                                                    { value: "2 เดือน 269 บาท", text: "2 เดือน 269 บาท" },
                                                    { value: "3 เดือน 400 บาท", text: "3 เดือน 400 บาท" },
                                                    { value: "4 เดือน 535 บาท", text: "4 เดือน 535 บาท" },
                                                    { value: "6 เดือน 800 บาท", text: "6 เดือน 800 บาท" },
                                                    { value: "1 ปี 1,590 บาท", text: "1 ปี 1,590 บาท" }
                                                ];
                                            } else {
                                                options = [
                                                    { value: "1 เดือน 189 บาท", text: "1 เดือน 189 บาท" },
                                                    { value: "2 เดือน 369 บาท", text: "2 เดือน 369 บาท" },
                                                    { value: "3 เดือน 550 บาท", text: "3 เดือน 550 บาท" },
                                                    { value: "4 เดือน 729 บาท", text: "4 เดือน 729 บาท" },
                                                    { value: "6 เดือน 1,099 บาท", text: "6 เดือน 1,099 บาท" },
                                                    { value: "1 ปี 2,090 บาท", text: "1 ปี 2,090 บาท" }
                                                ];
                                            }

                                            // เพิ่ม option ลงใน select และกำหนดค่าที่เลือกไว้
                                            options.forEach(option => {
                                                var opt = document.createElement("option");
                                                opt.value = option.value;
                                                opt.textContent = option.text;
                                                if (option.value === selectedPackage) {
                                                    opt.selected = true; // ตั้งค่าที่เลือกไว้ตามฐานข้อมูล
                                                }
                                                packageSelect.appendChild(opt);
                                            });
                                        }

                                        // เรียกใช้เมื่อโหลดหน้าเว็บ
                                        window.onload = function () {
                                            updatePackage();
                                        };
                                    </script>

                                        </div>

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

                                        <div class="form-group row">
                                           <div class="col-sm-3">
                                           <label class="col-form-label">เลือกเมลที่เชื่อมต่อ</label>
                                    <select name="type_mail" id="type_mail" class="form-control add_select2"   >
                                    <option value="" @if(@$item->type_mail=='') selected  @endif >เมลหลัก (ยกเว้น TV)</option>
                                        @if($user_in_in_count_PC_1==0)
                                        <option value="1" @if(@$item->type_mail=='1') selected  @endif >เมลเสริม 1 (TV)</option>
                                        @endif
                                        @if($user_in_in_count_PC_2==0)
                                        <option value="2" @if(@$item->type_mail=='2') selected  @endif >เมลเสริม 2 (TV)</option>
                                        @endif
                                        </select>
                                        </div>
                                        </div>

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

                                        <p class="text-right">
                                            <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>
                            </div>


                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Open/Close</th> -->
                                                    <th>Type</th>
                                                    <th>Username</th>
                                                    <th>Name Profile</th>
                                                    <th>ชื่อไลน์ลูกค้า</th>
                                                    <th>Package</th>
                                                    <th>วันที่ใช้งานคงเหลือ</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($user_in_in as $key=>$user_ins)
                                            <?php $user_aa=App\Models\users::where('id',$user_ins->id_user)->first(); ?>
                                            <tr class="num" id="{{$user_ins->id}}">
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        @if($user_ins->type=='MOBILE' or $user_ins->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @else
                                                        <?php  
                                                        if($user_ins->type_mail==1){
                                                            $mail_r=$item->email01;
                                                            $pass_r=$item->password01;
                                                        }else{
                                                            $mail_r=$item->email02;
                                                            $pass_r=$item->password02;
                                                        }
                                                        
                                                        ?>
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i> {{@$mail_r}}
                                                        @endif
                                                    </td>

                                                    <?php
                                                    if($user_aa->type=='PC'){
                                                        $paga='TV '.@$user_aa->package;
                                                    }else{
                                                        $paga='ยกเว้นทีวี '.@$user_aa->package;
                                                    }

                                                    ?>
                                                    
                                                    <td>{{$user_aa->username}}</td>
                                                    <td>{{$user_aa->name}}</td>
                                                    <td>{{$user_aa->line}}</td>
                                                    <td>{{@$user_aa}} {{$user_aa->package}}</td>
                                                    <?php
                                                    $date_start = $user_aa->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    $date_end = $user_aa->date_end; // วันที่สิ้นสุด (Y-m-d)
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
                                                    <td>{{@$user_ins->created_at}}</td>

                                                    

                                                    <td>
                                                    <!-- <a href="{{url('users_in_in_edit/'.$user_ins->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a> -->
                                                        <a href="{{url('users_in_in_destroy/'.$user_ins->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                        <button class="btn btn-sm btn-primary" onclick="copyUserInfo('{{$user_aa->username}}', '{{$user_aa->password}}', '{{$user_aa->name}}', '{{@$paga}}', '{{$user_aa->link}}')">
                                                            <i class="fa fa-copy"></i> Copy
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                    <script>
                                    function fallbackCopyTextToClipboard(text) {
                                        const textArea = document.createElement("textarea");
                                        textArea.value = text;
                                        document.body.appendChild(textArea);
                                        textArea.focus();
                                        textArea.select();
                                        try {
                                            document.execCommand("copy");
                                            alert("คัดลอกข้อมูลสำเร็จ!");
                                        } catch (err) {
                                            console.error("คัดลอกไม่สำเร็จ: ", err);
                                            alert("คัดลอกไม่สำเร็จ กรุณาลองอีกครั้ง");
                                        }
                                        document.body.removeChild(textArea);
                                    }

                                    function copyUserInfo(username, password, name, package, link) {
                                        let textToCopy = `Username : ${username}\nPassword : ${password}\nชื่อโปรไฟล์: ${name}\nแพ็กเกจที่สมัคร : ${package}\nลิงก์เข้าใช้งาน : ${link}`;

                                        if (navigator.clipboard && navigator.clipboard.writeText) {
                                            navigator.clipboard.writeText(textToCopy).then(() => {
                                                alert("คัดลอกข้อมูลสำเร็จ!");
                                            }).catch(err => {
                                                console.error('คัดลอกไม่สำเร็จ: ', err);
                                                fallbackCopyTextToClipboard(textToCopy);
                                            });
                                        } else {
                                            console.warn("ใช้ HTTP → เปลี่ยนไปใช้ execCommand แทน");
                                            fallbackCopyTextToClipboard(textToCopy);
                                        }
                                    }
                                    </script>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body2 end -->

            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>


<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/users_in_in_open_close") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, open: isOpen }),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Failed to update status.');
                    // Revert the switch state if update fails
                    this.checked = !this.checked;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert the switch state if an error occurs
                this.checked = !this.checked;
            });
        });
    });
});
</script>


    @endsection

    @section('script')


    @endsection