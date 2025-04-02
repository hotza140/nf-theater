<!DOCTYPE html>
<html data-bs-theme="light" lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Netflix Pricing</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Krona+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt&amp;display=swap">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Edit-Form.css')}}">
</head>


<body>
    
    <!-- Start Show -->

    <style>
        .button {
          background-color: #04AA6D; /* Green */
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
          border-radius: 8px;
        }
        
        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
    </style>
    
        <div class="net-container">
            <h1 class="head-pro">NF THEATER</h1>
        </div>
        <div class="net-container">
            <div class="net-plans">
                <div class="net-plan">
                    <div class="thank-pay-div">
                        <p class="h-text-thank">ยืนยันอีเมล์</p>
                        <div><img src="{{asset('assets/img/men007.png')}}"></div>
                        
                        <div class="h2-text-thank">
                            @if(@$ConfirmMail)
                                <p style="margin: 0px;">ขอบคุณสำหรับการยืนยันอีเมล์(ผู้ใช้งาน : {{$ConfirmMail->username_confirm}})</p>
                                <p>เมลชื่อ : {{$ConfirmMail->email_confirm}}</p>
                            @else 
                                <p style="margin: 0px;">คุณไม่สามารถยืนเมลด้วยลิงค์นี้ได้</p>
                                <p>กรุณาทำการยืนยันเมลใหม่ !.</p>
                            @endif
                            <p><a href="{{route('frontend.login')}}" class="button button3">กลับไปยังหน้าใช้งาน</a></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
       
    <!-- END SHOW -->
    
    <div>
        <p class="copy-r">Copyright ©&nbsp;NF Theater&nbsp;2024.</p>
    </div>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('message'))
        <script>
            alert('{{session("message")}}');
        </script>
    @endif

</body>

</html>



