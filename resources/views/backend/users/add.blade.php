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
                        <h5 class="m-b-10">USERS/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('users_store') }}"
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


                                        <div class="form-group row">

                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package*</label>
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
                                            <a href="{{ url('users') }}"
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

    @endsection

    @section('script')


    @endsection