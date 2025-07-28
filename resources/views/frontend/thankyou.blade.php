@extends('frontend.layouts.frontendbase')
@section('contentfront')

    <div class="net-container">
        <h1 class="head-pro">NF Streaming</h1>
    </div>
    <div class="net-container">
        <div class="net-plans">
            <div class="net-plan">
                <div class="thank-pay-div">
                    <p class="h-text-thank">ชำระค่าบริการสำเร็จ</p>
                    <div><img src="assets/img/men007.png"></div>
                    <div class="h2-text-thank">
                        <p style="margin: 0px;">ขอบคุณสำหรับการสั่งซื้อ</p>
                        <p>รายการสั่งซื้อ Nextflix ยกเว้นทีวี 1 เดือน</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--ส่วนของปุ่มไว้เลือกรายการบริการเช่น netflix youtube confirm service customer etc.-->
    @include('frontend.headbtnservice')

    <div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-history" style="margin-top: 150px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="h-pop">
                            <h4 class="modal-title" style="color: var(--bs-emphasis-color);">ประวัติการแลกแต้ม</h4>
                        </div>
                        <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                            <hr class="hr-line">
                        </div>
                        <div>
                            <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                            <hr class="hr-line">
                        </div>
                        <div>
                            <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                            <hr class="hr-line">
                        </div>
                        <div>
                            <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                            <hr class="hr-line">
                        </div>
                        <div>
                            <div class="history-text"><span style="color: var(--bs-emphasis-color);">01/01/2024</span><span style="color: var(--bs-emphasis-color);">แลก Youtube 15 วัน</span></div>
                            <hr class="hr-line">
                        </div>
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
        <p class="copy-r">Copyright ©&nbsp;NF Streaming&nbsp;2024.</p>
    </div> --}}
    
@endsection