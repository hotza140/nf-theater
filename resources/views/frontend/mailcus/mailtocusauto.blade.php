<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    {{-- <p><img src="{{$message->embed($ImageLinklogo)}}" alt="" style="width: 80px;"></p> --}}
    <p><b><h1>NF Streaming.</h1></b></p>
    <p><h1>ยืนยันอีเมล์ กับทาง NF Streaming.</h1></p>
    <p>เมล {{$emailconfirmIS}} ของท่านที่ต้องการยืนยันกับทาง NF Streaming.</p>
    <p>{{route('api.receiveconfirmmailck')}}?rtoken={{$genTokenIS}}</p>
    <p>กรุณายืนยันเมลของท่าน</p>
</body>
</html>