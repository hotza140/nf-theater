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
                                            <label class="col-form-label">รูปแบบ*</label>
                                            <select name="users[{{ $i }}][type]"  class="form-control" required  >
                                            <option value="MOBILE" >ยกเว้นทีวี</option>
                                            <option value="PC" >TV</option>
                                            </select>
                                            </div>

                                            <div class="col-sm-3">
                                            <label class="col-form-label">Package*</label>
                                            <select name="users[{{ $i }}][package]" class="form-control add_select2" required>
                                            <option value="30 วัน" >30 วัน</option>
                                            <option value="60 วัน"  >60 วัน</option>
                                            <option value="90 วัน"  >90 วัน</option>
                                            <option value="120 วัน" >120 วัน</option>
                                            <option value="180 วัน" >180 วัน</option>
                                            <option value="365 วัน" >365 วัน</option>
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