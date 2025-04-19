@extends('layouts.menubar')
@section('content')
<style>
.button {
    border-radius: 25px;
}
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

input:checked+.slider {
    background-color: #93D600;
    /* ใช้สีเขียวตามความชอบ */
}

input:checked+.slider:before {
    transform: translateX(25px);
}
</style>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">


                <style>
                .status-active {
                    color: white;
                    background-color: #dc3545;
                    /* สีแดง */
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                .status-inactive {
                    color: white;
                    background-color: #28a745;
                    /* สีเขียว */
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                .status-expired {
                    color: white;
                    background-color: #6c757d;
                    /* สีเทา */
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                @keyframes beepEffect {
                    0% {
                        opacity: 1;
                    }

                    50% {
                        opacity: 0;
                    }

                    100% {
                        opacity: 1;
                    }
                }

                .h1,
                h1 {
                    font-size: 25px !important;
                    /* นำ !important มาไว้ก่อน ; */
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
                    background-color: #800020;
                    /* สีเลือดหมู */
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
                    margin-bottom: 20px;
                    /* ✅ เพิ่มระยะห่างด้านล่างของกล่อง */
                }

                .flashing-card:hover {
                    transform: scale(1.03);
                    box-shadow: 0 15px 30px rgba(128, 0, 32, 0.75);
                }

                #table-container>.dt-responsive {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    display: none;
                    /* ซ่อนทั้งหมดก่อน */
                }

                #table-container>.dt-responsive.active {
                    display: block;
                    /* โชว์ตัวที่ต้องการ */
                }

                .toggle-btn {
                    cursor: pointer;
                    /* แสดงเป็นรูปมือเมื่อเลื่อนไปที่ปุ่ม */
                }

    /* เลือกปุ่มที่มีไอคอน fa-copy อยู่ข้างใน */
    button.btn.btn-sm.btn-primary:has(i.fa-copy) {
        padding: 2px 6px;
        font-size: 12px;
        line-height: 1;
        height: auto;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
                </style>

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                    <a style="color:white;" class="btn btn-info" href="{{url('his_dash_y')}}"
                                        target="_blank"> <i class="fa fa-plus"></i>ประวัติการยืนยัน</a>
                                </div>
                            </div>


                            <div class="card-block">

                                <div style="overflow-x: auto; white-space: nowrap;">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="flashing-card toggle-btn" data-target="#table-expired">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่หมดอายุ:
                                                        ({{ number_format(@$nub, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card toggle-btn"
                                                    data-target="#table-expired-3days">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 3 วัน:
                                                        ({{ number_format(@$nubb, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card toggle-btn"
                                                    data-target="#table-expired-2days">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 2 วัน:
                                                        ({{ number_format(@$nubc, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card toggle-btn" data-target="#table-expired-1days">
                                                    <h4><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 1 วัน:
                                                        ({{ number_format(@$nubd, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="{{url('y_users_in?_token=2dmZjV3LHJYWy2zQ9zoObRZu6k17bmSYl9wPiLEL&status_account=11&search=')}}">
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนบ้านปกติ:
                                                        ({{ number_format(@$acc, 0) }} บ้าน) </h4>
                                                </div>
                                                </a>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                            <a href="{{url('y_users_in?_token=2dmZjV3LHJYWy2zQ9zoObRZu6k17bmSYl9wPiLEL&status_account=22&search=')}}">
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนบ้านบล็อก:
                                                        ({{ number_format(@$acc_a, 0) }} บ้าน) </h4>
                                                </div>
                                                </a>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                            <a href="{{url('y_users_in?_token=2dmZjV3LHJYWy2zQ9zoObRZu6k17bmSYl9wPiLEL&status_account=33&search=')}}">
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนบ้านอุทธรณ์:
                                                        ({{ number_format(@$acc_b, 0) }} บ้าน) </h4>
                                                </div>
                                                </a>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                            <a href="{{url('y_users_in?_token=2dmZjV3LHJYWy2zQ9zoObRZu6k17bmSYl9wPiLEL&status_account=44&search=')}}">
                                                <div class="flashing-card">
                                                    <h4><i class="fa fa-user"></i> จำนวนบ้านต่ออายุ:
                                                        ({{ number_format(@$acc_c, 0) }} บ้าน) </h4>
                                                </div>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br><br><br>

                                <div id="table-container" style="position: relative; min-height: 300px;">

                                    <div class="dt-responsive table-responsive" id="table-expired">
                                        <h3><i class="fa fa-user"></i>จำนวนคนที่หมดอายุ ({{ number_format(@$nub, 0) }}
                                            คน) </h3>
                                        <table class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Email User</th>
                                                    <th>Line</th>
                                                    <th>Link Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <!-- <th>Password</th> -->
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
                                                        <a href="{{url('day_his/'.$accountsas->id_user_in)}}"
                                                            class="btn btn-danger" style="color:white;"
                                                            onclick="javascript:return confirm('Confirm?')">
                                                            <span>เปลี่ยนทั้งหมด</span>
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

                                                    <td>{{@$user->email}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->email}}
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->line}}
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$user->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$useraa->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$accountsass->name}}</td>
                                                    @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                    <td>{{@$accountsass->email}}</td>
                                                    <!-- <td>{{@$accountsass->password}}</td> -->
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



                                    <div class="dt-responsive table-responsive" id="table-expired-3days">
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 3 วัน
                                            ({{ number_format(@$nubb, 0) }} คน) </h3>
                                        <table class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Email User</th>
                                                    <th>Line</th>
                                                    <th>Link Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <!-- <th>Password</th> -->
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
                                                        <a href="{{url('day_his/'.$accountsas->id_user_in)}}"
                                                            class="btn btn-danger" style="color:white;"
                                                            onclick="javascript:return confirm('Confirm?')">
                                                            <span>เปลี่ยนทั้งหมด</span>
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

                                                    <td>{{@$user->email}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->email}}
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->line}}
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$user->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$useraa->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$accountsass->name}}</td>
                                                    @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                    <td>{{@$accountsass->email}}</td>
                                                    <!-- <td>{{@$accountsass->password}}</td> -->
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




                                    <div class="dt-responsive table-responsive" id="table-expired-2days">
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 2 วัน
                                            ({{ number_format(@$nubc, 0) }} คน) </h3>
                                        <table class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Email User</th>
                                                    <th>Line</th>
                                                    <th>Link Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <!-- <th>Password</th> -->
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
                                                        <a href="{{url('day_his/'.$accountsas->id_user_in)}}"
                                                            class="btn btn-danger" style="color:white;"
                                                            onclick="javascript:return confirm('Confirm?')">
                                                            <span>เปลี่ยนทั้งหมด</span>
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

                                                    <td>{{@$user->email}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->email}}
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->line}}
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$user->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$useraa->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$accountsass->name}}</td>
                                                    @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                    <td>{{@$accountsass->email}}</td>
                                                    <!-- <td>{{@$accountsass->password}}</td> -->
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




                                    <div class="dt-responsive table-responsive" id="table-expired-1days">
                                        <h3><i class="fa fa-user"></i> จำนวนคนที่ใกล้หมดอายุ 1 วัน
                                            ({{ number_format(@$nubd, 0) }} คน) </h3>
                                        <table class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Username</th>
                                                    <th>Email User</th>
                                                    <th>Line</th>
                                                    <th>Link Line</th>
                                                    <th>Name Account</th>
                                                    <th>Email</th>
                                                    <!-- <th>Password</th> -->
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
                                                        <a href="{{url('day_his/'.$accountsas->id_user_in)}}"
                                                            class="btn btn-danger" style="color:white;"
                                                            onclick="javascript:return confirm('Confirm?')">
                                                            <span>เปลี่ยนทั้งหมด</span>
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

                                                    <td>{{@$user->email}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->email}}
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$user->line}}
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        {{@$useraa->line}}
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$user->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @foreach($gub as $key=>$gubs)
                                                        <?php
                                                    $useraa=DB::table('tb_users')->where('id',@$gubs->id_user)->first();
                                                    $accountsass=DB::table('tb_users_in')->where('id',@$gubs->id_user_in)->first();
                                                    ?>
                                                        <br>
                                                        
                                                            {{ \Illuminate\Support\Str::limit(@$useraa->link_line, 20) }}
                                                            <button class="btn btn-sm btn-primary"
                                                                onclick="copyUserInfo('{{$user->link_line}}')">
                                                                <i class="fa fa-copy"></i> Copy
                                                            </button>
                                                        
                                                        @endforeach
                                                    </td>

                                                    <td>{{@$accountsass->name}}</td>
                                                    @if($accountsas->type=='MOBILE' or $accountsas->type=='')
                                                    <td>{{@$accountsass->email}}</td>
                                                    <!-- <td>{{@$accountsass->password}}</td> -->
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

<script>
$(document).ready(function() {
    // ซ่อนตารางทั้งหมดก่อน ยกเว้น table-expired
    $('#table-expired').show();
    $('#table-expired-3days, #table-expired-2days, #table-expired-1days').hide();

    // เมื่อคลิกที่หัวข้อให้แสดงเฉพาะตารางที่เกี่ยวข้อง
    $('.toggle-btn').click(function() {
        var targetTable = $(this).data('target');
        $('div[id^="table-expired"]').hide(); // ซ่อนทุกตารางที่ชื่อขึ้นต้นด้วย table-expired
        $(targetTable).show(); // แสดงเฉพาะตารางที่คลิก
    });
});
</script>


<script>
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        document.execCommand("copy");
        // alert("คัดลอกข้อมูลสำเร็จ!");
    } catch (err) {
        console.error("คัดลอกไม่สำเร็จ: ", err);
        alert("คัดลอกไม่สำเร็จ กรุณาลองอีกครั้ง");
    }
    document.body.removeChild(textArea);
}

function copyUserInfo(link_line) {
    let textToCopy = link_line;;

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


@endsection