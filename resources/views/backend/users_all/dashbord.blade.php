@extends('layouts.menubar')
@section('content')
<style>
.button{border-radius: 25px;}
</style>

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
                        <h5 class="m-b-10">DASHBORD</h5>

                    </div>
                </div>
                <!-- Page-header end -->


                <style>
                                                    .status-active {
                                                        color: white;
                                                        background-color: #dc3545; /* สีแดง */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    .status-inactive {
                                                        color: white;
                                                        background-color: #28a745; /* สีเขียว */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    .status-expired {
                                                        color: white;
                                                        background-color: #6c757d; /* สีเทา */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    @keyframes beepEffect {
                                                            0% { opacity: 1; }
                                                            50% { opacity: 0; }
                                                            100% { opacity: 1; }
                                                        }

                                                        .h1, h1 {
                                                                font-size: 25px !important; /* นำ !important มาไว้ก่อน ; */
                                                            }

                                                        /* .beepbeep {
                                                            animation: beepEffect 2s infinite;
                                                            color: white; 
                                                            font-weight: bold; 
                                                        } */
                                                    </style>

                                                <style>
                                                        /* การตั้งค่ากล่องจตุรัส */
                                                        .flashing-card {
                                                            width: 500px;
                                                            height: 200px;
                                                            background-color: #f50505;  /* สีพื้นหลัง */
                                                            color: white;  /* สีข้อความ */
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            border-radius: 15px;  /* มุมโค้ง */
                                                            font-size: 20px;
                                                            font-weight: bold;
                                                            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);  /* เงาข้อความ */
                                                            box-shadow: 0 0 30px rgba(255, 0, 0, 0.8);  /* เงารอบๆ กล่อง */
                                                            animation: bounce 1s infinite; /* การกระพริบและการเด้ง */
                                                        }

                                                        .flashing-card2 {
                                                            width: 500px;
                                                            height: 200px;
                                                            background-color: #ffff00;  /* สีพื้นหลัง */
                                                            color: white;  /* สีข้อความ */
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            border-radius: 15px;  /* มุมโค้ง */
                                                            font-size: 20px;
                                                            font-weight: bold;
                                                            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);  /* เงาข้อความ */
                                                            box-shadow: 0 0 30px rgba(255, 0, 0, 0.8);  /* เงารอบๆ กล่อง */
                                                            animation: bounce 1s infinite; /* การกระพริบและการเด้ง */
                                                        }

                                                        .flashing-card3 {
                                                            width: 500px;
                                                            height: 200px;
                                                            background-color: #00ffff;  /* สีพื้นหลัง */
                                                            color: white;  /* สีข้อความ */
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            border-radius: 15px;  /* มุมโค้ง */
                                                            font-size: 20px;
                                                            font-weight: bold;
                                                            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);  /* เงาข้อความ */
                                                            box-shadow: 0 0 30px rgba(255, 0, 0, 0.8);  /* เงารอบๆ กล่อง */
                                                            animation: bounce 1s infinite; /* การกระพริบและการเด้ง */
                                                        }

                                                        /* การตั้งค่า Animation สำหรับการกระพริบ */
                                                        @keyframes flashing {
                                                            0% {
                                                                opacity: 1;
                                                                transform: scale(1);
                                                            }
                                                            50% {
                                                                opacity: 0.6;
                                                                transform: scale(1.05);  /* ขยายกล่องเล็กน้อย */
                                                            }
                                                            100% {
                                                                opacity: 1;
                                                                transform: scale(1);  /* กลับสู่ขนาดเดิม */
                                                            }
                                                        }

                                                        /* การตั้งค่า Animation สำหรับการเด้ง */
                                                        @keyframes bounce {
                                                            0%, 100% {
                                                                transform: translateY(0);
                                                            }
                                                            50% {
                                                                transform: translateY(-10px);  /* เด้งขึ้นเล็กน้อย */
                                                            }
                                                        }
                                                    </style>

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                <a style="color:white;" class="btn btn-info" href="{{url('his_dash')}}" target="_blank" > <i class="fa fa-plus"></i>ประวัติการยืนยัน</a>
                                        </div>
                                </div>
                                <div class="card-block">

                                <div style="overflow-x: auto; white-space: nowrap;">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="flashing-card">
                                                    <h1><i class="fa fa-user"></i> จำนวนคนที่หมดอายุ {{ number_format(@$nub, 0) }} คน </h1>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card2">
                                                    <h1><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 3 วัน {{ number_format(@$nub, 0) }} คน </h1>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card3">
                                                    <h1><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 7 วัน {{ number_format(@$nub, 0) }} คน </h1>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br><br><br>

                                    <div class="dt-responsive table-responsive">
                                        <h3><i class="fa fa-user"></i>จำนวนคนที่หมดอายุ {{ number_format(@$nub, 0) }} คน </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>วันหมดอายุ</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$accountsas)
                                            <?php
                                            $ddd = App\Models\users_in_in::pluck('id')->ToArray();
                                             $gub=DB::table('tb_users_in_in_history')->whereNotIn('id_user_in_in', $ddd)
                                             ->whereNull('status_check')->where('id','!=',$accountsas->id)->where('id_user_in',$accountsas->id_user_in)->get();
                                             $user=DB::table('tb_users')->where('id',@$accountsas->id_user)->first();
                                             $accountsass=DB::table('tb_users_in')->where('id',@$accountsas->id_user_in)->first();
                                            ?>

                                            <tr>
                                                    <td>{{$key+1}} 
                                                    <a href="{{url('day_his/'.$accountsas->id_user_in)}}" class="btn btn-danger" style="color:white;" onclick="javascript:return confirm('Confirm?')" >
                                                                <span >เปลี่ยนทั้งหมด</span>
                                                            </a> 

                                                    </td>
                                                    <!-- <td>
                                                        @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="หมดอายุแล้ว"></i>
                                                        @else
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="หมดอายุแล้ว"></i>
                                                        @endif
                                                    </td> -->

                                                    <td>{{@$user->username}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->line}}
                                                    @endforeach
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

                                                        <?php
                                                        $date_start=@$accountsass->created_at;
                                                        $date_end=@$accountsass->date_end;

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
                                                    <td>{{@$formatted_date1}}</td>
                                                    <td>{{@$formatted_date2}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <br><br><br><br>



                                    <div class="dt-responsive table-responsive">
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 3 วัน {{ number_format(@$nub, 0) }} คน </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>วันหมดอายุ</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($itemb as $key=>$accountsas)
                                            <?php
                                            $ddd = App\Models\users_in_in::pluck('id')->ToArray();
                                             $gub=DB::table('tb_users_in_in_history')->whereNotIn('id_user_in_in', $ddd)
                                             ->whereNull('status_check')->where('id','!=',$accountsas->id)->where('id_user_in',$accountsas->id_user_in)->get();
                                             $user=DB::table('tb_users')->where('id',@$accountsas->id_user)->first();
                                             $accountsass=DB::table('tb_users_in')->where('id',@$accountsas->id_user_in)->first();
                                            ?>

                                            <tr>
                                                    <td>{{$key+1}} 
                                                    <a href="{{url('day_his/'.$accountsas->id_user_in)}}" class="btn btn-danger" style="color:white;" onclick="javascript:return confirm('Confirm?')" >
                                                                <span >เปลี่ยนทั้งหมด</span>
                                                            </a> 

                                                    </td>
                                                    <!-- <td>
                                                        @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="หมดอายุแล้ว"></i>
                                                        @else
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="หมดอายุแล้ว"></i>
                                                        @endif
                                                    </td> -->

                                                    <td>{{@$user->username}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->line}}
                                                    @endforeach
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

                                                        <?php
                                                        $date_start=@$accountsass->created_at;
                                                        $date_end=@$accountsass->date_end;

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
                                                    <td>{{@$formatted_date1}}</td>
                                                    <td>{{@$formatted_date2}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <br><br><br><br>




                                    <div class="dt-responsive table-responsive">
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 7 วัน {{ number_format(@$nub, 0) }} คน </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>วันหมดอายุ</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($itemc as $key=>$accountsas)
                                            <?php
                                            $ddd = App\Models\users_in_in::pluck('id')->ToArray();
                                             $gub=DB::table('tb_users_in_in_history')->whereNotIn('id_user_in_in', $ddd)
                                             ->whereNull('status_check')->where('id','!=',$accountsas->id)->where('id_user_in',$accountsas->id_user_in)->get();
                                             $user=DB::table('tb_users')->where('id',@$accountsas->id_user)->first();
                                             $accountsass=DB::table('tb_users_in')->where('id',@$accountsas->id_user_in)->first();
                                            ?>

                                            <tr>
                                                    <td>{{$key+1}} 
                                                    <a href="{{url('day_his/'.$accountsas->id_user_in)}}" class="btn btn-danger" style="color:white;" onclick="javascript:return confirm('Confirm?')" >
                                                                <span >เปลี่ยนทั้งหมด</span>
                                                            </a> 

                                                    </td>
                                                    <!-- <td>
                                                        @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="หมดอายุแล้ว"></i>
                                                        @else
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="หมดอายุแล้ว"></i>
                                                        @endif
                                                    </td> -->

                                                    <td>{{@$user->username}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $user=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$user->line}}
                                                    @endforeach
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

                                                        <?php
                                                        $date_start=@$accountsass->created_at;
                                                        $date_end=@$accountsass->date_end;

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
                                                    <td>{{@$formatted_date1}}</td>
                                                    <td>{{@$formatted_date2}}</td>
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
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main-body end -->


        <div id="styleSelector">


        </div>
    </div>
</div>
</div>


@endsection

@section('script')


@endsection