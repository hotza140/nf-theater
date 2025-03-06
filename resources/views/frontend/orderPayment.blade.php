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

<div class="con-bk" style="background: url(&quot;assets/img/backgrown-net1.jpg&quot;)">
    <div class="d-logo">
        <div class="d-logo-m1"><img class="logo-m" src="assets/img/logo-netfilx.png"></div>
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
    <h1 class="head-pack" style="font-family: Prompt, sans-serif;">ส่วนของการชำระเงินระบบ Payment</h1>
    <div class="net-plans" style="background-color: aliceblue;">

        <form action="{{route('frontend.afterSaveOrderPackage')}}" method="post" enctype="multipart/form-data" id="SaveOrderPackageFront">
            @csrf
            <div class="">
                <div class="form-div">
                    <img src="{{asset('img/ForPayment.jpg')}}" style="width: 100%">
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
                <div class="form-div">
                    <label class="form-label" style="color: var(--bs-emphasis-color);">E-mail ลูกค้า</label>
                    <input class="form-control form-v1" type="text" placeholder="ระบุอีเมล์ของท่าน" name="Orderemail" id="Orderemail" value="{{$Orderemail}}" readonly>
                </div>
                <div class="form-div">
                    <label class="form-label" style="color: var(--bs-emphasis-color);">แนบสลิปโอนเงิน</label>
                    <input class="form-control form-v1" style="padding:6px;" type="file" accept=".jpeg,.png,.jpg,.gif,.svg"
                           name="qr_code_image" id="qr_code_image" required onchange="ChgImageCheckQr(this);">
                    <div id="showFileNameForSave" style="display: none;color:black;margin-left:10px;"></div>
                </div>
            </div>
            <div id="showWaitForSave" style="display: none;color:black;margin-left:10px;" class="animated-char">Please waitting.....</div>
            <div class="modal-footer fot-pay" style="padding-top: 20px;padding-bottom: 30px;text-align:center">
                <button class="btn btn-primary bt-pay" disabled id="btnChkOK"
                    style="background-color: rgb(233, 230, 230) !important;color :rgb(224, 231, 238) !important;">
                    บันทึกรายการสั่งซื้อ
                </button>
            </div>
        </form>

    </div>
</div>
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
                if (body?.statis?.response?.message)  alert(body.statis.response.message);
                else alert(body.error);
            }
            document.getElementById('showWaitForSave').style.display = 'none';
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>

@endsection


