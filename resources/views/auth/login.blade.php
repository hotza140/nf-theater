<!DOCTYPE html>
<html lang="en">

<head>
    <title>NF THEATER BACKEND</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->

    <!-- <link rel="icon" href="{{asset('files/assets/images/favicon.ico')}}" type="image/x-icon"> -->

    
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/icofont/css/icofont.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/style.css')}}">

    <link rel="icon" href="{{asset('images/nav/Logo.svg')}}">

    <style>
    /* พื้นหลังสไตล์เน็ตฟลิกซ์ */
    .common-img-bg {
        background: linear-gradient(45deg, #ff0000, #800000); /* โทนแดงเท่ๆ */
        background-size: cover;
        height: 100%;
    }

    /* ปุ่มแบบเน็ตฟลิกซ์ */
    .btn, .sweet-alert button.confirm, .wizard>.actions a {
        background-color: #ff0000; /* สีแดงสด */
        border-color: #ffffff; /* ขอบสีขาว */
        color: #ffffff; /* ข้อความสีขาว */
        cursor: pointer;
        transition: all ease-in 0.3s;
        font-weight: bold;
        border-radius: 5px; /* ขอบมนเล็กน้อย */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2); /* เพิ่มเงา */
    }

    /* เอฟเฟกต์เปลี่ยนสีเมื่อชี้เมาส์ */
    .btn:hover, .sweet-alert button.confirm:hover, .wizard>.actions a:hover {
        background-color: #ffffff; /* สีพื้นเปลี่ยนเป็นขาว */
        color: #ff0000; /* ข้อความเปลี่ยนเป็นแดง */
        box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.3); /* เงาเพิ่มความลึก */
        transform: scale(1.05); /* ขยายเล็กน้อย */
    }

    /* เพิ่มเอฟเฟกต์กด */
    .btn:active, .sweet-alert button.confirm:active, .wizard>.actions a:active {
        background-color: #800000; /* สีแดงเข้ม */
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); /* เงาลดความลึก */
        transform: scale(0.98); /* ย่อเล็กน้อย */
    }
</style>



</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" method="POST" action="{{url('login_backend')}}">
                        @csrf
                            <div class="text-center">
                                <!-- <img src="{{asset('assets/img/login-bk.jpg')}}" style="width:300px" alt="logo.png"> -->
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">ADMIN NF THEATER LOGIN</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Your Email Address" name="email" value="{{ old('email') }}" maxlength = "150" required>
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required maxlength="12">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <!-- <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Forgot Password?</a>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn  btn-md btn-block waves-effect text-center m-b-20">Login</button>
                                    </div>
                                </div>
                                <hr/>
                                <img src="{{asset('assets/img/Frame 1 (1).png')}}" style="width:300px" alt="small-logo.png">
                                <!-- <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
                                        <p class="text-inverse text-left"><b>Your Authentication Team</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="" alt="small-logo.png">
                                    </div>
                                </div> -->

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script  src="{{asset('files/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script  src="{{asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script  src="{{asset('files/bower_components/modernizr/js/modernizr.js')}}"></script>
    <script  src="{{asset('files/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
    <!-- i18next.min.js -->
    <script  src="{{asset('files/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
    <script  src="{{asset('files/assets/js/common-pages.js')}}"></script>

    @if(session('success'))
        <script>
        alert('{{session("success")}}');
        </script>
        @endif


        @if(session('login'))
        <script>
        alert('{{session("login")}}');
        </script>
        @endif
        
</body>

</html>
