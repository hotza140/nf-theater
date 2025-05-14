<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Krona+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt&amp;display=swap"> --}}
    {{-- <link rel="stylesheet" href="assets/css/styles.css"> --}}
    {{-- <link rel="stylesheet" href="assets/css/Edit-Form.css"> --}}
    <title>Document</title>
    <style>
        body {
            background-color: rgb(247, 244, 240) !important;
        }
    </style>
</head>
<body>
    <div style="padding:15px;">
        <table style="width: 100%">
            <tr style="font-size: 18px; background-color: antiquewhite;height:50px;">
                <th>no</th>
                <th>name</th>
                <th>username</th>
                <th>email</th>
                <th>package</th>
            </tr>
            @foreach($UserNotifymailLog as $key => $value)
                <tr>
                    <td style="text-align: center;">{{++$i}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->package}}</td>
                </tr>
            @endforeach
        </table>
    </div> 
    <div class="col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-2">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {{ $UserNotifymailLog->appends(Request::except('page'))->links() }}
        </nav>
        {{-- <select class="w-20 form-select box mt-3 sm:mt-0" onchange="reloadpage(0,this.value)" id="selectpage">
            <option value="50" {{!empty($rowpageShowAll) ? ($rowpageShowAll==50 ? 'selected' : '') :'selected'}}>50</option>
            <option value="60" {{!empty($rowpageShowAll) ? ($rowpageShowAll==60 ? 'selected' : '') :''}}>60</option>
            <option value="70" {{!empty($rowpageShowAll) ? ($rowpageShowAll==70 ? 'selected' : '') :''}}>70</option>
            <option value="80" {{!empty($rowpageShowAll) ? ($rowpageShowAll==80 ? 'selected' : '') :''}}>80</option>
            <option value="90" {{!empty($rowpageShowAll) ? ($rowpageShowAll==90 ? 'selected' : '') :''}}>90</option>
            <option value="100" {{!empty($rowpageShowAll) ? ($rowpageShowAll==100 ? 'selected' : '') :''}}>100</option>
        </select> --}}
    </div>
</body>
</html>

{{-- <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelector('body').style = "background-color: antiquewhite !important;"
</script> --}}