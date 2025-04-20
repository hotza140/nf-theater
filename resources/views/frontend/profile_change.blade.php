@extends('frontend.layouts.frontendbase')
@section('contentfront')

<style>
    a {
        text-decoration: none;
    }
</style>
    <div class="net-container">
        <h1 class="head-pro">NF THEATER</h1>
        <div class="profile-plans">
            <button class="btn btn-primary logout-bt" type="button" onclick="document.location.href=`{{url('profile')}}`;">
               
                    <path d="M8.51428 20H4.51428C3.40971 20 2.51428 19.1046 2.51428 18V6C2.51428 4.89543 3.40971 4 4.51428 4H8.51428V6H4.51428V18H8.51428V20Z" fill="currentColor"></path>
                    <path d="M13.8418 17.385L15.262 15.9768L11.3428 12.0242L20.4857 12.0242C21.038 12.0242 21.4857 11.5765 21.4857 11.0242C21.4857 10.4719 21.038 10.0242 20.4857 10.0242L11.3236 10.0242L15.304 6.0774L13.8958 4.6572L7.5049 10.9941L13.8418 17.385Z" fill="currentColor"></path>
                </svg>Back</button>
        </div>

        <br>
        <h1>NETFLIX</h1>

        @foreach($userProfile_all_netflix as $key => $userProfile)
        <br>
        <a href="{{url('change_profile/'.$userProfile->id)}}">
            <div class="container profile-plans-white" style="padding-right: 24px;">
            <div class="row">
                <div class="col-12 col-sm-3 d-flex d-sm-flex justify-content-center align-items-sm-center">
                    <div class="img-profile-a"><img class="net-profile-icon" src="assets/img/Frame%201%20(1).png" alt="Netflix Icon">
                        {{-- <div class="edit-icon"><a data-bs-target="#modal-edit-img" data-bs-toggle="modal"><button class="btn btn-primary edit-bt" type="button" style="padding: 6px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                    </svg></button></a></div> --}}
                    </div>
                </div>
                <div class="col d-flex align-items-center">
                    <div class="net-plan-details">

                        <?php 
                        $pak=DB::table('tb_users_in_in')->where('id_user',@$userProfile->id)->first();
                        $ac=DB::table('tb_users_in')->where('id',@$pak->id_user_in)->first();
                        ?>
                            <div id="showUNetflix">
                                <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Profile : {{@$userProfile->utypename}}</h2>
                                <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Package : @if(@$pak->date_start!=null){{@$userProfile->Subpackage_Name}} @else ยังไม่มี @endif</h2>
                                @if(@$userProfile->type_mail==null)
                                <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Account ID : {{@$ac->email}}</h2><span class="name-profile" style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>
                                <p class="pass-profile">Password : {{@$ac->password}}<span id="passwordnf"></span></p>

                                @else

                                @if(@$pak->type_mail==1)
                                <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Account ID : {{@$ac->email01}}</h2><span class="name-profile" style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>
                                <p class="pass-profile">Password : {{@$ac->password01}}<span id="passwordnf"></span></p>
                                @else
                                <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Account ID : {{@$ac->email02}}</h2><span class="name-profile" style="color: var(--bs-emphasis-color);font-size:15px;" id="userid"></span>
                                <p class="pass-profile">Password : {{@$ac->password02}}<span id="passwordnf"></span></p>
                                @endif


                                @endif

                                <?php
                                $date_start = @$pak->date_start; // วันที่เริ่มต้น (Y-m-d)
                                $date_end = @$pak->date_end; // วันที่สิ้นสุด (Y-m-d)
                                $today = date('Y-m-d'); // วันที่ปัจจุบัน

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
                <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>{{@$formatted_date1}} ถึง {{@$formatted_date2}} ({{@$status}})</h2>
                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div></a>
        @endforeach


        <br><br>
        <h1>YOUTUBE</h1>

        @foreach($userProfile_all_youtube as $key => $userProfile)
        <br>
        <a href="{{url('change_profile/'.$userProfile->id)}}">
        <div class="container profile-plans-white" style="padding-right: 24px;">
            <div class="row">
                <div class="col-12 col-sm-3 d-flex d-sm-flex justify-content-center align-items-sm-center">
                    <div class="img-profile-a"><img class="net-profile-icon" src="assets/img/Frame%201%20(1).png" alt="Netflix Icon">
                        {{-- <div class="edit-icon"><a data-bs-target="#modal-edit-img" data-bs-toggle="modal"><button class="btn btn-primary edit-bt" type="button" style="padding: 6px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                    </svg></button></a></div> --}}
                    </div>
                </div>
                <div class="col d-flex align-items-center">
                    <div class="net-plan-details">
                        <?php 
                        $pak=DB::table('tb_users_in_in')->where('id_user',@$userProfile->id)->first();
                        $ac=DB::table('tb_users_in')->where('id',@$pak->id_user_in)->first();
                        ?>
                        <div id="showUYoutube">
                            <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Youtube Package.</h2>
                            <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Email <!--Profile-->: {{@$userProfile->useremail}}</h2>
                            <h2 class="pack-h2"><i class="fas fa-user" style="margin-right: 5px;"></i>Package : @if(@$pak->date_start!=null){{@$userProfile->Subpackage_Name}} @else ยังไม่มี @endif</h2>
                            <!--<p class="mail-profile">Account Email: : {{--@$ac->email--}}<span id="emailYT"></span></p>--> <!--nftheater134+27@gmail.com-->
                            <!--<p class="pass-profile">Password : {{--@$ac->password--}}<span id="passYT"></span></p>--> <!--0123456-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
        @endforeach


    </div>

    
        @if(!@$ReferFriend)
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var myModal = new bootstrap.Modal(document.getElementById("modal-repoints-referree"));
                    myModal.show();
                });

                function confirmReferrer() {
                    let usernameReferrer = document.getElementById('usernameReferrer').value;
                    let noshowReferrerCk = document.getElementById('noshowReferrer').checked;

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
@endsection