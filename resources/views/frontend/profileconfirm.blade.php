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
                        <form method="POST" enctype="multipart/form-data" action="{{route('frontend.confirmOTPck')}}" id="confirmOTPPOSt">
                            @csrf
                            <input type="hidden" name="tokenOTP" id="tokenOTP">
                            <input type="hidden" name="ref_code" id="ref_code">
                            <label class="form-label text-form-h" id="lbphone">{!!@$usersCKmail->phone?'<b style="font-size:14px;">เบอร์โทรศัพท์ที่ยืนยันปัจจุบัน</b>':'เบอร์โทรศัพท์'!!}</label>
                            <input class="form-control" type="text" name="phone" placeholder="กรุณาระบุเบอร์โทรศัพท์เพื่อรับรหัส" id="phoneOTP" value="{{@$usersCKmail->phone??''}}">
                            <input class="form-control" type="text" name="otp_code_confirm" style="display: none;" placeholder="กรุณากรอกรหัสยืนเบอร์โทร" id="phoneOTPconfirm">
                            <div class="form-member-bt">
                                <button class="btn btn-primary bt-pay" type="button" onclick="sentOTPtoMck(`${document.getElementById('phoneOTP').value}`)" id="btnOTP1">รับรหัส OTP</button>
                                <button class="btn btn-primary bt-pay" type="submit" id="btnOTP2" style="display: none;background-color:gray !important;color:aliceblue !important;">ยืนยัน OTP</button>
                            </div>
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

    function sentOTPtoMck(phone='') {alert(phone)
        fetch('{{route('frontend.sentOTPtoMck')}}', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                _token : "{{csrf_token()}}",
                phone
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            console.log('Success:', data);
            if(data.status==1) {
                let ress = JSON.parse(data.res);
                document.getElementById('btnOTP1').style.display= 'none';
                document.getElementById('btnOTP2').style.display= 'block';
                document.getElementById('lbphone').innerHTML= 'กรอกรหัสยืนเบอร์โทร';
                document.getElementById('lbphone').style = 'font-size:20px !important;'  // background-color: red !important;
                document.getElementById('phoneOTP').style.display = 'none';
                document.getElementById('phoneOTPconfirm').style = 'block';
                document.getElementById('tokenOTP').value = ress.result.token;
                document.getElementById('ref_code').value = data.ref_code;
            } else {
                alert('เบอร์โทรไม่ถูกต้องในการยืนยัน!')
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>