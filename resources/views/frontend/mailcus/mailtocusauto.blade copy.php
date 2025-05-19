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
            <td style="font-size: 28px;"><b>ยืนยันอีเมล์ กับทาง NF THEATER.</b></td>
        </tr>
        <tr>
            <td colspan="2">เมล {{$emailconfirmIS}} ของท่านที่ต้องการยืนยันกับทาง NF THEATER.</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;padding:10px;">
                <a class="button button3" href="{{route('api.receiveconfirmmailck')}}?rtoken={{$genTokenIS}}"
                    style="color: #e7e7e7 !important;">
                    กรุณายืนยันเมลของท่าน
                </a>
            </td>
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p><img src="{{$message->embed($ImageLinklogo)}}" alt="" style="width: 80px;"></p>
    <p><h1>ยืนยันอีเมล์ กับทาง NF THEATER.</h1></p>
    <p>เมล {{$emailconfirmIS}} ของท่านที่ต้องการยืนยันกับทาง NF THEATER.</p>
    <p>{{route('api.receiveconfirmmailck')}}?rtoken={{$genTokenIS}}</p>
    <p>กรุณายืนยันเมลของท่าน</p>
</body>
</html>