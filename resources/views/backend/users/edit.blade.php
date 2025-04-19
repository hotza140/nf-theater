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
                        <h5 class="m-b-10">USERS NETFLIX /EDIT</h5>

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

                                        if(@$item->password!=null){
                                            $password=@$item->password;
                                        }else{
                                            $password = rand(111111, 999999);
                                        }

                                        ?>


                                        <?php $check_edit=Auth::guard('admin')->user()->id; ?>

                                        @if(@$item->status_edit != @$check_edit or @$item->status_edit == null)
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                                <h1 class="col-form-label" style="color:red">กำลังมีการแก้ใขอยู่ในขณะนี้</h1>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Profile</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="{{@$item->name}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">

                                        @if(@$item->password!=null)
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id="" readonly  maxlength = "150"
                                                      value="{{@$run}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password</label>
                                                <input type="text" name="password" class="form-control" id="" readonly  value="{{@$password}}" placeholder="รหัสผ่าน" >
                                            </div>
                                            @else
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id="" readonly  maxlength = "150"
                                                      value="{{@$item->username}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password</label>
                                                <input type="text" name="password" class="form-control" id="" readonly  value="" placeholder="รหัสผ่าน" >
                                            </div>
                                            @endif
                                        </div>

                                        <!-- <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id=""  
                                                      value="{{@$item->email}}">
                                            </div>
                                        </div> -->

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เบอรโทรศัพท์</label>
                                                <input type="text" name="phone" class="form-control" id=""  maxlength = "10" placeholder="เบอรโทรศัพท์ (ถ้ามี)"
                                                      value="{{@$item->phone}}">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email</label>
                                                <input type="text" name="email" class="form-control" id=""   placeholder="Email (ถ้ามี)"
                                                      value="{{@$item->email}}">
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


                                        <div class="form-group row">

                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package Type*</label>
                                        <select name="type" id="type" class="form-control" required onchange="updatePackage()" >
                                        <option value="MOBILE" @if(@$item->type=='MOBILE') selected  @endif >ยกเว้นทีวี</option>
                                        <option value="PC" @if(@$item->type=='PC') selected  @endif >TV</option>
                                        </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="col-form-label">แพ็คเกจ*</label>
                                            <select name="package" id="package" class="form-control" required>
                                                <!-- ตัวเลือกจะแสดงผลอัตโนมัติ -->
                                            </select>
                                        </div>


                                        <?php 
                                        $pag_PCa = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00001')->where('type', 'PC')->orderBy('Subpackage_Dayuse', 'asc')->get();
                                        $pag_MOBILEa = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00001')->where('type', 'MOBILE')->orderBy('Subpackage_Dayuse', 'asc')->get();  
                                    ?>

                                    <script>
                                        var packages = {
                                            PC: @json($pag_PCa),
                                            MOBILE: @json($pag_MOBILEa)
                                        };
                                        
                                        function updatePackage() {
                                            var type = document.getElementById("type").value;
                                            var packageSelect = document.getElementById("package");
                                            var selectedPackage = "{{ @$item->id_package }}"; // นำค่าจากฐานข้อมูลมาใช้

                                            // ล้างค่าเดิม
                                            packageSelect.innerHTML = "";

                                            // กำหนดตัวเลือกแพ็กเกจจากข้อมูลที่ดึงมาจาก Laravel
                                            var options = packages[type] || []; // Get the options based on the selected type

                                            // เพิ่ม option ลงใน select และกำหนดค่าที่เลือกไว้
                                            options.forEach(option => {
                                                var opt = document.createElement("option");
                                                opt.value = option.Subpackage_Name; // Assuming Subpackage_Name is the value you want to use
                                                opt.textContent = option.Subpackage_Name; // Update this if you want to display a different text
                                                if (option.id === parseInt(selectedPackage)) {
                                                    opt.selected = true; // ตั้งค่าที่เลือกไว้ตามฐานข้อมูล
                                                }
                                                packageSelect.appendChild(opt);
                                            });
                                        }
                                    </script>

                                        
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
                                            <a href="{{ url('users_status_edit/'.@$item->id) }}"
                                                style="color:white;" class="btn btn-warning"> <i
                                                    class="fa fa-share-square-o"></i> ยกเลิกแก้ใข/ย้อนกลับ </a>
                                            <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>




                                <div class="card">
                                <div class="card-header">
                                    <h3>เพิ่ม Profile</h3>
                                <form method="GET" action="{{url('users_add')}}" id="form{{@$item->id}}" name="form{{@$item->id}}" target="_blank">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{@@$item->id}}">
                                                        <button type="submit" class="btn btn-sm btn-success" style="color:white;" target="_blank"><i class="fa fa-gear"></i>เพิ่ม Profile</button>
                                                    </form>
                                    </div>
                                    </div>


                                <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">ต่ออายุ หรือปรับวันที่ Account</h1>
                                <br><br>
                                <form method="post" id=""
                                        action="{{ url('users_update_date') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <input type="hidden" name="id" value="{{@$item->id}}">

                                        <div class="form-group row">

                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package Type*</label>
                                        <select name="type" id="type_a" class="form-control" required onchange="updatePackage_a()" >
                                        <option value="MOBILE" @if(@$item->type=='MOBILE') selected  @endif >ยกเว้นทีวี</option>
                                        <option value="PC" @if(@$item->type=='PC') selected  @endif >TV</option>
                                        </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="col-form-label">แพ็คเกจ*</label>
                                            <select name="package" id="package_a" class="form-control" required>
                                                <!-- ตัวเลือกจะแสดงผลอัตโนมัติ -->
                                            </select>
                                        </div>
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
                                                      value=""  required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                      value=""  required >
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

                <?php 
    // ดึงข้อมูลแพ็กเกจจากฐานข้อมูล
    $pag_PC = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00001')->where('type', 'PC')->orderBy('Subpackage_Dayuse', 'asc')->get();
    $pag_MOBILE = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00001')->where('type', 'MOBILE')->orderBy('Subpackage_Dayuse', 'asc')->get();  
?>

<script>
    var packages = {
        PC: @json($pag_PC),
        MOBILE: @json($pag_MOBILE)
    };

    function updatePackage_a() {
        var type = document.getElementById("type_a").value;
        var packageSelect = document.getElementById("package_a");
        var selectedPackage = "{{ @$item->id_package }}"; // นำค่าจากฐานข้อมูลมาใช้

        // ล้างค่าเดิม
        packageSelect.innerHTML = "";

        // เพิ่มตัวเลือกจากฐานข้อมูล
        packages[type].forEach(pkg => {
            var opt = document.createElement("option");
            opt.value = pkg.Subpackage_Name;
            opt.textContent = pkg.Subpackage_Name;
            opt.dataset.dayuse = pkg.Subpackage_Dayuse; // เก็บจำนวนวันไว้ใน dataset
            if (pkg.id === parseInt(selectedPackage)) {
                opt.selected = true; // ตั้งค่าที่เลือกไว้ตามฐานข้อมูล
            }
            packageSelect.appendChild(opt);
        });

        // อัปเดตวันและวันที่สิ้นสุดหลังจากเพิ่มตัวเลือก
        updateDaysAndEndDate();
    }

    function updateDaysAndEndDate() {
        var packageSelect = document.getElementById("package_a");
        var dayInput = document.getElementById('day_input');
        var dateEndInput = document.getElementById('date_end');

        // หากไม่มีการเลือก ให้ใช้ค่าจากตัวเลือกแรก
        var selectedOption = packageSelect.options[packageSelect.selectedIndex];
        if (!selectedOption) {
            selectedOption = packageSelect.options[0];
        }

        if (selectedOption) {
            var days = selectedOption.dataset.dayuse || 0; // ใช้ dataset วัน
            dayInput.value = days;

            // คำนวณวันสิ้นสุด
            updateEndDate(parseInt(days, 10));
        }
    }

    function updateEndDate(days) {
        const dateStartInput = document.getElementById('date_start');
        const dateEndInput = document.getElementById('date_end');

        if (!isNaN(days) && days > 0) {
            const startDate = new Date(dateStartInput.value);
            startDate.setDate(startDate.getDate() + days);
            dateEndInput.value = startDate.toISOString().split('T')[0];
        } else {
            dateEndInput.value = '';
        }
    }

    // เรียกใช้เมื่อโหลดหน้าเว็บ
    window.onload = function () {
        updatePackage_a();
        // ตรวจสอบว่ามีค่า type ที่ถูกเซฟไว้หรือไม่
        var savedType = "{{ @$item->type }}"; // ค่าประเภทที่เซฟไว้
        document.getElementById("type").value = savedType; // ตั้งค่าให้ dropdown เป็นค่าที่เซฟไว้
        updatePackage(); // อัปเดตแพ็คเกจตามประเภทที่เซฟไว้
    };

    // เพิ่ม Event Listener สำหรับการเปลี่ยนแพ็กเกจ
    document.getElementById("package_a").addEventListener("change", updateDaysAndEndDate);
</script>

<?php
// ตรวจสอบว่า $item->date_end มีค่าหรือไม่
$dateStartValue = isset($item->date_end) ? $item->date_end : date('Y-m-d');
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dateStartInput = document.getElementById('date_start');
        const daySelect = document.getElementById('day_select');
        const dayInput = document.getElementById('day_input');

        // ตั้งค่าเริ่มต้นให้ date_start จาก PHP
        const initialDate = "<?= $dateStartValue ?>";
        dateStartInput.value = initialDate;

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

        // ฟังก์ชันอัปเดตวันสิ้นสุด
        function updateEndDate(days) {
            if (!isNaN(days)) {
                const startDate = new Date(dateStartInput.value);
                startDate.setDate(startDate.getDate() + days);
                document.getElementById('date_end').value = startDate.toISOString().split('T')[0];
            }
        }
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
                                             $accountsss=DB::table('tb_users_in')->where('id',@$accountss->id_user_in)->first();
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
                                                            $mail_r=@$accountsss->email01;
                                                            $pass_r=@$accountsss->password01;
                                                        }elseif($accountss->type_mail==2){
                                                            $mail_r=@$accountsss->email02;
                                                            $pass_r=@$accountsss->password02;
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
                 $user_r=App\Models\users::whereNotNull('type_netflix')->where('id','!=',@$item->id)->where('username',@$item->username)->where('password',@$item->password)->orderby('id','desc')->cursor();
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
                                             $accountsass=DB::table('tb_users_in')->where('id',@$accountsas->id_user_in)->first();
                                             $ch_his=DB::table('tb_users_in_in')->where('id_user',@$accountsas->id_user)
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
                                                            $mail_r=@$accountsass->email01;
                                                            $pass_r=@$accountsass->password01;
                                                        }elseif($accountsas->type_mail==2){
                                                            $mail_r=@$accountsass->email02;
                                                            $pass_r=@$accountsass->password02;
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


    <!-- <script>
    window.addEventListener('beforeunload', function (e) {
        // Send an AJAX request to Laravel route when the user is leaving the page
        fetch('{{ route('updateStatusOnExit') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token for security
            },
            body: JSON.stringify({
                userId: '{{ $item->id }}' // Pass the user ID dynamically
            })
        }).catch((error) => {
            console.log("Error:", error);
        });
    });
</script> -->

<script>
    window.addEventListener('load', function () {
        // หน่วงเวลา 3 วินาที (3000 มิลลิวินาที) ก่อนแสดงหน้า
        setTimeout(function () {
            // ทำการรีโหลดหน้าหรือให้มีการแสดงผลตามปกติ
            // โค้ดที่ต้องการให้ทำหลังจากหน่วงเวลา
        }, 3000);
    });

    window.addEventListener('beforeunload', function (e) {
        // ตรวจสอบว่าไม่ใช่การรีเฟรชหน้า
        if (performance.getEntriesByType("navigation")[0]?.type !== "reload") {
            fetch('{{ route('updateStatusOnExit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    userId: '{{ $item->id }}'
                })
            }).catch((error) => {
                console.log("Error:", error);
            });
        }
    });
</script>






    @endsection

    @section('script')


    @endsection