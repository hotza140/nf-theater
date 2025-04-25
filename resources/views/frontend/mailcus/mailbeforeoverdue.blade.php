<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <style>
        a:link, a:visited {
          background-color: #f44336;
          color: white;
          padding: 14px 25px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
        }
        
        a:hover, a:active {
          background-color: red;
        }
    </style> --}}
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
    <style>
        a:link {
          text-decoration: none;
        }
        
        a:visited {
          text-decoration: none;
        }
        
        a:hover {
          text-decoration: none;
        }
        
        a:active {
          text-decoration: none;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td><img src="{{$message->embed($ImageLinklogo)}}" alt="" style="width: 80px;"></td>
            <td style="font-size: 28px;"><b>แจ้งการหมดอายุของ Package ที่ใช้บริการจาก NF THEATER.</b></td>
        </tr>
        <tr>
            <td colspan="2">
              เรียนท่านผู้ใช้บริการ คุณ{{$users->name}} ขณะท่านมีเวลาถึงวันที่ <b style="color:#f44336;">{{date('d-m-Y',strtotime($users_in_in->date_end))}}</b> 
              ก่อนจะหมดเวลาในการต่ออายุ <b style="color:#008CBA;">{{$users->package}}</b> โปรดตรวจสอบ!.
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;padding:10px;">
                <a class="button button3" href="{{route('frontend.login')}}"
                    style="color: #e7e7e7 !important;">
                    ต่ออายุ Package
                </a>
            </td>
        </tr>
    </table>
</body>
</html>