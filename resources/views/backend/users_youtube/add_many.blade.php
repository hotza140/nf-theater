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

                                @if(@$id!=null)
                                <?php $acc=DB::table('tb_users_in')->where('id',@$id)->first();  ?>
                                <h3 style="color:red;">กำลังเพิ่มคนเข้า Account {{@$acc->name}}</h3>
                                @endif

                                </div>
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('y_users_store_many') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <input type="hidden" name="id" value="{{@$id}}">

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

                                        <div class="more_add">

                                        <div class="form-group row">
                                        
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username (User {{ $i + 1 }})*</label>
                                                <input type="text" name="users[{{ $i }}][username]" class="form-control" required  value="{{ @$run }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email</label>
                                                <input type="text" name="users[{{ $i }}][email]" class="form-control" required >
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="users[{{ $i }}][password]" class="form-control" required  value="{{ @$password }}" placeholder="รหัสผ่าน">
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


                                            <div class="col-sm-3" style="display:none;">
                                                <label class="col-form-label">Package*</label>
                                                <select name="users[{{ $i }}][type]" class="form-control" required onchange="updatePackage(this)">
                                                    <option value="MOBILE">จำนวนลูกค้า</option>
                                                    <!-- <option value="PC">TV</option> -->
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                            <label class="col-form-label">แพ็คเกจ*</label>
                                            <select name="users[{{ $i }}][package]" id="package" class="form-control" required>
                                                <!-- ตัวเลือกจะแสดงผลอัตโนมัติ -->
                                            </select>
                                        </div>

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
                                                <input type="date" name="users[{{ $i }}][date_start]" class="form-control date_start" data-index="{{ $i }}" required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="users[{{ $i }}][date_end]" class="form-control date_end" data-index="{{ $i }}" required >
                                            </div>
                                        </div>

                                        </div>

                                        <br><br>
                                    @endfor


                                    <?php 
$pag_PC = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00002')->where('type', 'PC')->orderBy('Subpackage_Dayuse', 'asc')->get();
$pag_MOBILE = DB::table('tb_package_subwatch')->where('package_Code', 'PNF-00002')->where('type', 'MOBILE')->orderBy('Subpackage_Dayuse', 'asc')->get();  
?>

<script>
    // สร้างอ็อบเจ็กต์สำหรับเก็บแพ็กเกจจาก PHP
    var packages = {
        PC: <?php echo json_encode($pag_PC->map(function($item) { return ['value' => $item->Subpackage_Name, 'text' => $item->Subpackage_Name, 'Subpackage_Dayuse' => $item->Subpackage_Dayuse]; })); ?>,
        MOBILE: <?php echo json_encode($pag_MOBILE->map(function($item) { return ['value' => $item->Subpackage_Name, 'text' => $item->Subpackage_Name, 'Subpackage_Dayuse' => $item->Subpackage_Dayuse]; })); ?>
    };

    function updatePackage(selectElement) {
    var formGroup = selectElement.closest('.more_add');
    var packageSelect = formGroup.querySelector("select[name^='users'][name$='[package]']");
    var dayInput = formGroup.querySelector("input[name^='users'][name$='[day]']");
    var dateEndInput = formGroup.querySelector("input[name^='users'][name$='[date_end]']"); // เพิ่ม Date End

    // Clear existing options
    if (packageSelect) {
        packageSelect.innerHTML = "";

        // Get packages based on selected value
        var options = packages[selectElement.value] || [];

        // Add options to the select
        options.forEach(option => {
            var opt = document.createElement("option");
            opt.value = option.value;
            opt.textContent = option.text;
            opt.setAttribute('data-day', option.Subpackage_Dayuse);
            packageSelect.appendChild(opt);
        });

        // Update the day input and Date End if options exist
        if (options.length > 0) {
            packageSelect.value = packageSelect.options[0].value; // Select first option
            var days = packageSelect.options[0].getAttribute('data-day');
            if (dayInput) {
                dayInput.value = days; // Update days
            }
            if (dateEndInput) {
                dateEndInput.value = calculateDateEnd(days); // อัปเดต Date End
            }
        } else {
            if (dayInput) dayInput.value = ''; // Clear day input if no options
            if (dateEndInput) dateEndInput.value = ''; // Clear Date End
        }

        // Add event listener for package selection change
        packageSelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var days = selectedOption.getAttribute('data-day');
            if (dayInput) {
                dayInput.value = days || ''; // Update days
            }
            if (dateEndInput) {
                dateEndInput.value = calculateDateEnd(days || 0); // อัปเดต Date End
            }
        });
    } else {
        console.error("Package select element not found!");
    }
}

// ฟังก์ชันคำนวณวันหมดอายุ (Date End)
function calculateDateEnd(days) {
    var today = new Date();
    today.setDate(today.getDate() + parseInt(days)); // บวกจำนวนวันที่ Subpackage_Dayuse
    return today.toISOString().split('T')[0]; // แปลงเป็นรูปแบบ YYYY-MM-DD
}

// เรียกใช้อัตโนมัติเมื่อหน้าโหลดเสร็จ
window.onload = function () {
    document.querySelectorAll("select[name^='users'][name$='[type]']").forEach(select => {
        updatePackage(select);
    });
};



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

    @endsection

    @section('script')


    @endsection