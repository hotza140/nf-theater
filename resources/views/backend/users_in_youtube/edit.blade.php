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
                        <h5 class="m-b-10">USERS YOUTUBE/EDIT</h5>

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
                                        action="{{ url('y_users_in_update/'.@$item->id) }}"
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
                                        $run = 'YT';

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
                                                <input type="email" name="email" class="form-control" id=""  maxlength = "150"
                                                     required value="{{@$item->email}}">
                                            </div>

                                            @if(Auth::guard('admin')->user()->type == 0)

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$item->password}}" placeholder="รหัสผ่าน" >
                                            </div>

                                            @endif

                                        </div>

                                      

                                        <?php
                                        $date_s=date('Y-m-d');
                                        if(@$item->date_start!=null){
                                            $date_s=@$item->date_start;
                                        }

                                        ?>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">วันต่ออายุ</label>
                                                <input type="date" name="date_start" class="form-control" id=""
                                                      value="{{@$date_s}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เวลา</label>
                                                <input type="time" name="time" class="form-control" id=""
                                                      value="{{@$item->time}}">
                                            </div>
                                        </div>


                                        <?php $country=DB::table('tb_country')->orderByRaw("CONVERT(title USING tis620) ASC")->cursor(); ?>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Country</label>
                                                <select name="country" id="country" class="form-control add_select2"  >
                                                @foreach($country as $key=>$countrys)
                                                <option value="{{@$countrys->title}}" @if(@$item->country==@$countrys->title) selected  @endif >{{@$countrys->title}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">รหัส 8 หลัก</label>
                                                <input type="test" name="code" class="form-control" id=""
                                                      value="{{@$item->code}}">
                                            </div>
                                        </div>


                                        <br><br>
                                        <h3>รอบบิล</h3>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">กรอกข้อมูลรอบบิล</label>
                                                <input type="text" name="date_ee" class="form-control" id=""
                                                      value="{{@$item->date_ee}}">
                                            </div>
                                        </div>
                                        

                                        <p class="text-right">
                                            <a href="{{ url('y_users_in') }}"
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
                                    $tey=App\Models\users_in_in::pluck('id_user')->ToArray();

                                    $date_ch_in=date('Y-m-d');
                                    $user=App\Models\users::where('open',0)
                                    ->whereNotIn('id',$tey)
                                    ->whereNotNull('type_youtube')
                                    ->whereNotNull('username')
                                    ->whereNotNull('password')
                                    ->whereDate('date_start', '<=',$date_ch_in) // ยังไม่หมดอายุ (start <= ปัจจุบัน)
                                    ->whereDate('date_end', '>=',$date_ch_in) // ยังไม่หมดอายุ (end >= ปัจจุบัน)
                                    ->orderby('id','desc')->cursor();
                                    ?>
                                    <div class="col-sm-3">
                                    <select name="id_user" id="id_user" class="form-control add_select2"  required >
                                    @foreach($user as $key=>$users)
                                    <option value="{{@$users->id}}" >{{@$users->email}} ({{@$users->username}})</option>
                                     @endforeach
                                    </select>
                                    </div>

                                    <input type="hidden"  name="type" value="MOBILE" >
<!-- 
                                    <div class="col-sm-1">
                                    <select name="type" id="type" class="form-control add_select2" required  >
                                        <option value="MOBILE" @if(@$item->type=='MOBILE') selected  @endif >ยกเว้นทีวี</option>
                                        <option value="PC" @if(@$item->type=='PC') selected  @endif >TV</option>
                                        </select>
                                        </div>

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
                                        </div> -->
                                    
                                    <div class="col-sm-1">
                                        <button type="submit" style="color:white;" class="btn btn-success"  onclick="javascript:return confirm('Confirm?')">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    </div>    

                                    </form>  

                                    <div class="col-sm-2">
                                    <form method="post" id="y_autoCreateUsersInIn" action="{{ url('y_autoCreateUsersInIn') }}" enctype="multipart/form-data" >
                                    @csrf

                                    <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                    <button type="submit" style="color:white;" class="btn btn-danger"  onclick="javascript:return confirm('Confirm?')">
                                        <i class="fa fa-plus"></i> Add User Auto
                                    </button>
                                    </form>  
                                    </div>  



                                    <!-- <div class="col-sm-2">
                                    <form method="post" id="y_autoCreateUsersInIn_aaa" action="{{ url('y_autoCreateUsersInIn_aaa') }}" enctype="multipart/form-data" >
                                    @csrf

                                    <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                    <button type="submit" style="color:white;" class="btn btn-danger"  onclick="javascript:return confirm('Confirm?')">
                                        <i class="fa fa-plus"></i> เพิ่มตัวแทน Auto
                                    </button>
                                    </form>  
                                    </div>   -->


                                </div>
                                </div>

                                <div class="card">
                                <div class="card-block">

                                <h3>เพิ่ม หลาย User</h3>

                                <form class="form-horizontal" action="{{url('y_users_add_many')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row" >
                                        <div class="col-sm-1">
                                        <input type="hidden" class="form-control" id="" name="id" value="{{@$item->id}}" >

                                        <input type="number" class="form-control" id="number_input" name="number" value="1" min="1" max="5" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="submit" class="btn btn-success" style="color:white;">
                                                <i class="fa fa-plus"></i> สร้างแบบหลาย User
                                                </button>
                                            </div>
                                        </div>
                                        </form>
                                        <script>
                                        document.getElementById("number_input").addEventListener("input", function () {
                                            if (this.value > 5) {
                                                this.value = 5;
                                            } else if (this.value < 1) {
                                                this.value = 1;
                                            }
                                        });
                                        </script>

                                    <br><br><br>

                                    <h3>เพิ่ม User</h3>


                                    <form method="post" id="" action="{{ url('y_users_store_form_in') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                        <!-- -------EDIT---------- -->

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id=""   required
                                                      value="">
                                            </div>
                                        </div>
                                        
                                        <?php
                                       do {
                                        // สุ่มเลขระหว่าง 000000 ถึง 999999
                                        $randomNumber = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
                                        $run = "NF{$randomNumber}";
                                    
                                        // ตรวจสอบว่าเลขนี้มีอยู่ใน username หรือยัง
                                        $exists = DB::table('tb_users')->where('username', $run)->exists();
                                    } while ($exists);
                                    
                                    // ถ้า $item->username มีค่า ให้ใช้ค่านั้นแทน
                                    if (@$item->username != null) {
                                        $run = @$item->username;
                                    }

                                        $password = rand(111111, 999999);

                                        ?>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username*</label>
                                                <input type="text" name="username" class="form-control" id=""  maxlength = "150"
                                                     required value="{{@$run}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$password}}" placeholder="รหัสผ่าน" >
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

                                        <div class="col-sm-3" style="display:none;">
                                        <label class="col-form-label">Package Type*</label>
                                        <select name="type" id="type" class="form-control" required onchange="updatePackage()" >
                                        <option value="MOBILE" @if(@$item->type=='MOBILE') selected  @endif >จำนวนลูกค้า</option>
                                        <!-- <option value="PC" @if(@$item->type=='PC') selected  @endif >TV</option> -->
                                        </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="col-form-label">แพ็คเกจ*</label>
                                            <select name="package" id="package" class="form-control" required>
                                                <!-- ตัวเลือกจะแสดงผลอัตโนมัติ -->
                                            </select>
                                        </div>

                                        </div>

                                        <div class="form-group row">

                                        <!-- <div class="col-sm-2">
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
                                    </div> -->

                                        <div class="col-sm-2" style="display: none;">
                                            <label class="col-form-label">Enter Days*</label>
                                            <input type="number" class="form-control" id="day_input" name="day" placeholder="Enter number of days"  >
                                        </div>

                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id="date_start"
                                                      value=""  required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                      value=""  required >
                                            </div>
                                        </div>

                                        <?php 
                                        $pag_PC = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00002')->where('type', 'PC')->orderBy('Subpackage_Dayuse', 'asc')->get();
                                        $pag_MOBILE = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00002')->where('type', 'MOBILE')->orderBy('Subpackage_Dayuse', 'asc')->get();  
                                    ?>

    <script>
    var packages = {
        PC: @json($pag_PC),
        MOBILE: @json($pag_MOBILE)
    };

    document.addEventListener('DOMContentLoaded', () => {
        const dateStartInput = document.getElementById('date_start');
        const dateEndInput = document.getElementById('date_end');
        const dayInput = document.getElementById('day_input');
        const daySelect = document.getElementById('day_select');
        const typeSelect = document.getElementById("type");
        const packageSelect = document.getElementById("package");

        // ตั้งค่าวันที่เริ่มต้นเป็นวันนี้
        const today = new Date().toISOString().split('T')[0];
        dateStartInput.value = today;

        function updatePackage() {
            var type = typeSelect.value;
            var selectedPackage = "{{ @$item->package }}"; // ค่าจากฐานข้อมูล

            // ล้างค่าของ select
            packageSelect.innerHTML = "";

            // เพิ่มตัวเลือกจากฐานข้อมูล
            packages[type].forEach(pkg => {
                var opt = document.createElement("option");
                opt.value = pkg.Subpackage_Name;
                opt.textContent = opt.value;
                opt.dataset.dayuse = pkg.Subpackage_Dayuse; // เก็บจำนวนวันไว้ใน dataset

                if (opt.value === selectedPackage) {
                    opt.selected = true;
                }
                packageSelect.appendChild(opt);
            });

            updateDays(); // อัปเดตค่าจำนวนวันใน `day_input`
        }

        function updateDays() {
            var selectedOption = packageSelect.options[packageSelect.selectedIndex];

            if (selectedOption) {
                var days = selectedOption.dataset.dayuse || 0;
                dayInput.value = days;
                updateEndDate(parseInt(days, 10));
            }
        }

        // function updateEndDate(days) {
        //     if (!isNaN(days) && days > 0) {
        //         const startDate = new Date(dateStartInput.value);
        //         startDate.setDate(startDate.getDate() + days);
        //         dateEndInput.value = startDate.toISOString().split('T')[0];
        //     } else {
        //         dateEndInput.value = '';
        //     }
        // }

        function updateEndDate(months) {
            if (!isNaN(months) && months > 0) {
                const startDate = new Date(dateStartInput.value);
                startDate.setMonth(startDate.getMonth() + months); // เปลี่ยนจากวันเป็นเดือน
                dateEndInput.value = startDate.toISOString().split('T')[0];
            } else {
                dateEndInput.value = '';
            }
        }

        // โหลดข้อมูลเริ่มต้น
        updatePackage();

        // Event Listeners
        typeSelect.addEventListener("change", updatePackage);
        packageSelect.addEventListener("change", updateDays);
        daySelect.addEventListener("change", () => {
            dayInput.value = daySelect.value;
            updateEndDate(parseInt(daySelect.value, 10));
        });
        dayInput.addEventListener("input", () => {
            updateEndDate(parseInt(dayInput.value, 10));
        });
        dateStartInput.addEventListener("change", () => {
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

                                    @if(@$item->open==1)
                                    <a href="{{url('y_change_user/'.@$item->id)}}" class="btn btn-danger" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> ย้าย Users </a>
                                                    <br> <br> <br>
                                                    @endif

                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Open/Close</th> -->
                                                    <th>Type</th>
                                                    <th>Username</th>
                                                    <th>Eamil</th>
                                                    <th>ชื่อไลน์ลูกค้า</th>
                                                    <th>Package</th>
                                                    <th>วันที่ใช้งานคงเหลือ</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>Tool</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($user_in_in as $key=>$user_ins)
                                            <?php @$user_aa=DB::table('tb_users')->where('id',$user_ins->id_user)->first(); ?>
                                            <tr class="num" id="{{$user_ins->id}}">
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        @if($user_ins->type=='MOBILE' or $user_ins->type=='')

                                                        @if($user_ins->tan==null)
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @else
                                                        <i class="fa fa-mobile" style="font-size:30px; color:blue;" title="ตัวแทน"></i>
                                                        @endif

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
                                                    if(@$user_aa->type=='PC'){
                                                        $paga='TV '.@$user_aa->package;
                                                    }else{
                                                        $paga=@$user_aa->package;
                                                    }

                                                    $paga=@$user_aa->package;

                                                    ?>
                                                    
                                                    <td>{{@$user_aa->username}}</td>
                                                    <td>{{@$user_aa->email}}</td>
                                                    <td>{{@$user_aa->line}}</td>
                                                    <td>{{@$paga}}</td>
                                                    
                                                    <?php
                                                    $date_start = $user_aa->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    $date_end = $user_aa->date_end; // วันที่สิ้นสุด (Y-m-d)
                                                    $today = date('Y-m-d'); // วันที่ปัจจุบัน

                                                    if ($date_start && $date_end) {
                                                        // if (strtotime($today) < strtotime($date_start)) {
                                                        //     $status = "ยังไม่เข้าช่วง";
                                                        // } else
                                                        
                                                        if (strtotime($today) <= strtotime($date_end)) {
                                                            $days_remaining = (strtotime($date_end) - strtotime($today)) / (60 * 60 * 24);
                                                            $status = "เหลืออีก $days_remaining วัน";
                                                        } else {
                                                            $status = "หมดอายุแล้ว";
                                                        }
                                                    } else {
                                                        $status = "ไม่มีข้อมูลวันที่";
                                                    }

                                                    if ($date_start) {
                                                        $formatted_date1 = date('d/m/Y', strtotime($today));
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

                                                    <?php $link = url('frontlogin'); ?>

                                                    <td>
                                                    <!-- <a href="{{url('y_users_in_in_edit/'.$user_ins->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a> -->
                                                        <a href="{{url('y_users_in_in_destroy/'.$user_ins->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                        <button class="btn btn-sm btn-primary" onclick="copyUserInfo('{{@$user_aa->username}}', '{{@$user_aa->password}}', '{{@$user_aa->email}}', '{{@$paga}}', '{{@$link}}')">
                                                            <i class="fa fa-copy"></i> Copy
                                                        </button>
                                                    </td>


                                                    <form method="post" id="{{$user_ins->id}}" action="{{ url('youtube_in_yay')}}"  enctype="multipart/form-data" >
                                                    @csrf


                                                    <input type="hidden" name="id"  value="{{$user_ins->id}}" >

                                                    <td>
                                                    <div style="display: flex; align-items: center; gap: 10px;">

                                                    <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> ย้าย Account </button>
                                                    
                                                    </div>

                                                    </td>

                                                    </form>

                                                    
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
                                        let textToCopy = `Username : ${username}\nPassword : ${password}\nEmail: ${name}\nแพ็กเกจที่สมัคร : ${package}\nลิงก์เข้าใช้งาน : ${link}`;

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