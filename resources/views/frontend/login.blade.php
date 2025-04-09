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
                        <div class="log-header"><span>เข้าสู่ระบบ</span></div>
                    </div>
                    <div>
                        <p class="mb-4 text-m-log">สำหรับสมาชิกทุกท่านเข้าสู่ระบบด้านล่างนี้</p>
                        <form class="log-form" action="{{route('login_frontend')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="mb-3"><input class="form-control form-control log-input" type="text" placeholder="ชื่อผู้ใช้งาน" required name="username"></div>
                            <div class="mb-4"><input class="form-control form-control log-input" type="password" placeholder="รหัสผ่าน" required name="password"></div>
                            <div style="text-align: left;padding-left:25%;color:#BB0000;font-size:18px;">
                                <div class="mb-3"><input type="radio" name="type" value="netflix"> <span style="cursor: pointer;" onclick="document.querySelector(`input[value='netflix']`).click();">NetFlix</span> </div>
                                <div class="mb-4"><input type="radio" name="type" value="youtube"> <span style="cursor: pointer;" onclick="document.querySelector(`input[value='youtube']`).click();">YouTube</span> </div>
                            </div>
                            <button class="change-button" type="submit">เข้าสู่ระบบ</button>
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