@extends('frontend.layouts.frontendbase')
@section('contentfront')

    <div class="con-bk" style="background: url(&quot;assets/img/backgrown-net1.jpg&quot;)">
        <div class="d-logo">
            <div class="d-logo-m2">
                <h1 class="head-pro">NF THEATER</h1>
            </div>
        </div>
    </div>
    
    <!--ส่วนของปุ่มไว้เลือกรายการบริการเช่น netflix youtube confirm service customer etc.-->
    @include('frontend.headbtnservice')

    <div class="net-container">
        <h1 class="head-pack" style="font-family: Prompt, sans-serif;">รายการแลกของรางวัล</h1>
        <div class="net-plans">
            <div class="row">
                @foreach ($Reward as $itemRw)
                    @if(strlen($itemRw->reward_Score)<4)
                        <div class="col reward-card">
                            <div class="change-card">
                                <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                                    <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                        <div style="margin: 0;padding: 0;height: auto;">
                                            <p class="net-price" style="text-align: center;height: auto;">{{$itemRw->reward_Score}}</p>
                                        </div>
                                        <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                                    </div>
                                </div>
                                <div class="change-reward-text">
                                    <div class="inside-re"><span>{{$itemRw->reward_Name}}</span>
                                        <button class="change-button" 
                                             onclick="if(confirm('คุณต้องการแลกแต้มใช่หรือไม่'))  { rewardsclick('{{$itemRw->reward_Name}}','{{$itemRw->reward_Code}}'); }"
                                        >
                                            แลกแต้ม
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row">
                @foreach ($Reward as $itemRw)
                    @if(strlen($itemRw->reward_Score)>3)
                        <div class="col reward-card">
                            <div class="change-card-a">
                                <div class="change-points-a"><img class="img-m-v2" src="assets/img/logo-man-v3.png">
                                    <div class="net-plan-price-v" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                        <div style="margin: 0;padding: 0;height: auto;">
                                            <p class="net-price" style="text-align: center;height: auto;">{{number_format($itemRw->reward_Score,0,".",",")}}</p>
                                        </div>
                                        <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                                    </div>
                                </div>
                                <div class="change-reward-text-v">
                                    <div class="inside-re"><span>{{$itemRw->reward_Name}}</span>
                                        <button class="change-button" 
                                            onclick="if(confirm('คุณต้องการแลกแต้มใช่หรือไม่')) { rewardsclick('{{$itemRw->reward_Name}}','{{$itemRw->reward_Code}}'); }"
                                        >
                                            แลกแต้ม
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <script>
                function rewardsclick(reward_Name,reward_Code) {
                    document.location.href=`{{route('frontend.RewardUserLog_store')}}?reward_Name=${reward_Name}&reward_Code=${reward_Code}`;
                }
            </script>
            {{-- <div class="row">
                <div class="col reward-card">
                    <div class="change-card">
                        <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">3</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text">
                            <div class="inside-re"><span>แลก Youtube 15 วัน</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
                <div class="col reward-card">
                    <div class="change-card">
                        <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">5</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text">
                            <div class="inside-re"><span>แลก Netflix 15 วัน</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
                <div class="col reward-card">
                    <div class="change-card">
                        <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">5</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text">
                            <div class="inside-re"><span>แลก Youtube 30วัน</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
                <div class="col reward-card">
                    <div class="change-card">
                        <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">10</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text">
                            <div class="inside-re"><span>แลก Netflix 30 วัน</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
                <div class="col reward-card">
                    <div class="change-card">
                        <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">30</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text">
                            <div class="inside-re"><span>แลก Youtube 1 ปี</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
                <div class="col reward-card">
                    <div class="change-card">
                        <div class="change-points"><img class="img-m-v1" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">50</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text">
                            <div class="inside-re"><span>แลก Netflix 1 ปี</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col reward-card">
                    <div class="change-card-a">
                        <div class="change-points-a"><img class="img-m-v2" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price-v" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">99,999</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text-v">
                            <div class="inside-re"><span>แลก&nbsp;iphone 15 pro max 16GB 1 เครื่อง</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
                <div class="col reward-card">
                    <div class="change-card-a">
                        <div class="change-points-a"><img class="img-m-v2" src="assets/img/logo-man-v3.png">
                            <div class="net-plan-price-v" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                                <div style="margin: 0;padding: 0;height: auto;">
                                    <p class="net-price" style="text-align: center;height: auto;">99,999</p>
                                </div>
                                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">แต้ม</span></div>
                            </div>
                        </div>
                        <div class="change-reward-text-v">
                            <div class="inside-re"><span>แลก&nbsp;iphone 15 pro max 16GB 1 เครื่อง</span><button class="change-button">แลกแต้ม</button></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-price" style="margin-top: 150px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="h-pop">
                            <h4 class="modal-title" style="color: var(--bs-emphasis-color);">ชำระเงินค่าแพ็กเกจ</h4>
                        </div>
                        <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
                    </div>
                    <div class="modal-body">
                        <form class="form-div"><label class="form-label" style="color: var(--bs-emphasis-color);">ชื่อ Package</label><input class="form-control form-v1" type="text" placeholder="Nextflix ยกเว้นทีวี 1 เดือน"></form>
                        <form class="form-div"><label class="form-label" style="color: var(--bs-emphasis-color);">จำนวนเงิน</label><input class="form-control form-v1" type="text" placeholder="139"></form>
                        <form class="form-div"><label class="form-label" style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label><input class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน"></form>
                    </div>
                    <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;"><button class="btn btn-primary bt-pay" type="button">ชำระเงิน</button></div>
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
                        <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
                    </div>
                    <div class="modal-body m-h">
                        <div class="point-box-div">
                            <div class="point-box"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url" target="_blank"><img class="img-po1" src="assets/img/event_theater.png"></a></div>
                            <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1"
                                src="assets/img/event_theater01.png"></a></div>
                            <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1" src="assets/img/redeem_reward.png"></a></div>
                        </div>
                    </div>
                    <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
                </div>
            </div>
        </div> --}}

        @include('frontend.headmodelpoints')
        
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-repoints" style="padding-top: 150px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header m-h">
                        <div class="h-pop-man">
                            <div class="img-man02"><img class="img-man" src="assets/img/man02.webp"></div>
                        </div>
                        <div><button class="btn-close close-bt1" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
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
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-member" style="padding-top: 150px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header m-h">
                        <div class="h-pop-man">
                            <div class="img-man02"><img class="img-man" src="assets/img/man01.webp"></div>
                        </div>
                        <div><button class="btn-close close-bt1" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
                    </div>
                    <div class="modal-body m-h">
                        <div class="point-box-div1">
                            <div class="point-box2">
                                <p class="text-p1">ยืนยันสมาชิก</p>
                                <p class="text-p2" style="text-align:">ตรวจสอบความถูกต้องและยืนยันข้อมูล</p>
                            </div>
                            <div class="div-menber">
                                <form><label class="form-label text-form-h">เบอร์โทรศัพท์</label><input class="form-control" type="text" placeholder="กรุณาระบุเบอร์โทรศัพท์เพื่อรับรหัส">
                                    <div class="form-member-bt"><button class="btn btn-primary bt-pay" type="button">รับรหัส OTP</button></div>
                                </form>
                                <form><label class="form-label text-form-h">อีเมล์</label><input class="form-control" type="text" placeholder="กรุณาระบุอีเมล์">
                                    <div class="form-member-bt"><button class="btn btn-primary bt-pay" type="button">ยืนยันอีเมล์</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div>
        <p class="copy-r">Copyright ©&nbsp;NF Theater&nbsp;2024.</p>
    </div> --}}
    
    </script>

    @if(session('message'))
        <script>
            alert('{{ session('message') }}');
        </script>
    @endif
@endsection