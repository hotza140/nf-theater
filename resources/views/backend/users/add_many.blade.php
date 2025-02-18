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

                                    <form method="post" id="" action="{{ url('users_store_many') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->

                                        @for ($i = 0; $i < $number; $i++)

                                        <h5 class="m-b-10">ลำดับที่ {{$i+1}}</h5>

                                        <?php
                                        $runnum=DB::table('tb_users')->orderby('id','desc')->count();
                                        
                                        if($i>0){
                                            $runtotal=$runtotal+1;
                                        }else{
                                            $runtotal=$runnum+1;
                                        }
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
                                                <label class="col-form-label">Username (User {{ $i + 1 }})*</label>
                                                <input type="text" name="users[{{ $i }}][username]" class="form-control" required value="{{ @$run }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Name Profile</label>
                                                <input type="text" name="users[{{ $i }}][name]" class="form-control" >
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="users[{{ $i }}][password]" class="form-control" required value="{{ @$password }}" placeholder="รหัสผ่าน">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" name="users[{{ $i }}][phone]" class="form-control" maxlength="10" placeholder="เบอร์โทรศัพท์ (ถ้ามี)">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ชื่อไลน์ลูกค้า</label>
                                                <input type="text" name="users[{{ $i }}][line]" class="form-control">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">ลิงก์ไลน์ลูกค้า</label>
                                                <input type="text" name="users[{{ $i }}][link_line]" class="form-control">
                                            </div>


                                            <div class="col-sm-3">
                                                <label class="col-form-label">Package*</label>
                                                <select name="users[{{ $i }}][type]" class="form-control" required onchange="updatePackage(this)">
                                                    <option value="MOBILE">ยกเว้นทีวี</option>
                                                    <option value="PC">TV</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                            <label class="col-form-label">แพ็คเกจ*</label>
                                            <select name="users[{{ $i }}][package]" id="package" class="form-control" required>
                                                <!-- ตัวเลือกจะแสดงผลอัตโนมัติ -->
                                            </select>
                                        </div>

                                        <script>
                                        function updatePackage(selectElement) {
                                            var formGroup = selectElement.closest('.form-group'); // ค้นหาฟอร์มที่เกี่ยวข้อง
                                            var packageSelect = formGroup.querySelector("select[name^='users'][name$='[package]']");
                                            var selectedPackage = "{{ @$item->package }}"; // ค่าที่เลือกไว้ในฐานข้อมูล

                                            // ล้างค่าเดิม
                                            packageSelect.innerHTML = "";

                                            // กำหนดตัวเลือกแพ็กเกจ
                                            var options;
                                            if (selectElement.value === "PC") {
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

                                            // เพิ่ม option ลงใน select
                                            options.forEach(option => {
                                                var opt = document.createElement("option");
                                                opt.value = option.value;
                                                opt.textContent = option.text;
                                                if (option.value === selectedPackage) {
                                                    opt.selected = true;
                                                }
                                                packageSelect.appendChild(opt);
                                            });
                                        }

                                        // เรียกใช้อัตโนมัติเมื่อหน้าโหลดเสร็จ
                                        window.onload = function () {
                                            document.querySelectorAll("select[name^='users'][name$='[type]']").forEach(select => {
                                                updatePackage(select); // โหลดค่าเริ่มต้น
                                            });
                                        };
                                    </script>


                                            </div>

                                            <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Select Days</label>
                                                <select class="form-control day_select" data-index="{{ $i }}">
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
                                                <input type="number" class="form-control day_input" name="users[{{ $i }}][day]" placeholder="Enter number of days" required data-index="{{ $i }}">
                                            </div>

                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="users[{{ $i }}][date_start]" class="form-control date_start" data-index="{{ $i }}" required readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="users[{{ $i }}][date_end]" class="form-control date_end" data-index="{{ $i }}" required readonly>
                                            </div>
                                        </div>

                                        <br><br>
                                    @endfor

                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            document.querySelectorAll('.date_start').forEach((input) => {
                                                const index = input.dataset.index;
                                                const today = new Date().toISOString().split('T')[0];
                                                input.value = today;

                                                const updateEndDate = (index, days) => {
                                                    if (!isNaN(days) && days > 0) {
                                                        const startDate = new Date(document.querySelector(`.date_start[data-index="${index}"]`).value);
                                                        startDate.setDate(startDate.getDate() + days);
                                                        document.querySelector(`.date_end[data-index="${index}"]`).value = startDate.toISOString().split('T')[0];
                                                    } else {
                                                        document.querySelector(`.date_end[data-index="${index}"]`).value = '';
                                                    }
                                                };

                                                document.querySelector(`.day_select[data-index="${index}"]`).addEventListener('change', function() {
                                                    document.querySelector(`.day_input[data-index="${index}"]`).value = this.value;
                                                    updateEndDate(index, parseInt(this.value, 10));
                                                });

                                                document.querySelector(`.day_input[data-index="${index}"]`).addEventListener('input', function() {
                                                    updateEndDate(index, parseInt(this.value, 10));
                                                });

                                                input.addEventListener('change', function() {
                                                    updateEndDate(index, parseInt(document.querySelector(`.day_input[data-index="${index}"]`).value, 10));
                                                });
                                            });
                                        });
                                    </script>

                                     


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

    @endsection

    @section('script')


    @endsection