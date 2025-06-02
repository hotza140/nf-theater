<!DOCTYPE html>
<html lang="en">


<!-- Gradient Able Bootstrap admin template made using Bootstrap 4 -->
<head>
    <title>NF THEATER</title>
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
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- Favicon icon -->

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->

    <!-- <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap/css/bootstrap.min.css')}}"> -->

    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/icofont/css/icofont.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.cs')}}s">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="{{asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/jquery.mCustomScrollbar.css')}}">

      <!-- jpro forms css -->
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/pages/j-pro/css/demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/pages/j-pro/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/pages/j-pro/css/j-pro-modern.css')}}">
      <!-- Switch component css -->
      <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/switchery/css/switchery.min.css')}}">

    <!-- เสริม -->
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/sweetalert/css/sweetalert.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/component.css')}}">
    <!-- เสริม -->


    <!-- ตาปิดเปิด -->
    <!-- https://www.w3resource.com/icon/font-awesome/web-application-icons/eye-slash.php -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
       <!-- ตาปิดเปิด -->

       <link rel="icon" href="{{asset('assets/img/Frame 1 (1).png')}}">


        <!-- summernote -->
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
     <!-- summernote -->




    <!-- เรียงลำดับ -->
    <style>
    .sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 1500px;
    }

    .sortable li {
        margin: 3px 3px 3px 0;
        padding: 1px;
        float: left;
        width: 100px;
        height: 90px;
        font-size: 4em;
        text-align: center;
    }


    /* ปุ่ม */
    /* ปรับแต่งปุ่มทุกประเภท */
        .btn {
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        border-radius: 25px;
        transition: background-color 0.3s, transform 0.3s;
        }

        /* ปุ่มขนาดเล็ก */
        .btn-sm {
        padding: 8px 16px;
        font-size: 14px;
        }

        /* ปุ่มสีเหลือง (Warning) */
        .btn-warning {
        background-color: #FFC107;
        color: white;
        border: none;
        }

        .btn-warning:hover {
        background-color: #FF9800;
        transform: scale(1.05);
        }

        /* ปุ่มสีแดง (Danger) */
        .btn-danger {
        background-color: #F44336;
        color: white;
        border: none;
        }

        .btn-danger:hover {
        background-color: #D32F2F;
        transform: scale(1.05);
        }

        /* ปุ่มสีเขียว (Success) */
        .btn-success {
        background-color: #4CAF50;
        color: white;
        border: none;
        }

        .btn-success:hover {
        background-color: #388E3C;
        transform: scale(1.05);
        }

        /* ปรับแต่งปุ่มที่ถูกกด */
        .btn:active {
        transform: scale(0.98);
        }
        /* ปุ่ม */

        
    </style>
    <!-- เรียงลำดับ -->
 

    <!-- inputfile -->
    <style>
    .hidden {
        display: none;
        visibility: hidden;
    }
    </style>
    <!-- inputfile -->



<!-- SELECT_2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- SELECT_2 -->


    @yield('head')


    <style>
        /* เพิ่มเงาพื้นหลังให้เมนูที่ Active */
.pcoded .pcoded-navbar[navbar-theme="theme1"] .pcoded-item>li.active>a {
    color: #ff0000; /* ข้อความสีแดง */
    border-bottom-color: #ff0000; /* เส้นขอบล่างแดง */
    font-weight: bold;
    box-shadow: 0px 4px 8px rgba(255, 0, 0, 0.3); /* เพิ่มเงาสีแดง */
}

/* เพิ่มเงาพื้นหลังให้เมนูที่ Hover */
.pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li:hover>a {
    color: #ff0000 !important;
    font-weight: bold; /* เน้นข้อความ */
    text-decoration: underline; /* เพิ่มเส้นใต้ */
    box-shadow: 0px 4px 8px rgba(255, 0, 0, 0.3); /* เพิ่มเงาสีแดง */
    transition: all ease-in 0.3s;
}

/* เพิ่มเงาพื้นหลังให้เมนูย่อยที่ Active */
.pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li .pcoded-submenu li.active>a {
    color: #ff0000 !important; /* ข้อความสีแดง */
    font-weight: bold; /* เพิ่มน้ำหนักข้อความ */
    background-color: rgba(255, 0, 0, 0.1); /* เพิ่มพื้นหลังโปร่งใส */
    box-shadow: 0px 4px 8px rgba(255, 0, 0, 0.3); /* เพิ่มเงาสีแดง */
    transition: all ease-in 0.3s; /* ทำให้สมูท */
}

/* เพิ่มเงาพื้นหลังให้เมนูย่อยที่ Hover */
.pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li .pcoded-submenu li:hover>a {
    color: #ff0000 !important; /* ข้อความสีแดง */
    font-weight: bold; /* เพิ่มน้ำหนักข้อความ */
    text-decoration: underline; /* เส้นใต้ */
    background-color: rgba(255, 0, 0, 0.1); /* เพิ่มพื้นหลังโปร่งใส */
    box-shadow: 0px 4px 8px rgba(255, 0, 0, 0.3); /* เพิ่มเงาสีแดง */
    transition: all ease-in 0.3s; /* ทำให้สมูท */
}

    /* เฮดเดอร์พื้นหลังแบบเน็ตฟลิกซ์ */
    .pcoded .pcoded-header[header-theme="theme5"] {
        background: linear-gradient(to right, #ff0000, #800000); /* ไล่สีแดง */
    }

    /* ขอบซ้ายของเมนู Active */
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item>li.active>a:before {
        border-left-color: #ff0000; /* สีแดงสด */
    }

    /* เมนูย่อยที่ Active หรือ Hover */
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li .pcoded-submenu li.active>a,
    .pcoded .pcoded-navbar[active-item-theme="theme4"] .pcoded-item li .pcoded-submenu li:hover>a {
        color: #ff0000 !important; /* ข้อความสีแดง */
        font-weight: bold; /* เพิ่มน้ำหนักข้อความ */
        transition: all ease-in 0.3s; /* เพิ่มการเปลี่ยนแปลง */
    }

    /* เมนูย่อยมีจุดสีขาว */
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item .pcoded-hasmenu[subitem-icon="style7"] .pcoded-submenu>li.active>a>.pcoded-mtext:after,
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item .pcoded-hasmenu[subitem-icon="style7"] .pcoded-submenu>li:hover>a>.pcoded-mtext:after {
        background-color: #ffffff; /* จุดขาว */
    }

    /* เมนู Active */
    .pcoded .pcoded-navbar[navbar-theme="theme1"] .pcoded-item>li.active>a {
        color: #ff0000; /* ข้อความสีแดง */
        border-bottom-color: #ff0000; /* เส้นขอบล่างแดง */
        font-weight: bold;
    }

    /* เมนูย่อย Hover */
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li:hover>a {
        color: #ff0000 !important;
        font-weight: bold; /* เน้นข้อความ */
        text-decoration: underline; /* เพิ่มเส้นใต้ */
        transition: all ease-in 0.3s;
    }

    /* ไอคอนเมนู Hover */
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li:hover>a .pcoded-micon {
        color: #ff0000 !important;
        transform: scale(1.1); /* ขยายเล็กน้อย */
        transition: all ease-in 0.3s;
    }

    /* ป้าย Danger สไตล์ใหม่ */
    .label-danger {
        background: linear-gradient(45deg, #ff0000, #800000); /* ไล่สีแดง */
        color: #ffffff; /* ข้อความสีขาว */
        font-weight: bold;
        border-radius: 3px; /* เพิ่มมุมโค้ง */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2); /* เพิ่มเงา */
    }


    /* ปรับให้ .page-item.active .page-link สวยงามตามธีมสีแดง */
.page-item.active .page-link {
    background-color: #ff0000; /* ใช้สีแดงสำหรับพื้นหลัง */
    border-color: #ff0000; /* ใช้สีแดงสำหรับขอบ */
    color: #ffffff; /* ใช้สีขาวสำหรับข้อความ */
    font-weight: bold; /* ทำให้ข้อความหนาขึ้น */
    box-shadow: 0px 4px 8px rgba(255, 0, 0, 0.3); /* เพิ่มเงาให้สวยงาม */
    transition: all ease-in 0.3s; /* เพิ่มการเปลี่ยนแปลงแบบสมูท */
}

/* เมื่อ .page-item.active .page-link ถูก Hover */
.page-item.active .page-link:hover {
    background-color: #ff0000; /* ใช้สีแดงเมื่อ hover */
    border-color: #ff0000; /* ใช้สีแดงสำหรับขอบเมื่อ hover */
    box-shadow: 0px 6px 10px rgba(255, 0, 0, 0.4); /* เพิ่มเงาให้เข้มขึ้นในขณะ Hover */
    transform: scale(1.05); /* ขยายขนาดเล็กน้อยเมื่อ hover */
    filter: brightness(85%); /* ลดความสว่างเพื่อให้สีเข้มขึ้น */
}


/* theme-loaderโหลด */
.theme-loader .loader-track:after,
.theme-loader .loader-track:before {
    content: "";
    border-radius: 50%;
    position: absolute;
    z-index: 1;
    border: 4px solid #ff0000; /* เปลี่ยนสีตรงนี้ */
    border-top-color: transparent;
    border-bottom-color: transparent;
}

.theme-loader .loader-track .loader-bar:after,
.theme-loader .loader-track .loader-bar:before {
    content: "";
    border-radius: 50%;
    position: absolute;
    z-index: 1;
    border: 4px solid #ff0000; /* เปลี่ยนสีตรงนี้ */
    border-top-color: transparent;
    border-bottom-color: transparent;
}
/* theme-loaderโหลด */

</style>



<style>
    /* ปรับแต่ง Select2 ให้พื้นหลังเป็นขาว */
    .select2-container .select2-selection--single {
        border: 2px solid #757575; /* กำหนดขอบเป็นสี 757575 */
        background-color: #fff !important; /* เปลี่ยนพื้นหลังเป็นสีขาว */
        padding: 5px 10px; /* เพิ่ม padding */
        height: 34px; /* กำหนดความสูงของกล่อง */
        line-height: 30px; /* ปรับความสูงของข้อความ */
        box-sizing: border-box; /* ให้ขนาดรวมขอบและ padding */
    }

    /* ปรับขนาดข้อความให้ไม่ออกนอกกรอบ */
    .select2-container .select2-selection--single .select2-selection__rendered {
        color: #000000; /* กำหนดสีข้อความให้เป็นสี 757575 */
        font-size: 16px; /* ปรับขนาดตัวอักษร */
        line-height: 20px; /* ปรับระยะห่างบรรทัด */
        white-space: nowrap; /* ทำให้ข้อความไม่ตัดบรรทัด */
        overflow: hidden; /* ซ่อนข้อความที่เกินกรอบ */
        text-overflow: ellipsis; /* ใช้ '...'' แสดงข้อความเกินกรอบ */
    }

    /* ปรับแต่งลูกศร */
    .select2-container .select2-selection__arrow {
        border-color: #757575 transparent transparent transparent; /* กำหนดสีลูกศร */
    }

    /* ปรับแต่ง dropdown */
    .select2-container .select2-dropdown {
        border: 1px solid #757575; /* กำหนดขอบ dropdown */
        background-color: #fff;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* ปรับแต่งตัวเลือกใน dropdown */
    .select2-container .select2-results__option {
        color: #000000; /* สีตัวอักษรใน dropdown */
        font-size: 16px; /* ปรับขนาดตัวอักษร */
    }

    /* ปรับพื้นหลังเมื่อเลือกตัวเลือก */
    .select2-container .select2-results__option[aria-selected="true"] {
        background-color: #757575; /* สีพื้นหลังเมื่อเลือกตัวเลือก */
        color: #fff; /* เปลี่ยนสีข้อความเมื่อเลือกตัวเลือก */
    }

      /* ปรับแต่ง Select2 */
      .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: rgba(255, 255, 255, 0.5) !important; /* กำหนดพื้นหลังเป็นสีขาว */
        color: #000000 !important; /* กำหนดสีข้อความเป็นสีดำหรือสีที่ต้องการ */
        padding: 0 !important; /* ปรับ padding ให้พอดี */
    }

    /* ปรับขอบของ Select2 */
    .select2-container--default .select2-selection--single {
        border: 2px solid #757575; /* กำหนดขอบเป็นสี ff0000 */
        border-radius: 4px; /* มุมขอบมน */
    }
    .card .card-header span {
    display: block;
    font-size: 13px;
    margin-top: 0px;
    }
</style>

<style>
     /* ปรับแต่งทุกประเภทของ Input */
     input, textarea, select {
        background-color: #fff !important; /* พื้นหลังเป็นสีขาว */
        color: #333 !important; /* สีข้อความเป็นสีดำ */
        border: 2px solid #757575 !important; /* กำหนดขอบเป็นสีแดง */
        border-radius: 4px !important; /* มุมขอบมน */
        font-size: 16px !important; /* ขนาดตัวอักษร */
        width: 100%; /* ให้ความกว้างเต็ม */
        box-sizing: border-box !important; /* รวมขอบและ padding ในขนาดทั้งหมด */
    }

    /* ปรับแต่งเมื่อ Input หรือ Textarea ได้รับการโฟกัส */
    input:focus, textarea:focus, select:focus {
        outline: none !important; /* ลบเส้นขอบที่แสดงเมื่อ focus */
        border: 2px solid #757575 !important; /* ขอบสีแดงเมื่อโฟกัส */
    }
</style>


</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header" header-theme="themelight2">

                <div class="navbar-wrapper">

                    <div class="navbar-logo" logo-theme="theme6">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        {{-- <span class="input-group-addon search-btn"><i class="ti-search"></i></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('/backend')}}">
                            <img class="img-fluid" src="{{asset('assets/img/Frame 1 (1).png')}}" alt="Theme-Logo" width="50px" />
                            <h7>NF THEATER</h7>
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">

                            <li class="user-profile header-notification">
                                <a href="#!">
                                <img src="{{ asset('img/upload/' . Auth::guard('admin')->user()->picture) }}" class="img-radius" >
                                    <span style="color:white">{{Auth::guard('admin')->user()->name }}</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">

                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->

            <!-- Sidebar inner chat end-->

            <div class="pcoded-main-container" style="background-color:white;">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">


                            <!-- MENU -->
                            <div class="pcoded-navigation-label">MENU <i class="ti-github"></i></div>
                            <!-- MENU -->


                           
                            <!-- admin Page-->
                            <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                <li class="pcoded-hasmenu {{ isset($page) && $page == 'all' ? 'active pcoded-trigger' : '' }}">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext">ADMIN&USERS</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                    <ul class="pcoded-submenu">
                                        
                                   

                                    @if(Auth::guard('admin')->user()->type == 0)
                                        <li class="{{ isset($list) && $list == 'admin' ? 'active' : '' }}">
                                            <a href="{{ url('admin') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Admin</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::guard('admin')->user()->type == 0)
                                        <li class="{{ isset($list) && $list == 'dashbord_all' ? 'active' : '' }}">
                                            <a href="{{ url('dashbord_all') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Dashboard Super</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::guard('admin')->user()->type == 0)
                                        <li class="{{ isset($list) && $list == 'api_log_clear' ? 'active' : '' }}">
                                            <a href="{{ url('api_log_clear') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">API LOG CLEAR</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        <li class="{{ isset($list) && $list == 'users_all' ? 'active' : '' }}">
                                            <a href="{{ url('users_all') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Users All</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>


                                        <li class="">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"></span>
                                                <span class="pcoded-mcaret"></span>
                                        </li>


                                        @if(Auth::guard('admin')->user()->type == 1 or Auth::guard('admin')->user()->type == 0)
                                    <li class="{{ isset($list) && $list == 'dashbord' ? 'active' : '' }}">
                                            <a href="{{ url('dashbord') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Dashboard Netflix</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::guard('admin')->user()->type == 1 or Auth::guard('admin')->user()->type == 0)
                                        <li class="{{ isset($list) && $list == 'users' ? 'active' : '' }}">
                                            <a href="{{ url('users') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Users Netflix</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="{{ isset($list) && $list == 'users_in' ? 'active' : '' }}">
                                            <a href="{{ url('users_in') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Account Netflix</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        <li class="">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"></span>
                                                <span class="pcoded-mcaret"></span>
                                        </li>



                                        @if(Auth::guard('admin')->user()->type == 2 or Auth::guard('admin')->user()->type == 0 or Auth::guard('admin')->user()->type == 3)
                                        <li class="{{ isset($list) && $list == 'dashbord_y' ? 'active' : '' }}">
                                            <a href="{{ url('dashbord_y') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Dashboard Youtube</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(Auth::guard('admin')->user()->type == 2 or Auth::guard('admin')->user()->type == 0 or Auth::guard('admin')->user()->type == 3)
                                        <li class="{{ isset($list) && $list == 'users_youtube' ? 'active' : '' }}">
                                            <a href="{{ url('y_users') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Users Youtube</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="{{ isset($list) && $list == 'users_in_youtube' ? 'active' : '' }}">
                                            <a href="{{ url('y_users_in') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Account Youtube</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        @endif


                                        <li class="{{ isset($list) && $list == 'country' ? 'active' : '' }}">
                                            <a href="{{ url('country') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Country</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <!-- <li class="{{ isset($list) && $list == 'alert' ? 'active' : '' }}">
                                            <a href="{{ url('alert') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">แจ้งเตือนปัญหา</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li> -->


                                    </ul>
                                    <!--DJ page-->
                                </li>
                            </ul>
                            <!-- admin Page-->




                              <!-- admin Page-->
                              <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                <li class="pcoded-hasmenu {{ isset($page) && $page == 'admin' ? 'active pcoded-trigger' : '' }}">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                                        <span class="pcoded-mtext">MENU</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                  
                                    <ul class="pcoded-submenu">

                                        <!--DJ page-->
                                        {{-- <li class="{{ isset($list) && $list == 'coupon' ? 'active' : '' }}">
                                            <a href="{{ url('coupon') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Coupons</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li> --}}

                                        <li class="{{ isset($list) && $list == 'package' ? 'active' : '' }}">
                                            <a href="{{ url('package') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Packages</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="{{ isset($list) && $list == 'reward' ? 'active' : '' }}">
                                            <a href="{{ url('reward') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Rewards</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        {{-- <li class="{{ isset($list) && $list == 'marking' ? 'active' : '' }}">
                                            <a href="{{ url('marking') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Markings</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li> --}}

                                        {{-- <li class="{{ isset($list) && $list == 'gift' ? 'active' : '' }}">
                                            <a href="{{ url('gift') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Gifts</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li> --}}

                                        <li class="{{ isset($list) && $list == 'orderpaypackage' ? 'active' : '' }}">
                                            <a href="{{ url('orderpaypackage') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Payment</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="{{ isset($list) && $list == 'rewardevent' ? 'active' : '' }}">
                                            <a href="{{ url('rewardevent') }}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Manage Reward Events</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--DJ page-->
                                </li>
                            </ul>
                            <!-- admin Page-->

                            
                           


                            <br> <br> <br> <br>
                        </div>
                    </nav>

                    @yield('content')
                </div>
            </div>
        </div>


<!-- ยืนยันก่อนลบ Delete -->
<?php $textsss = DB::table('delete_pass')->first(); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  // ดึงรหัสผ่านจาก PHP
  const deletePassword = @json($textsss->text ?? null);

  const elems = document.querySelectorAll('[onclick*="confirm("]');
  
  elems.forEach(el => {
    const html = el.innerHTML.trim();

    if (
      html === '<i class="fa fa-trash"></i>Delete' ||
      html === '<i class="fa fa-trash"></i>ลบทั้งหมด'
    ) {
      el.onclick = function(event) {
        if (!deletePassword) {
          alert('ยังไม่ตั้งค่ารหัสผ่านสำหรับการลบ');
          event.preventDefault();
          return false;
        }

        const password = prompt('กรุณากรอกรหัสเพื่อยืนยันการลบ:');
        if (password === deletePassword) {
          return true;
        } else {
          alert('รหัสผิด! ไม่สามารถลบได้');
          event.preventDefault();
          return false;
        }
      }
    }
  });
});
</script>
    <!-- ยืนยันก่อนลบ Delete -->


        <!-- คลุมดำ -->
        <script>
        document.querySelectorAll('input[type="text"]').forEach(function(input) {
            input.addEventListener('click', function() {
                this.select();
            });
        });
        </script>

        <!-- คลุมดำ -->
        <script>
        document.querySelectorAll('input[type="email"]').forEach(function(input) {
            input.addEventListener('click', function() {
                this.select();
            });
        });
        </script>



        <!-- // ป้องกันการกด Enter เพื่อส่งข้อมูล ในทุกฟอร์ม -->
        <script>
        document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
        e.preventDefault();  // ป้องกันการกด Enter ในทุกฟอร์ม
        }
        });
        });
        </script>
        <!-- // ป้องกันการกด Enter เพื่อส่งข้อมูล ในทุกฟอร์ม -->



        <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var table = $('#kt_ecommerce_order_table').DataTable(); // ประกาศตัวแปร table

        // ค้นหาผ่าน input ที่กำหนด
        $('#searchOrder').on('keyup', function() {
            table.search(this.value).draw(); // ใช้ table ที่ประกาศไว้
        });
    });
</script> -->
<!-- search แบบปุ่มตรงไหนก็ได้ -->



<!-- แสดงภาพตอนเลือกไฟล -->
        <script>
        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        </script>
      <!-- แสดงภาพตอนเลือกไฟล -->



<!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#simpletable').dataTable({
                order:[],
                stateSave: true,
                lengthChange: false,
                language: {
                info: "", // ปิดข้อความ "Showing X to Y of Z entries"
                infoEmpty: "", // ปิดข้อความเมื่อไม่มีข้อมูล
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>', // ลูกศรซ้าย (Font Awesome)
                    next: '<i class="fa fa-angle-right"></i>' // ลูกศรขวา (Font Awesome)
                }
                },
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>


<!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#simpletable_call').dataTable({
                order:[],
                stateSave: true,
                lengthChange: false,
                paging: false,
                language: {
                info: "", // ปิดข้อความ "Showing X to Y of Z entries"
                infoEmpty: "", // ปิดข้อความเมื่อไม่มีข้อมูล
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>', // ลูกศรซ้าย (Font Awesome)
                    next: '<i class="fa fa-angle-right"></i>' // ลูกศรขวา (Font Awesome)
                }
                },
                "searching": false,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>


<!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#simpletable_call_out').dataTable({
                order:[],
                stateSave: true,
                lengthChange: false,
                paging: false,
                scrollY: "1000px",
                scrollCollapse: true,
                language: {
                info: "", // ปิดข้อความ "Showing X to Y of Z entries"
                infoEmpty: "", // ปิดข้อความเมื่อไม่มีข้อมูล
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>', // ลูกศรซ้าย (Font Awesome)
                    next: '<i class="fa fa-angle-right"></i>' // ลูกศรขวา (Font Awesome)
                }
                },
                "searching": false,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>



<!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#simpletable_no').dataTable({
                order:[2],
                stateSave: true,
                lengthChange: false,
                paging: false,
                language: {
                info: "", // ปิดข้อความ "Showing X to Y of Z entries"
                infoEmpty: "", // ปิดข้อความเมื่อไม่มีข้อมูล
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>', // ลูกศรซ้าย (Font Awesome)
                    next: '<i class="fa fa-angle-right"></i>' // ลูกศรขวา (Font Awesome)
                }
                },
                "searching": false,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>

    <!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#simpletable_no2').dataTable({
                order:[2],
                stateSave: true,
                lengthChange: false,
                paging: false,
                language: {
                info: "", // ปิดข้อความ "Showing X to Y of Z entries"
                infoEmpty: "", // ปิดข้อความเมื่อไม่มีข้อมูล
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>', // ลูกศรซ้าย (Font Awesome)
                    next: '<i class="fa fa-angle-right"></i>' // ลูกศรขวา (Font Awesome)
                }
                },
                "searching": false,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>

    <!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('.simpletable_class').dataTable({
                order:[],
                stateSave: true,
                lengthChange: false,
                paging: false,
                language: {
                info: "", // ปิดข้อความ "Showing X to Y of Z entries"
                infoEmpty: "", // ปิดข้อความเมื่อไม่มีข้อมูล
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>', // ลูกศรซ้าย (Font Awesome)
                    next: '<i class="fa fa-angle-right"></i>' // ลูกศรขวา (Font Awesome)
                }
                },
                "searching": false,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>

   



<!-- จัดการ DATATABLE แบบไม่มี paginate และ search -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#table_no').dataTable({
                order:[],
                stateSave: true,
                paging: false,
                "searching": false,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                },
            });
        } );
    </script>

    <!-- จัดการ DATATABLE -->

        <!-- เสริม -->
        <script src="{{asset('files/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('files/assets/js/modal.js')}}"></script>
        <!-- sweet alert modal.js intialize js -->
        <!-- modalEffects js nifty modal window effects -->
        <script src="{{asset('files/assets/js/classie.js')}}"></script>
        <script src="{{asset('files/assets/js/modalEffects.js')}}"></script>
         <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script  src="{{asset('files/assets/pages/form-validation/validate.js')}}"></script>
    <!-- Custom js -->
    <script  src="{{asset('files/assets/pages/form-validation/form-validation.js')}}"></script>
        <!-- เสริม -->

    <!-- Switch component js -->
    <script  src="{{asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>


         <!-- Required Jquery -->
         <!-- ตัวสำคัญแต่ชน summernote -->
        <!-- <script  src="{{asset('files/bower_components/jquery/js/jquery.min.js')}}"></script> -->
        <!-- ตัวสำคัญแต่ชน summernote -->
        <script src="{{asset('files/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('files/bower_components/popper.js/js/popper.min.js')}}"></script>
        <script src="{{asset('files/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- Required Jquery -->


        <!-- jquery slimscroll js -->
        <script src="{{asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
        <!-- modernizr js -->
        <script src="{{asset('files/bower_components/modernizr/js/modernizr.js')}}"></script>
        <script src="{{asset('files/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
        <!-- data-table js -->
        <script src="{{asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('files/assets/pages/data-table/js/jszip.min.js')}}"></script>
        <script src="{{asset('files/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}">
        </script>
        <script src="{{asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
        </script>
        <!-- Custom js -->
        <script src="{{asset('files/assets/pages/data-table/js/data-table-custom.js')}}"></script>
        <script src="{{asset('files/assets/js/pcoded.min.js')}}"></script>
        <script src="{{asset('files/assets/js/dark-light/vertical-layout.min.js')}}"></script>
        <script src="{{asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{asset('files/assets/js/script.js')}}"></script>

          <!-- j-pro js -->
    <script  src="{{asset('files/assets/pages/j-pro/js/jquery.ui.min.js')}}"></script>
    <script  src="{{asset('files/assets/pages/j-pro/js/jquery.maskedinput.min.js')}}"></script>
    <script  src="{{asset('files/assets/pages/j-pro/js/jquery.j-pro.js')}}"></script>
    <!-- Switch component js -->
    <script  src="{{asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>


        <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>


        <script>
        $(document).ready(function() {
            $('#summernote1').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('#summernote2').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('#summernote3').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>


        <!-- เปลี่ยนลักษณะปุ่ม -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- เปลี่ยนลักษณะปุ่ม -->


        <script>
        //เรียกใช้งาน Select2
        $(".select2-single").select2();
        </script>


        @if(session('message'))
        <script>
        alert('{{session("message")}}');
        </script>
        @endif

        @if(session('success'))
        <script>
        alert('{{session("success")}}');
        </script>
        @endif

        <!-- เรียงลำดับ news-->
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
        $(function() {
            $(".sortable").sortable({
                update: function(event, ui) {
                    updateOrder();
                }
            });
            $(".sortable").disableSelection();
        });

        function updateOrder() {
            var item_order = new Array();
            $('.num').each(function() {
                item_order.push($(this).attr("id"));
            });
            var num = item_order;
            console.log(num);
            $.ajax({

                type: "POST",
                url: "{{url('/orderbyupdate')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    num: num
                },
                cache: false,
                success: function(data) {
                    $("#test").html(data);
                }
            });
        }
        </script>
        <!-- เรียงลำดับ news-->


        <!-- SELECT_2 -->
        <script>
        $(document).ready(function () {
            // กำหนดการทำงานของ Select2
            $('.add_select2').each(function () {
                // ตรวจสอบว่าอยู่ใน Modal หรือไม่
                if ($(this).closest('.modal').length > 0) {
                    // หากอยู่ใน Modal
                    $(this).select2({
                        dropdownParent: $(this).closest('.modal') // กำหนด parent เป็น Modal ที่เกี่ยวข้อง
                    });
                } else {
                    // หากไม่ได้อยู่ใน Modal
                    $(this).select2();
                }
            });
        });
        </script>
        <!-- SELECT_2 -->


        @yield('script')
</body>


</html>
