@extends('frontend.layouts.frontendbase')
@section('contentfront')

<style>
    @keyframes slide-in {
        from { transform: translateX(-100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    .animated-char {
        display: inline-block;
        animation: slide-in 0.5s ease-out;
    }
</style>

<style>
    body {font-family: Arial;}
    
    /* Style the tab  #f1f1f1;  #db0813; */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #d83840;
      /* border-radius: 10px 10px 0 0; */
    }
    
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      /* border: none; */
      border: 1px solid #ccc;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
      border-radius: 10px 10px 0 0;
      background-color:#de0914; /*  #d83840 */
      color:#faf8f8;
    }
    
    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
      color: #db0813;
    }
    
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

</style>

{{-- <div class="con-bk" style="background: url(&quot;assets/img/backgrown-net1.jpg&quot;)">
    <div class="d-logo">
        <div class="d-logo-m1"><img class="logo-m" src="assets/img/logo-netfilx.png"></div>
    </div>
</div> --}}

<div class="net-container" style="text-align: center;">
    <h1 class="head-pro">NF THEATER</h1>
    <h3>ส่วนของการชำระเงินระบบ Payment</h3>
</div>

{{-- <div class="d-link">
    <div class="d-link-in">
        <div class="box-link-m"><a href="{{route('frontend.netflix')}}?id=1"><img src="assets/img/NF22%20(1).png"></a></div>
        <div class="box-link-m"><a href="{{route('frontend.youtube')}}?id=2"><img src="assets/img/NF11%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-member" data-bs-toggle="modal"><img src="assets/img/NF3%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-repoints" data-bs-toggle="modal"><img src="assets/img/NF5%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-toggle="modal" data-bs-target="#modal-points"><img src="assets/img/NF4%20(1).png"></a></div>
        <div class="box-link-m"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url" target="_blank"><img src="assets/img/NF6%20(1).png"></a></div>
    </div>
</div> --}}
<div class="net-container">
    {{-- <h1 class="head-pack" style="font-family: Prompt, sans-serif;">ส่วนของการชำระเงินระบบ Payment</h1> --}}
    <div class="net-plans" style="background-color: aliceblue;">
        <div class="tab" style="color: black">
            <button class="tablinks btn" onclick="openCity(event, 'BankQr')" id="btns1">ขำระด้วย Scan QR ธนาคาร</button>
            <button class="tablinks btn" onclick="openCity(event, 'TrueMoneyWallet')" id="btns2">ชำระด้วย โอนผ่านทาง TrueMoney Wallet.</button>
        </div>
        <div id="BankQr" class="tabcontent">
            <form action="{{route('frontend.afterSaveOrderPackage')}}" method="post" enctype="multipart/form-data" id="SaveOrderPackageFront">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-div">
                            <img src="{{asset('img/ForPayment.jpg')}}" style="width: 100%">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                    
                        <div class="form-div p-1">
                            <input type="hidden" name="id" value="{{$id}}" id="idpackageName">
                            <input type="hidden" name="Subpackage_Code" id="Subpackage_Code" value="{{$Subpackage_Code}}">
                            <input type="hidden" name="package_Name" value="{{$package_Name}}" id="package_Name">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">ชื่อ Package</label>
                            <input class="form-control form-v1" type="text" placeholder="Nextflix ยกเว้นทีวี 1 เดือน" name="Subpackage_Name" id="Subpackage_Name" value="{{$Subpackage_Name}}" readonly>
                        </div>
                        <div class="form-div p-1">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">จำนวนเงิน</label>
                            <input class="form-control form-v1" type="text" placeholder="139" name="Subpackage_Paymoney" id="Subpackage_Paymoney" value="{{$Subpackage_Paymoney}}" readonly>
                        </div>
                        <div class="form-div p-1" style="display: {{strtolower($package_Name)<>'netflix'?'block':'none'}};">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label>
                            <input class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน" name="Orderemail" id="Orderemail" value="{{$Orderemail}}" readonly>
                        </div>
                        <div class="form-div p-1">
                            <label class="form-label" style="color: var(--bs-emphasis-color);">แนบสลิปโอนเงิน</label>
                            <input class="form-control form-v1" style="padding:6px;" type="file" accept=".jpeg,.png,.jpg,.gif,.svg"
                                name="qr_code_image" id="qr_code_image" required onchange="ChgImageCheckQr(this);">
                            <div id="showFileNameForSave" style="display: none;color:black;margin-left:10px;"></div>
                        </div>

                        <div class="form-div">
                        <button type="button" class="btn btn-sm btn-primary" onclick="copyUserInfo('1658146994')">
                        <i class="fa fa-copy"></i> คัดลอกเลขบัญชี
                        </button>
                        </div>

                        <div id="showWaitForSave" style="display: none;color:black;margin-left:10px;" class="animated-char">Please waitting.....</div>
                    </div>
                </div>
                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;text-align:center; background-color:rgb(228, 228, 228);">
                    <button class="btn btn-primary bt-pay" disabled id="btnChkOK"
                        style="background-color: rgb(233, 230, 230) !important;color :rgb(224, 231, 238) !important;">
                        บันทึกรายการสั่งซื้อ
                    </button>
                </div>
            </form>
        </div>
        <div id="TrueMoneyWallet" class="tabcontent">
            <form action="{{route('frontend.afterSaveOrderPackage')}}" method="post" enctype="multipart/form-data" id="SaveOrderPackageFront">
                @csrf
                
                <div class="form-div" style="text-align: center;">
                    <img src="{{asset('img/ForPaymenttrueWallet.png')}}" style="width: 75%;border-radius:10px;">
                </div>
            
                <div class="form-div">
                    <input type="hidden" name="id" value="{{$id}}" id="idpackageName">
                    <input type="hidden" name="Subpackage_Code" id="Subpackage_Code" value="{{$Subpackage_Code}}">
                    <input type="hidden" name="package_Name" value="{{$package_Name}}" id="package_Name">
                    <label class="form-label" style="color: var(--bs-emphasis-color);">ชื่อ Package</label>
                    <input class="form-control form-v1" type="text" placeholder="Nextflix ยกเว้นทีวี 1 เดือน" name="Subpackage_Name" id="Subpackage_Name" value="{{$Subpackage_Name}}" readonly>
                </div>
                <div class="form-div">
                    <label class="form-label" style="color: var(--bs-emphasis-color);">จำนวนเงิน</label>
                    <input class="form-control form-v1" type="text" placeholder="139" name="Subpackage_Paymoney" id="Subpackage_Paymoney" value="{{$Subpackage_Paymoney}}" readonly>
                </div>
                <div class="form-div" style="display: {{strtolower($package_Name)<>'netflix'?'block':'none'}};">
                    <label class="form-label" style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label>
                    <input class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน" name="Orderemail" id="Orderemail" value="{{$Orderemail}}" readonly>
                </div>
                <div class="form-div">
                    <label class="form-label" style="color: var(--bs-emphasis-color);">แนบสลิปโอนเงิน <b>TrueMoneyWallet</b></label>
                    <input class="form-control form-v1" style="padding:6px;" type="file" accept=".jpeg,.png,.jpg,.gif,.svg"
                        name="qr_code_imagetruewallet" id="qr_code_imagetruewallet" required>
                    <div id="showFileNameForSave" style="display: none;color:black;margin-left:10px;"></div>
                </div>


                <div class="form-div">
                <button type="button" class="btn btn-sm btn-primary" onclick="copyUserInfo2('0803944419')">
                <i class="fa fa-copy"></i> คัดลอกเลขเบอร์ทรูวอเลต
                </button>
                </div>


                <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;text-align:center; background-color:rgb(228, 228, 228);">
                    <button class="btn btn-primary bt-pay" id="btnChkOKTrueWallet">
                        บันทึกรายการสั่งซื้อ
                    </button>
                </div>
                <input type="hidden" name="truemoneywallet" value="truemoneywallet">
            </form>
        </div>
    </div>
</div>

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

                                    function copyUserInfo(email) {
                                        let textToCopy = `${email}`;

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



<script>
                                    function fallbackCopyTextToClipboard2(text) {
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

                                    function copyUserInfo2(email) {
                                        let textToCopy = `${email}`;

                                        if (navigator.clipboard && navigator.clipboard.writeText) {
                                            navigator.clipboard.writeText(textToCopy).then(() => {
                                                alert("คัดลอกข้อมูลสำเร็จ!");
                                            }).catch(err => {
                                                console.error('คัดลอกไม่สำเร็จ: ', err);
                                                fallbackCopyTextToClipboard2(textToCopy);
                                            });
                                        } else {
                                            console.warn("ใช้ HTTP → เปลี่ยนไปใช้ execCommand แทน");
                                            fallbackCopyTextToClipboard2(textToCopy);
                                        }
                                    }
                                    </script>

<script>
    function ChgImageCheckQr(thv) {
        document.getElementById('showWaitForSave').style.display = 'block';
        let formData = new FormData(document.getElementById('SaveOrderPackageFront'));
        fetch('{{route('frontend.upCheckQR')}}', {
            method: 'POST', // or 'PUT'
            body: formData,
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data }))) // Get status + body
        .then(({ status, body }) => {
            console.log('Success:', body , status);
            if(status==200) {
                document.getElementById('btnChkOK').style ="";
                document.getElementById('btnChkOK').disabled = false;
                document.getElementById('qr_code_image').style.display = 'none';
                document.getElementById('showFileNameForSave').style.display = 'block';
                document.getElementById('showFileNameForSave').innerHTML = document.getElementById('qr_code_image').files[0].name;
            } else {
                if (body?.statis?.response?.message)  alert(body.statis.response.message + (body.statis.response.code==1013?' กรุณาติดต่อ Admin !':''));
                else alert(body.error);
            }
            document.getElementById('showWaitForSave').style.display = 'none';
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>

<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    // openCity(document.getElementById('BankQr'), 'BankQr');
    openCity({ currentTarget: document.getElementById('btns1') }, 'BankQr');
</script>

<script>
    document.getElementById('bodystart').style = `background: url("assets/img/image%201%20(1).jpg");`;
</script>
@endsection


