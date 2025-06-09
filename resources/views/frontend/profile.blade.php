@extends('frontend.layouts.frontendbase')
@section('contentfront')

<div class="net-container">
    <h1 class="head-pro">NF THEATER</h1>
    <div class="profile-plans">
        <button class="btn btn-primary logout-bt" type="button"
            onclick="document.location.href=`{{url('profile_change')}}`;">
            </svg>สลับโปรไฟล์/แพ็กเกจ</button>&nbsp; <!--Change Profile-->

        <button class="btn btn-primary logout-bt" type="button"
            onclick="document.location.href=`{{route('logoutfrontend')}}`;">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                style="margin-right: 5px;">
                <path
                    d="M8.51428 20H4.51428C3.40971 20 2.51428 19.1046 2.51428 18V6C2.51428 4.89543 3.40971 4 4.51428 4H8.51428V6H4.51428V18H8.51428V20Z"
                    fill="currentColor"></path>
                <path
                    d="M13.8418 17.385L15.262 15.9768L11.3428 12.0242L20.4857 12.0242C21.038 12.0242 21.4857 11.5765 21.4857 11.0242C21.4857 10.4719 21.038 10.0242 20.4857 10.0242L11.3236 10.0242L15.304 6.0774L13.8958 4.6572L7.5049 10.9941L13.8418 17.385Z"
                    fill="currentColor"></path>
            </svg>logout</button>
    </div>


    <div class="container profile-plans-white" style="padding-right: 24px;">
        <div class="row">
            <div class="col-12 col-sm-2 d-flex d-sm-flex justify-content-center align-items-sm-center">
                <div class="img-profile-a">
                    <img class="net-profile-icon imgprofileIS" src="assets/img/Frame%201%20(1).png" alt="Netflix Icon">
                    <div class="edit-icon"><a data-bs-target="#modal-edit-img01" data-bs-toggle="modal"><button
                                class="btn btn-primary edit-bt" type="button" style="padding: 6px;"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    viewBox="0 0 16 16" class="bi bi-pencil">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z">
                                    </path>
                                </svg></button></a></div>
                </div>
            </div>
            <div class="col d-flex align-items-center">
                <div class="net-plan-details">

                    <?php 
                    $c_dd=date('Y-m-d');
                                $pak=DB::table('tb_users_in_in')->whereDate('date_start','<=',@$c_dd)->where('id_user',@$userProfile->id)->first();
                                $ac=DB::table('tb_users_in')->where('id',@$pak->id_user_in)->first();
                                ?>

                    {{-- @if(@$selectNfYt=='NetFlix') --}}
                    <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Username :</b>
                        {{@$users->username}}</h2>
                    @if(@$userProfile->type_netflix==1)
                    <div id="showUNetflix">
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Profile :</b>
                            {{@$userProfile->utypename}}</h2>
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Package :</b>
                            @if(@$pak->date_start!=null){{@$userProfile->Subpackage_Name}} @else ยังไม่มี @endif</h2>


                        <!-- <br> -->
                        @if(@$userProfile->type_mail==null)

                        <h2 class="pack-h2" style="color:red;"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Account ID :</b>
                            {{@$ac->email}}</h2><span class="name-profile"
                            style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>

                            <h2 class="pack-h2" style="color:red;" ><i class="fas fa-user" style="margin-right: 5px;"></i><b>Password :</b>
                            {{@$ac->password}}</h2><span class="name-profile"
                            style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>

                        <!-- <h2 class="pass-profile">Password : {{@$ac->password}}<span id="passwordnf"></span></h2> -->

                        @else

                        @if(@$pak->type_mail==1)
                        <h2 class="pack-h2" style="color:red;"><i class="fas fa-user" style="margin-right: 5px;color:red;"></i><b>Account ID :</b>
                            {{@$ac->email01}}</h2><span class="name-profile"
                            style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>

                            <h2 class="pack-h2" style="color:red;" ><i class="fas fa-user" style="margin-right: 5px;"></i><b>Password :</b>
                            {{@$ac->password01}}</h2><span class="name-profile"
                            style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>


                        <!-- <h2 class="pass-profile">Password : {{@$ac->password01}}<span id="passwordnf"></span></h2> -->
                        @else
                        <h2 class="pack-h2" style="color:red;"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Account ID :</b>
                            {{@$ac->email02}}</h2><span class="name-profile"
                            style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>

                            <h2 class="pack-h2" style="color:red;" ><i class="fas fa-user" style="margin-right: 5px;"></i><b>Password :</b>
                            {{@$ac->password02}}</h2><span class="name-profile"
                            style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>


                        <!-- <h2 class="pass-profile">Password : {{@$ac->password02}}<span id="passwordnf"></span></h2> -->
                        @endif

                        @endif

                        <?php
                        $today = date('Y-m-d');
                        $date_start = date('Y-m-d');
                                // $date_start = @$pak->date_start; // วันที่เริ่มต้น (Y-m-d)
                                $date_end = @$pak->date_end; // วันที่สิ้นสุด (Y-m-d)
                                

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

                        @if(@$pak->date_start!=null)
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>วันสิ้นสุด</b> {{@$formatted_date2}} </h2>
                        @endif
                    </div>
                    @endif
                    {{-- @if(@$selectNfYt=='YouTube') --}}
                    @if(@$userProfile->type_youtube==1)
                    <div id="showUYoutube">
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Youtube Package.</h2>
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Email :</b> <!--Profile-->
                            {{@$userProfile->useremail}}</h2>
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>Package :</b>
                            @if(@$pak->date_start!=null){{@$userProfile->Subpackage_Name}} @else ยังไม่มี @endif</h2>
                        <!--<p class="mail-profile">Account Email: : {{--@$ac->email--}}<span id="emailYT"></span></p>-->
                        <!--nftheater134+27@gmail.com-->
                        <!--<p class="pass-profile">Password : {{--@$ac->password--}}<span id="passYT"></span></p>-->
                        <!--0123456-->

                        <?php
                        $today = date('Y-m-d');
                        $date_start = date('Y-m-d');
                                                    // $date_start = @$pak->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    $date_end = @$pak->date_end; // วันที่สิ้นสุด (Y-m-d)
                                                     // วันที่ปัจจุบัน

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

                        @if(@$pak->date_start!=null)
                        <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i><b>วันสิ้นสุด</b> {{@$formatted_date2}} </h2>
                        @endif

                    </div>
                    @endif

                </div>
            </div>
            @php
                $userspoint = Auth::guard('users')->user();
                $PointSumbalance = App\Models\PointSumbalance::where('usernamepoint',$userspoint->username)->first();
            @endphp
            <div class="col-12 col-sm-3 d-flex d-sm-flex justify-content-center justify-content-sm-center align-items-sm-center box-back"
                style="padding-left: 5px;">
                <div class="net-plan-point"
                    style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                    <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span
                            style="height: auto;margin-top: -10px;text-align: center;">คะแนนสะสม</span></div>
                    <div style="margin: 0;padding: 0;height: auto;">
                        <p class="net-point" style="text-align: center;height: auto;">{{@$PointSumbalance->point_balance??0}}</p>
                    </div>
                    <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><button
                            class="btn btn-primary profile-hit" type="button" data-bs-target="#modal-history"
                            data-bs-toggle="modal">ประวัติการแลกแต้ม<svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" fill="currentColor" viewBox="0 0 16 16"
                                class="bi bi-arrow-up-right-circle-fill" style="margin-left: 5px;">
                                <path
                                    d="M0 8a8 8 0 1 0 16 0A8 8 0 0 0 0 8m5.904 2.803a.5.5 0 1 1-.707-.707L9.293 6H6.525a.5.5 0 1 1 0-1H10.5a.5.5 0 0 1 .5.5v3.975a.5.5 0 0 1-1 0V6.707z">
                                </path>
                            </svg></button></div>
                </div>
            </div>
        </div>
    </div>

</div>

@if(@$pak->date_start!=null)
<div class="net-container">
    <h1 class="head-pack" style="font-family: Prompt, sans-serif;">ข้อมูลแพ็กเกจ</h1>
    <div class="net-plans">
        {{-- @if(@$selectNfYt=='NetFlix') --}}
        @if(@$userProfile->type_netflix==1)
        <div class="net-plan">
            <div class="net-plan-info"><img src="assets/img/logo-netflix%201.png" alt="Netflix Icon"
                    class="net-plan-icon">
                <div class="net-plan-details">
                    <h2>แพ็กเกจ NETFLIX</h2>
                    <p id="namePackageShNF">{{@$userProfile->Subpackage_Name}}</p>
                    <!--Netflix ยาวนานถึง 2 เดือน-->
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px; width: 110px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;" id="priceShNF">
                    {{number_format($userProfile->Subpackage_Paymoney, 0, '.', ',') }}</p>
                    <!--269-->
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span
                        style="height: auto;margin-top: -10px;"> บาท</span></div>
            </div>
        </div>
        @endif
        {{-- @if(@$selectNfYt=='YouTube') --}}
        @if(@$userProfile->type_youtube==1)
        <div class="net-plan2">
            <div class="net-plan-info"><img src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon"
                    class="net-plan-icon">
                <div class="net-plan-details">
                    <h2 class="pack-h2">แพ็กเกจ Youtube</h2>
                    <p class="pack-h3" id="namePackageShYT">{{@$userProfile->Subpackage_Name}}</p>
                    <!--Youtube ยาวนานถึง 2 เดือน-->
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;" id="priceShYT">{{
                        number_format($userProfile->Subpackage_Paymoney, 0, '.', ',') }}</p>
                    <!--269-->
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span
                        style="height: auto;margin-top: -10px;"> บาท</span></div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif


<div class="d-link">
    <div class="d-link-in2">
        @if(@$pak->date_start!=null)
            {{-- @if(@$selectNfYt=='NetFlix') --}}
            @if(@$userProfile->type_netflix==1)
                <div class="box-link-m"><a href="{{route('frontend.netflix')}}?id=1"><img src="assets/img/NF22%20(1).png"></a></div>
            @else
                <div class="box-link-m"><a href="{{route('frontend.youtube')}}?id=2"><img src="assets/img/NF11%20(1).png"></a></div>
            @endif
            @php
                $checknetflixnoHave = 0;
                $checkyoutubenoHave = 0;
                if(@$userProfile->type_netflix==1) {
                    $usersckis = App\Models\users::where('type_youtube',1)->where('username',$userProfile->username)->first();
                    if(!@$usersckis) $checkyoutubenoHave = 1;
                } else {
                    $usersckis = App\Models\users::where('type_netflix',1)->where('username',$userProfile->username)->first();
                    if(!@$usersckis) $checknetflixnoHave = 1;
                }
            @endphp
            @if(!@$usersckis)
                <div class="box-link-m" style="text-align: center;">
                    {{-- <span><b>{{$checkyoutubenoHave ? 'Youtube' : ($checknetflixnoHave ? 'Netflix' : '')}}</b></span> --}}
                    <a class="cursor-box" href="https://lin.ee/4V1Jzlj" target="_blank">
                        <img src="assets/img/{{$checkyoutubenoHave ? 'ss2.png' : ($checknetflixnoHave ? 'ss3.png' : '')}}">
                    </a>
                </div>
            @endif
        @else
            <div class="box-link-m"><a class="cursor-box" href="https://lin.ee/4V1Jzlj" target="_blank"><img src="assets/img/NF7%20(1).png"></a></div><!--ต้องเอาไลน์ OA มาแสดง-->
        @endif
        <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-member" data-bs-toggle="modal"><img
                    src="assets/img/NF3%20(1).png"></a></div>
        {{-- <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-repoints" data-bs-toggle="modal"><img
                    src="assets/img/NF5%20(1).png"></a></div> onclick="shareAndCopyTF(`https://lin.ee/jgB0ld5`);" --}}
        <div class="box-link-m"><a class="cursor-box" href="javascript:;" onclick="shareAndCopyTF(`https://lin.ee/jgB0ld5`);"><img 
                    src="assets/img/NF5%20(1).png"></a></div> 
        <div class="box-link-m"><a class="cursor-box" data-bs-toggle="modal" data-bs-target="#modal-points"><img
                    src="assets/img/NF4%20(1).png"></a></div>
        <div class="box-link-m"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url" target="_blank"><img
                    src="assets/img/NF6%20(1).png"></a></div>
        {{-- <div class="box-link-m"><a href="{{route('frontend.Helpmanage')}}" target="_blank"><img
                    src="assets/img/NF_help01.png"></a></div> --}}
    </div>
</div>
<div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-history" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h-pop">
                        <h4 class="modal-title" style="color: var(--bs-emphasis-color);">ประวัติการแลกแต้ม</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body">
                    @foreach ($RewardUserLog as $itemRw)
                    <div>
                        <div class="history-text"><span
                                style="color: var(--bs-emphasis-color);">{{date('d-m-Y h:i',strtotime($itemRw->created_at))}}</span><span
                                style="color: var(--bs-emphasis-color);">{{$itemRw->reward_Name}}</span></div>
                        <hr class="hr-line">
                    </div>
                    @endforeach

                    {{-- <div>
                        <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span
                                style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                        <hr class="hr-line">
                    </div>
                    <div>
                        <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span
                                style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                        <hr class="hr-line">
                    </div>
                    <div>
                        <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span
                                style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                        <hr class="hr-line">
                    </div>
                    <div>
                        <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span
                                style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                        <hr class="hr-line">
                    </div> --}}
                </div>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;"></div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-points" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m-h">
                    <div class="h-pop">
                        <h4 class="modal-title head-pop" style="color: var(--bs-emphasis-color);">ลุ้นรับของรางวัล</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body m-h">
                    <div class="point-box-div">
                        <div class="point-box"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url"
                                target="_blank"><img class="img-po1" src="assets/img/event_theater.png"></a></div>
                        <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1"
                                    src="assets/img/event_theater01.png"></a></div>
                        <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1"
                                    src="assets/img/redeem_reward.png"></a></div>
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
            </div>
        </div>
    </div> --}}

    @include('frontend.headmodelpoints')

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-price" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h-pop">
                        <h4 class="modal-title" style="color: var(--bs-emphasis-color);">ชำระเงินค่าแพ็กเกจ</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form-div"><label class="form-label" style="color: var(--bs-emphasis-color);">ชื่อ
                            Package</label><input class="form-control form-v1" type="text"
                            placeholder="Nextflix ยกเว้นทีวี 1 เดือน"></form>
                    <form class="form-div"><label class="form-label"
                            style="color: var(--bs-emphasis-color);">จำนวนเงิน</label><input
                            class="form-control form-v1" type="text" placeholder="139"></form>
                    <form class="form-div"><label class="form-label" style="color: var(--bs-emphasis-color);">E-mail
                            ลูกค้า</label><input class="form-control form-v1" type="text"
                            placeholder="ระบุอีเมล์ของท่าน"></form>
                </div>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;"><button
                        class="btn btn-primary bt-pay" type="button">ชำระเงิน</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-edit-img01" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h-pop">
                        <h4 class="modal-title" style="color: var(--bs-emphasis-color);">แก้ไขโปรไฟล์รูปภาพ</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <form action="{{route('frontend.changepassusercus')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-div text-center">
                            <img class="net-profile-icon imgprofileIS" src="assets/img/Frame%201%20(1).png" alt="Netflix Icon" id="imgprofile" style="width: 280px;">
                        </div>
                        <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">รูปถาพโปรไฟล์</label><input accept="image/*" name="picture"
                                class="form-control" type="file" onchange="document.getElementById('imgprofile').src=window.URL.createObjectURL(this.files[0])"></div>
                    </div>
                    <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px; display:none;">
                        <button class="btn btn-primary bt-pay" id="SaveChgPass">บันทึกการแก้ไข</button></div>
                </form>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;"><button
                        class="btn btn-primary bt-pay"
                        onclick="document.getElementById('SaveChgPass').click()">บันทึกการแก้ไข</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-edit-img" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h-pop">
                        <h4 class="modal-title" style="color: var(--bs-emphasis-color);">แก้ไขโปรไฟล์</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <form action="{{route('frontend.changepassusercus')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">ชื่อยูสเซอร์</label><input
                                class="form-control form-v1" type="text" name="username" placeholder="NF00080"
                                value="{{$users->username}}" readonly></div>
                        <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">Old-Password</label><input
                                class="form-control form-v1" type="password" placeholder="รหัสผ่านเดิม" name="oldpass">
                        </div>
                        <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">Password</label><input
                                class="form-control form-v1" type="password" placeholder="รหัสผ่านใหม่" name="newpass">
                        </div>
                        <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">Re-Password</label><input
                                class="form-control form-v1" type="password" placeholder="ทวนรหัสผ่านใหม่"
                                name="newpassre"></div>
                        {{-- <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label><input
                                class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน"></div> --}}
                        {{-- <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">รูปถาพโปรไฟล์</label><input
                                class="form-control" type="file"></div> --}}
                    </div>
                    <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px; display:none;">
                        <button class="btn btn-primary bt-pay" id="SaveChgPass">บันทึกการแก้ไข</button></div>
                </form>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;"><button
                        class="btn btn-primary bt-pay"
                        onclick="document.getElementById('SaveChgPass').click()">บันทึกการแก้ไข</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-repoints" style="padding-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m-h">
                    <div class="h-pop-man">
                        <div class="img-man02"><img class="img-man" src="assets/img/man02.webp"></div>
                    </div>
                    <div><button class="btn-close close-bt1" type="button" aria-label="Close"
                            data-bs-dismiss="modal"></button></div>
                </div>
                <div class="modal-body m-h">
                    <div class="point-box-div1">
                        <div class="point-box-t1"><span class="point-num">10</span></div>
                        <div class="point-box1">
                            <p class="text-p1">คุณได้รับแต้ม</p>
                            <p class="text-p2" style="text-align:">สะสมให้ครบ เพื่อแลกของรางวัล</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"><button
                        class="btn btn-primary bt-pay" type="button">แลกของรางวัล</button></div>
            </div>
        </div>
    </div>

    @include('frontend.profileconfirm')
    {{-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-member" style="padding-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m-h">
                    <div class="h-pop-man">
                        <div class="img-man02"><img class="img-man" src="assets/img/man01.webp"></div>
                    </div>
                    <div><button class="btn-close close-bt1" type="button" aria-label="Close"
                            data-bs-dismiss="modal"></button></div>
                </div>
                <div class="modal-body m-h">
                    <div class="point-box-div1">
                        <div class="point-box2">
                            <p class="text-p1">ยืนยันสมาชิก</p>
                            <p class="text-p2" style="text-align:">ตรวจสอบความถูกต้องและยืนยันข้อมูล</p>
                        </div>
                        <div class="div-menber">
                            <form><label class="form-label text-form-h">เบอร์โทรศัพท์</label><input class="form-control"
                                    type="text" placeholder="กรุณาระบุเบอร์โทรศัพท์เพื่อรับรหัส">
                                <div class="form-member-bt"><button class="btn btn-primary bt-pay" type="button">รับรหัส
                                        OTP</button></div>
                            </form>
                            <form><label class="form-label text-form-h">อีเมล์</label><input class="form-control"
                                    type="text" placeholder="กรุณาระบุอีเมล์">
                                <div class="form-member-bt"><button class="btn btn-primary bt-pay"
                                        type="button">ยืนยันอีเมล์</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-repoints-recommender" style="padding-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m-h">
                    <div class="h-pop-man">
                        <div class="img-man02"><img class="img-man" src="assets/img/man02.webp"></div>
                    </div>
                    <div><button class="btn-close close-bt1" type="button" aria-label="Close"
                            data-bs-dismiss="modal"></button></div>
                </div>
                <div class="modal-body m-h">
                    <div class="point-box-div1">
                        <div class="point-box-t1"><span class="point-num">10</span></div>
                        <div class="point-box1">
                            <p class="text-p1">คุณได้รับแต้ม</p>
                            <p class="text-p2" style="text-align:">สะสมให้ครบ เพื่อแลกของรางวัล</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"><button
                        class="btn btn-primary bt-pay" type="button">แลกของรางวัล</button></div>
            </div>
        </div>
    </div>

    @php
    $userCKReferFrst = Auth::guard('users')->user();
    $ReferFriendFrst = App\Models\ReferFriend::where('referee_username',$userCKReferFrst->username)->whereNull('referrer_username')->first();
    $ReferFriendFrstH= App\Models\ReferFriend::where('referee_username',$userCKReferFrst->username)->whereNotNull('referrer_username')->first(); 
    @endphp
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-repoints-referree" style="padding-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m-h">
                    <div class="h-pop-man">
                        <div class="img-man02"><img class="img-man" src="assets/img/man02.webp"></div>
                    </div>
                    <div><button class="btn-close close-bt1" type="button" aria-label="Close"
                            onclick="confirmReferrer(1);"
                            data-bs-dismiss="modal"></button></div>
                </div>
                <div class="modal-body m-h">
                    <div class="point-box-div1">
                        <div class="point-box1">
                            <p class="text-p2 mt-1">กรุณากรอกรหัสผู้แนะนำท่าน</p>
                        </div>
                        <div class="form-div"><label class="form-label"
                                style="color: var(--bs-emphasis-color);">ผู้แนะนำ : </label><input
                                class="form-control form-v1" type="text" name="usernameReferrer" id="usernameReferrer"
                                placeholder=""></div>
                        @if(!@$ReferFriendFrst)
                        <div>
                            <p><input type="checkbox" name="noshowReferrer" id="noshowReferrer"> <span style="cursor: pointer;" onclick="document.querySelector(`#noshowReferrer`).click();">ไม่แสดงอีก</span></p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 5px;padding-bottom: 30px;">
                    <button class="btn btn-primary bt-pay" type="button" onclick="confirmReferrer();">
                        ยืนยันผู้แนะนำ
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if(!@$ReferFriendFrst&&!@$ReferFriendFrstH)
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById("modal-repoints-referree"));
                myModal.show();
            });

            function confirmReferrer(clkClose=0) {
                let usernameReferrer = clkClose==0 ? document.getElementById('usernameReferrer').value : '';
                let noshowReferrerCk = document.getElementById('noshowReferrer').checked;
                if((clkClose==1&&noshowReferrerCk)||clkClose==0) {
                    fetch('{{route('frontend.confirmReferrer')}}', {
                        method: 'POST', // or 'PUT'
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            _token : "{{csrf_token()}}",
                            usernameReferrer,noshowReferrerCk
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log('Success:', data);
                        alert(data.saveOK==0?'ข้อมูลไม่ถูกต้อง !':(data.saveOK==1?'มอบแต้มให้ผู้แนะนำเรียบร้อยแล้ว.':'ไม่แสดงอีก ข้ามการมองแต้มให้ผู้แนะนำ.'));
                        document.location.reload();
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                }
            }
        </script>
    @else
        <script>
            function confirmReferrerFRSTBTN() { 
                var myModal = new bootstrap.Modal(document.getElementById("modal-repoints-referree"));
                myModal.show();
            }

            function confirmReferrer() {
                let usernameReferrer = document.getElementById('usernameReferrer').value;

                fetch('{{route('frontend.confirmReferrerFRST')}}', {
                    method: 'POST', // or 'PUT'
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token : "{{csrf_token()}}",
                        usernameReferrer
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log('Success:', data);
                    alert(data.saveOK==0?'ข้อมูลไม่ถูกต้อง !':(data.saveOK==1?'มอบแต้มให้ผู้แนะนำเรียบร้อยแล้ว.':'ข้อมูลไม่ถูกต้อง !'));
                    document.location.reload();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
        </script>
    @endif

</div>
{{-- <div>
    <p class="copy-r">Copyright ©&nbsp;NF Theater&nbsp;2024.</p>
</div> --}}
<script>
    document.getElementById('bodystart').style = `background: url("assets/img/image%201%20(1).jpg");`;
    document.getElementById('ProfileBtn').style = `display:none;`;
</script>

<script>
    function ShowSlipImgProfile(img,path) {
        fetch('{{route('frontend.getimgSlipBase64')}}', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                _token : "{{csrf_token()}}",
                img,path
            }),
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data }))) // Get status + body
        .then(({ status, body }) => {
            console.log('Success:', body , status);
            if(status==200) {
                let imgPrfile = document.querySelectorAll('.imgprofileIS'); //.src = body.img;
                imgPrfile.forEach(element => {
                    element.src = body.img;
                });
            } 
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>

@if(@$userCKReferFrst->picture)
    <script>
        ShowSlipImgProfile('{{$userCKReferFrst->picture}}','imguser/{{$userCKReferFrst->username}}'); 
    </script>
@endif


@endsection