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
                        <h5 class="m-b-10">USERS YOUTUBE /ADD</h5>

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
                                    <?php $item=DB::table('tb_users')->where('id',@$check)->first(); ?>

                                </div>
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('y_users_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        
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
                                                <label class="col-form-label">Email</label>
                                                <input type="text" name="email" class="form-control" id=""
                                                      value="{{@$item->email}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id=""  maxlength = "150"
                                                      value="{{@$run}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password</label>
                                                <input type="text" name="password" class="form-control" id=""  value="{{@$password}}" placeholder="รหัสผ่าน" >
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


                                        <div class="form-group row">

                                        <div class="col-sm-3" style="display:none;">
                                        <label class="col-form-label">Package*</label>
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

                                        <?php
                                        $date_s=date('Y-m-d');
                                        if(@$item->date_start!=null){
                                            $date_s=@$item->date_start;
                                        }

                                        ?>

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
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id="date_start"
                                                      value="{{@$item->date_start}}" readonly required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                      value="{{@$item->date_end}}" readonly required >
                                            </div>
                                        </div>

                                     


                                        <p class="text-right">
                                            <a href="{{ url('y_users') }}"
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
            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>


    <?php 
                                        $pag_PC=DB::table('tb_package_subwatch')->where('package_Code','PNF-00002')->where('type','PC')->orderBy('Subpackage_Dayuse','asc')->get();
                                        $pag_MOBILE=DB::table('tb_package_subwatch')->where('package_Code','PNF-00002')->where('type','MOBILE')->orderBy('Subpackage_Dayuse','asc')->get();  
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

        function updateEndDate(days) {
            if (!isNaN(days) && days > 0) {
                const startDate = new Date(dateStartInput.value);
                startDate.setDate(startDate.getDate() + days);
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


    @endsection

    @section('script')


    @endsection