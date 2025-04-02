@php
    $usersCKmail = Auth::guard('users')->user();
    $ConfirmMailCK = App\Models\ConfirmMail::where('username_confirm',@$usersCKmail->username??'')->where('email_confirm',@$usersCKmail->email??'')->where('open_ck',2)->first();
@endphp
<div class="modal fade" role="dialog" tabindex="-1" id="modal-member" style="padding-top: 150px;">
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
                        <form method="POST" enctype="multipart/form-data" action="{{route('frontend.confirmmailck')}}" id="confirmmailPOSt">
                            @csrf
                            <label class="form-label text-form-h" id="emailconf">{!!@$ConfirmMailCK->email_confirm?'<b style="font-size:14px;">อีเมล์ที่ยืนยันปัจจุบัน</b>':'อีเมล์'!!}</label>
                                <input class="form-control"
                                value="{{@$ConfirmMailCK->email_confirm??''}}"
                                type="email" placeholder="กรุณาระบุอีเมล์" id="emailconfirm" name="emailconfirm"
                                onkeydown="if('{{@$ConfirmMailCK->email_confirm??''}}'!='') document.getElementById('emailconf').innerHTML = `อีเมล์แก้ไขใหม่`">
                            <div class="form-member-bt"><button class="btn btn-primary bt-pay"
                                onclick="confirmmailSend();"
                                    type="button">ยืนยันอีเมล์</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
        </div>
    </div>
</div>

<script>
    function confirmmailSend() {
        let mailCK = document.getElementById('emailconfirm').value;
        if(confirm('คุณต้องการยืนยันเมล ใช่หรือไม่')) {
            if (mailCK.includes('@') && mailCK.split("@").length > 1) {
                document.getElementById('confirmmailPOSt').submit();
            } else if( !(mailCK.includes('@') && mailCK.split("@").length > 1) ) {
                alert('คุณป้อนข้อมูลเมลที่จะยืนยันไม่ถูกต้อง โปรดตรวจสอบ!')
            }
        }
    }
</script>