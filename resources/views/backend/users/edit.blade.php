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


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Profile</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="{{@$item->name}}">
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
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$password}}" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id=""  
                                                      value="{{@$item->email}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" id=""  maxlength = "10"
                                                      value="{{@$item->phone}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Line</label>
                                                <input type="text" name="line" class="form-control" id=""  
                                                      value="{{@$item->line}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Link Line</label>
                                                <input type="text" name="link_line" class="form-control" id=""  
                                                      value="{{@$item->link_line}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package*</label>
                                        <select name="type" id="type" class="form-control add_select2" required  >
                                        <option value="MOBILE" @if(@$item->type=='MOBILE') selected  @endif >ยกเว้นทีวี</option>
                                        <option value="PC" @if(@$item->type=='PC') selected  @endif >TV</option>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="form-group row">
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

                <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const dateStartInput = document.getElementById('date_start');
                    const dateEndInput = document.getElementById('date_end');
                    const dayInput = document.getElementById('day_input');

                    // ตั้งค่าวันที่เริ่มต้นเป็นวันนี้
                    const today = new Date().toISOString().split('T')[0];
                    dateStartInput.value = today;

                    // ฟังก์ชันคำนวณวันที่สิ้นสุดเมื่อผู้ใช้กรอกจำนวนวัน
                    dayInput.addEventListener('input', () => {
                        const enteredDays = parseInt(dayInput.value, 10);

                        // ตรวจสอบว่าผู้ใช้กรอกตัวเลขถูกต้อง
                        if (!isNaN(enteredDays) && enteredDays > 0) {
                            const startDate = new Date(dateStartInput.value);

                            // คำนวณวันสิ้นสุด
                            const endDate = new Date(startDate);
                            endDate.setDate(startDate.getDate() + enteredDays);

                            // ตั้งค่าค่าวันที่สิ้นสุด
                            dateEndInput.value = endDate.toISOString().split('T')[0];
                        } else {
                            // ล้างค่าของ date_end หากกรอกตัวเลขไม่ถูกต้อง
                            dateEndInput.value = '';
                        }
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
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">Account ที่เชื่อมต่อ</h1>
                                <br><br>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>

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
                                                    <td>{{@$accountsss->name}}</td>
                                                    <td>{{@$accountsss->email}}</td>
                                                    <td>{{@$accountsss->password}}</td>
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


            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>



    @endsection

    @section('script')


    @endsection