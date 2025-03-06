@extends('frontend.layouts.frontendbase')
@section('contentfront')

<div class="con-bk" style="background: url(&quot;assets/img/backgrown-net1.jpg&quot;)">
    <div class="d-logo">
        <div class="d-logo-m1"><img class="logo-m" src="assets/img/logo-youtube.webp"></div>
    </div>
</div>
<div class="d-link">
    <div class="d-link-in">
        <div class="box-link-m"><a href="{{route('frontend.netflix')}}?id=1"><img src="assets/img/NF22%20(1).png"></a></div>
        <div class="box-link-m"><a href="{{route('frontend.youtube')}}?id=2"><img src="assets/img/NF11%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-member" data-bs-toggle="modal"><img src="assets/img/NF3%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-repoints" data-bs-toggle="modal"><img src="assets/img/NF5%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-toggle="modal" data-bs-target="#modal-points"><img src="assets/img/NF4%20(1).png"></a></div>
        <div class="box-link-m"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url" target="_blank"><img src="assets/img/NF6%20(1).png"></a></div>
    </div>
</div>
<div class="net-container">
    <h1 class="head-pack" style="font-family: Prompt, sans-serif;">แพ็กเกจสำหรับ Youtube</h1>
    <div class="net-plans">
        {{-- 'Packagewatch','PackageSubwatch' --}}
        @foreach ($PackageSubwatch as $itemPs)
            <div class="net-plan2" data-bs-toggle="modal" data-bs-target="#modal-price" onclick="showPackageOrder('{{$itemPs->Subpackage_Code}}','{{$itemPs->Subpackage_Name}}','{{$itemPs->Subpackage_Paymoney}}');">
                <div class="net-plan-info"><img class="net-plan-icon" src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon" />
                    <div class="net-plan-details">
                        <h2 class="pack-h2">{{$Packagewatch->package_Name}}</h2>
                        <p class="pack-h3">{{$itemPs->Subpackage_Name}}</p>
                    </div>
                </div>
                <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                    <div style="margin: 0;padding: 0;height: auto;">
                        <p class="net-price" style="text-align: center;height: auto;margin-bottom: 0;">{{$itemPs->Subpackage_Paymoney}}</p>
                    </div>
                    <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
                </div>
            </div>
        @endforeach
        
        {{-- <div class="net-plan2" data-bs-toggle="modal" data-bs-target="#modal-price">
            <div class="net-plan-info"><img class="net-plan-icon" src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon" />
                <div class="net-plan-details">
                    <h2 class="pack-h2">แพ็กเกจ Youtube</h2>
                    <p class="pack-h3">Youtube ยาวนานถึง 1 เดือน</p>
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;margin-bottom: 0;">139</p>
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
            </div>
        </div>
        <div class="net-plan2">
            <div class="net-plan-info"><img src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon" class="net-plan-icon">
                <div class="net-plan-details">
                    <h2 class="pack-h2">แพ็กเกจ Youtube</h2>
                    <p class="pack-h3">Youtube ยาวนานถึง 2 เดือน</p>
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;">269</p>
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
            </div>
        </div>
        <div class="net-plan2">
            <div class="net-plan-info"><img src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon" class="net-plan-icon">
                <div class="net-plan-details">
                    <h2 class="pack-h2">แพ็กเกจ Youtube</h2>
                    <p class="pack-h3">Youtube ยาวนานถึง 3 เดือน</p>
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;">400</p>
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
            </div>
        </div>
        <div class="net-plan2">
            <div class="net-plan-info"><img src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon" class="net-plan-icon">
                <div class="net-plan-details">
                    <h2 class="pack-h2">แพ็กเกจ Youtube</h2>
                    <p class="pack-h3">Youtube ยาวนานถึง 4 เดือน</p>
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;">535</p>
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
            </div>
        </div>
        <div class="net-plan2">
            <div class="net-plan-info"><img src="assets/img/logo-netflix%201%20(1).png" alt="Netflix Icon" class="net-plan-icon">
                <div class="net-plan-details">
                    <h2 class="pack-h2">แพ็กเกจ Youtube</h2>
                    <p class="pack-h3">Youtube ยาวนานถึง 6 เดือน</p>
                </div>
            </div>
            <div class="net-plan-price" style="background: var(--bs-emphasis-color);border-radius: 10px;padding: 10px;">
                <div style="margin: 0;padding: 0;height: auto;">
                    <p class="net-price" style="text-align: center;height: auto;">800</p>
                </div>
                <div class="bath-d" style="height: auto;margin: 0;padding: 0;"><span style="height: auto;margin-top: -10px;">บาท</span></div>
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
                <form action="{{route('frontend.SendOrderPackage')}}" method="post" enctype="multipart/form-data" id="SendOrderPackageFront">
                    @csrf
                    <div class="modal-body">
                        <div class="form-div">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="Subpackage_Code" id="Subpackage_Code">
                            <input type="hidden" name="package_Name" value="Youtube">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">ชื่อ Package</label>
                            <input class="form-control form-v1" type="text" placeholder="Youtube ยกเว้นทีวี 1 เดือน" name="Subpackage_Name" id="Subpackage_Name">
                        </div>
                        <div class="form-div">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">จำนวนเงิน</label>
                            <input class="form-control form-v1" type="text" placeholder="139" name="Subpackage_Paymoney" id="Subpackage_Paymoney">
                        </div>
                        <div class="form-div">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label>
                            <input class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน" name="Orderemail" id="Orderemail">
                        </div>
                    </div>
                </form>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;">
                    <button class="btn btn-primary bt-pay" type="button" onclick="document.getElementById('SendOrderPackageFront').submit();">ชำระเงิน</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPackageOrder(Subpackage_Code ,Subpackage_Name ,Subpackage_Paymoney) {
            document.getElementById('Subpackage_Code').value=Subpackage_Code;
            document.getElementById('Subpackage_Name').value=Subpackage_Name;
            document.getElementById('Subpackage_Paymoney').value=Subpackage_Paymoney;
            document.getElementById('Orderemail').value='test@gmail.com';
        }
    </script>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-points" style="margin-top: 150px;">
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
                        <div class="point-box"><a href="/rewards.html"><img class="img-po1" src="assets/img/redeem_reward.png"></a></div>
                    </div>
                </div>
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
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
                <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"><button class="btn btn-primary bt-pay" type="button">แลกของรางวัล</button></div>
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
<script>
    document.getElementById('bodystart').style = `background: url("assets/img/image%201%20(1).jpg");`;

</script>
@endsection

@if(session('message'))
    <script>
        alert('บันทึกรายการสั่งซื้อ Package เรียบร้อยแล้ว.')
    </script>
@endif