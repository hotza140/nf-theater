@extends('frontend.layouts.frontendbase')
@section('contentfront')

    <div class="log-background">
        <div class="log-container">
            <div class="log-card">
                <div class="log-left">
                    <h1 class="log-title">NF THEATER</h1><img src="assets/img/avata2.png" alt="Avatar" class="log-avatar">
                </div>
                <div class="log-right">
                    <div class="d-01">
                        <div class="log-header"><span>กรุณาเลือกรายการ</span></div>
                    </div>
                    <div>
                        <p class="mb-4 text-m-log">สำหรับสมาชิกทุกท่านเลือกรายการเข้าสู่ระบบด้านล่างนี้</p>
                        <form class="log-form" action="{{route('frontend.profile')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div style="text-align: left;padding-left:25%;color:#BB0000;font-size:18px;">
                                <div class="mb-3"><input type="radio" name="selectNfYt" value="NetFlix"> NetFlix </div>
                                <div class="mb-4"><input type="radio" name="selectNfYt" value="YouTube"> YouTube </div>
                            </div>
                            <button class="change-button" type="submit">ยืนยันการเลือกรายการ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('bodystart').style = `background: url("assets/img/login-bk.jpg") center / cover no-repeat;`;
        document.getElementById('btnMenuS1').style = `display:none;`;
    </script>
@endsection