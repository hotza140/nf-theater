@extends('frontend.layouts.frontendbase')
@section('contentfront')

{{-- <div class="con-bk" style="background: url(&quot;assets/img/backgrown-net1.jpg&quot;)">
    <div class="d-logo">
        <div class="d-logo-m1"><img class="logo-m" src="assets/img/logo-netfilx.png"></div>
    </div>
</div> --}}

<div class="net-container" style="text-align: center;">
    <h1 class="head-pro">NF THEATER</h1>
    <h3>วิธีใช้งานโปรแกรม</h3>
</div>

<!--ส่วนของปุ่มไว้เลือกรายการบริการเช่น netflix youtube confirm service customer etc.-->
@include('frontend.headbtnservice')

<div class="net-container" style="max-width: 1200px;">
    <h1 class="head-pack" style="font-family: Prompt, sans-serif;">คู่มือในการใช้งานโปรแกรม</h1>
    <div class="net-plans">
        @foreach ($Helpmanage as $itemHpm)
            <div class="net-plan">
                <div class="net-plan-info" style="width: 100%">
                    <div class="net-plan-details">
                        <h2 class="pack-h2" style="color: aliceblue;">{{$itemHpm->helpma_Name}}</h2>
                        <p class="pack-h3"> <img src="{{asset('/img/upload/helpma/'.$itemHpm->picture)}}" alt="" style="width: 100%;border-radius:15px;"> </p>
                    </div>
                </div>
            </div>
            {{-- <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;margin-bottom: 0;">{{$itemPs->Subpackage_Paymoney}}</p>
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
            </div> --}}
        @endforeach
    </div>
</div>
<div>
    {{-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-price" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="h-pop">
                        <h4 class="modal-title" style="color: var(--bs-emphasis-color);">ชำระเงินค่าแพ็กเกจ</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
                </div>
                <form action="{{route('frontend.SendOrderPackage')}}" method="post" enctype="multipart/form-data" id="SendOrderPackageFront">
                    @csrf
                    <div class="modal-body">
                        <div class="form-div">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="Subpackage_Code" id="Subpackage_Code">
                            <input type="hidden" name="package_Name" value="Netflix">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">ชื่อ Package</label>
                            <input class="form-control form-v1" type="text" placeholder="Nextflix ยกเว้นทีวี 1 เดือน" name="Subpackage_Name" id="Subpackage_Name" readonly>
                        </div>
                        <div class="form-div">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">จำนวนเงิน</label>
                            <input class="form-control form-v1" type="text" placeholder="139" name="Subpackage_Paymoney" id="Subpackage_Paymoney" readonly>
                        </div>
                        <div class="form-div">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label>
                            <input class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน" name="Orderemail" id="Orderemail" readonly>
                        </div>
                    </div>
                </form>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;">
                    <button class="btn btn-primary bt-pay" type="button" onclick="document.getElementById('SendOrderPackageFront').submit();">ชำระเงิน</button>
                </div>
            </div>
        </div>
    </div> --}}
    @php
        $userCMail = Auth::guard('users')->user();
    @endphp
    <script>
        function showPackageOrder(Subpackage_Code ,Subpackage_Name ,Subpackage_Paymoney) {
            document.getElementById('Subpackage_Code').value=Subpackage_Code;
            document.getElementById('Subpackage_Name').value=Subpackage_Name;
            document.getElementById('Subpackage_Paymoney').value=Subpackage_Paymoney;
            document.getElementById('Orderemail').value='{{$userCMail->email}}';
        }
        // function checkPayment() {
        //     var myModal = new bootstrap.Modal(document.getElementById('modal-payment'));
        //     myModal.show();
        // }
    </script>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-payment" style="margin-top: 150px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header m-h">
                    <div class="h-pop">
                        <h4 class="modal-title head-pop" style="color: var(--bs-emphasis-color);">ส่วนของการชำระเงินระบบ Payment.</h4>
                    </div>
                    <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button></div>
                </div>
                <div class="modal-body m-h">
                    <div class="point-box-div">
                        <div class="point-box"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url" target="_blank"><img class="img-po1" src="assets/img/event_theater.png"></a></div>
                        <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1" src="assets/img/event_theater01.png"></a></div>
                        <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1" src="assets/img/redeem_reward.png"></a></div>
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
            </div>
            <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;">
                <button class="btn btn-primary bt-pay" type="button" onclick="document.getElementById('SaveOrderPackageFront').submit();">ชำระเงินสำเร็จ</button>
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

@endsection

{{-- @if(session('message'))
    <script>
        alert('บันทึกรายการสั่งซื้อ Package เรียบร้อยแล้ว.')
    </script>
@endif --}}
