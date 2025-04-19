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
                                                       .flashing-card {
                                                            width: 350px;
                                                            height: 200px;
                                                            background-color: #800020; /* สีเลือดหมู */
                                                            color: white;
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            border-radius: 20px;
                                                            font-size: 12px;
                                                            font-weight: bold;
                                                            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
                                                            box-shadow: 0 10px 25px rgba(128, 0, 32, 0.6);
                                                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                                                            margin-bottom: 20px; /* ✅ เพิ่มระยะห่างด้านล่างของกล่อง */
                                                        }

                                                        .flashing-card:hover {
                                                            transform: scale(1.03);
                                                            box-shadow: 0 15px 30px rgba(128, 0, 32, 0.75);
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

                                    <?php  
                                        $e1 = App\Models\users_in::where('open',0)->whereNull('type_f')->pluck('id')->ToArray();

                                        $na = App\Models\users_in::where('open',0)->whereNull('type_f')->count();

                                        $aa=$na*5;
                                        $bb=$na*2;

                                        $in = App\Models\users_in_in::whereNull('type_mail')->whereIn('id_user_in',@$e1)->count();
                                        $q1=$aa-$in;

                                        $inn = App\Models\users_in_in::whereNotNull('type_mail')->whereIn('id_user_in',@$e1)->count();
                                        $q2=$bb-$inn;

                                        ?>

                                        <tr>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนที่ว่าง ยกเว้น TV: ({{ number_format(@$q1, 0) }} ที่) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนที่ว่าง TV: ({{ number_format(@$q2, 0) }} ที่) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-box"></i> จำนวน Account ที่ใกล้หมดอายุ 1 วัน: ({{ number_format(@$acc, 0) }}) </h4>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                        <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่หมดอายุ: ({{ number_format(@$nub, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 3 วัน: ({{ number_format(@$nubb, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 2 วัน: ({{ number_format(@$nubc, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 1 วัน: ({{ number_format(@$nubd, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- <tr>
                                            <td>
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่หมดอายุ: ({{ number_format(@$nub, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                        </tr> -->


                                       

                                    </table>
                                </div>
                                <br><br><br>

                                    <div class="dt-responsive table-responsive">
                                        <h3><i class="fa fa-user"></i>จำนวนคนที่หมดอายุ ({{ number_format(@$nub, 0) }} คน) </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Line Link</th>
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
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
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
                                                        $date_start=@$accountsas->created_at;
                                                        $date_end=@$accountsas->date_end;

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
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 3 วัน ({{ number_format(@$nubb, 0) }} คน) </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Line Link</th>
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
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
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
                                                        $date_start=@$accountsas->created_at;
                                                        $date_end=@$accountsas->date_end;

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
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 2 วัน ({{ number_format(@$nubc, 0) }} คน) </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Line Link</th>
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
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
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
                                                        $date_start=@$accountsas->created_at;
                                                        $date_end=@$accountsas->date_end;

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





                                <br><br><br><br>




                                    <div class="dt-responsive table-responsive">
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 1 วัน ({{ number_format(@$nubd, 0) }} คน) </h3>
                                        <table id="" class="table table-striped table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>Line</th>
                                                    <th>Line Link</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>วันหมดอายุ</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($itemd as $key=>$accountsas)
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
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->username}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{@$user->name}}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{@$useraa->name}}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
                                                    @endforeach
                                                    </td>

                                                    <td>{{ \Illuminate\Support\Str::limit(@$user->line, 20) }}
                                                    @foreach($gub as $key=>$gubs)
                                                    <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                    <br>
                                                    {{ \Illuminate\Support\Str::limit(@$useraa->line, 20) }}
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
                                                        $date_start=@$accountsas->created_at;
                                                        $date_end=@$accountsas->date_end;

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