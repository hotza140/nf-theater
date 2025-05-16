@extends('layouts.menubar')
@section('content')
<style>
.button{border-radius: 25px;}
</style>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 25px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 19px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #93D600; /* ใช้สีเขียวตามความชอบ */
    }

    input:checked + .slider:before {
        transform: translateX(25px);
    }
</style>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">Package BACKEND</h5>
                    </div>
                </div>
                <!-- Page-header end -->


                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                {{-- <div class="card-header">

                                    <a style="color:white;" class="btn btn-success" href="{{url('package_add')}}"> <i class="fa fa-plus"></i> Add</a>

                                    
                                        <br>
                                        <form class="form-horizontal" action="{{url('package')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="form-group row" style="display: flex; justify-content: flex-end;">
                                        <div class="col-sm-2">
                                        <select name="status_account" id="" class="form-control">
                                            <option  value="999" @if(@$status_account==999) selected  @endif >ทั้งหมด</option>
                                            <option  value="0" @if(@$status_account==0) selected  @endif >ยังไม่หมดอายุ</option>
                                            <option  value="1" @if(@$status_account==1) selected  @endif >หมดอายุ</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="search" value="{{@$search}}">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="submit" class="btn btn-warning" style="color:white;">
                                                    <i class="fa fa-check-circle-o"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div> --}}
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable_call" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    {{-- <th>Open/Close</th> --}}
                                                    {{-- <th>package Code</th> --}}
                                                    <th>package Name</th>
                                                    {{-- <th>วันที่ใช้งาน</th> --}}
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>

                                                    {{-- <td>
                                                    <form method="post" id="form{{$items->id}}" name="form{{$items->id}}">
                                                        @csrf
                                                        <label class="switch">
                                                            <input type="checkbox" class="toggle-switch" data-id="{{$items->id}}" 
                                                                {{ $items->open == 0 ? 'checked' : '' }}> <!-- ค่าที่เปิดจะเป็น 0 -->
                                                            <span class="slider"></span>
                                                        </label>
                                                    </form>
                                                    </td> --}}
                                                    {{-- <td>{{$items->package_Code}}</td> --}}
                                                    <!-- <td><img src="{{asset('/img/upload/'.$items->picture)}}" style="width:90px"></td> -->
                                                    <td>{{$items->package_Name}}</td>
                                                    
                                                    <?php
                                                    // $date_start = $items->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    // $date_end = $items->date_end; // วันที่สิ้นสุด (Y-m-d)
                                                    // $today = date('Y-m-d'); // วันที่ปัจจุบัน

                                                    // if ($date_start && $date_end) {
                                                    //     if (strtotime($today) < strtotime($date_start)) {
                                                    //         $status = "ยังไม่เข้าช่วง";
                                                    //     } elseif (strtotime($today) >= strtotime($date_start) && strtotime($today) <= strtotime($date_end)) {
                                                    //         $days_remaining = (strtotime($date_end) - strtotime($today)) / (60 * 60 * 24);
                                                    //         $status = "เหลืออีก $days_remaining วัน";
                                                    //     } else {
                                                    //         $status = "หมดอายุแล้ว";
                                                    //     }
                                                    // } else {
                                                    //     $status = "ไม่มีข้อมูลวันที่";
                                                    // }

                                                    // if ($date_start) {
                                                    //     $formatted_date1 = date('d/m/Y', strtotime($date_start));
                                                    // } else {
                                                    //     $formatted_date1 = null;
                                                    // }
                                                    // if ($date_end) {
                                                    //     $formatted_date2 = date('d/m/Y', strtotime($date_end));
                                                    // } else {
                                                    //     $formatted_date2 = null;
                                                    // }
                                                    ?>
                                                    {{-- <td>{{@$formatted_date1}} ถึง {{@$formatted_date2}} ({{@$status}})</td> --}}
                                                    <!-- <td>{{$items->country}}</td> -->
                                                    <td>
                                                    <a href="{{url('package_edit/'.$items->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>จัดการ Package</a>
                                                        {{-- <a href="{{url('package_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a> --}}
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <style>
                                        .pagination-wrapper {
                                            text-align: right; /* จัดให้อยู่ขวาสุด */
                                        }
                                    </style>
                                    <div class="pagination-wrapper">
                                        <div>{{ $item->appends(Request::all())->links() }}</div>
                                    </div>
                                    <!-- Pagination -->

                                </div>

                                @php
                                    $DefaultConfig = App\Models\DefaultConfig::find(1);
                                @endphp
                                <div class="dt-responsive table-responsive" style="padding: 25px;">
                                    <form action="{{route('backend.updateDefault')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <b>Config Friend Referral Points.</b>
                                        <table style="margin-top: 10px;">
                                            <tr>
                                                <td style="padding: 5px;">Points : </td>
                                                <td style="padding: 5px;"><input type="number" name="referrer_point" id="referrer_point" class="form-control" value="{{$DefaultConfig->referrer_point}}"></td>
                                                <td style="padding: 5px;"> แต้ม</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="padding : 10px;text-align:end"><button class="btn btn-primary">Change</button></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>

            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-header start -->
                    <div class="page-header card">
                        @php
                            $DefaultConfig = App\Models\DefaultConfig::find(1);
                        @endphp
                        <div class="dt-responsive table-responsive" style="padding: 25px;">
                            <form action="{{route('backend.updateDefault')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <b>Config Content Mail Notify Before Overdue.</b>
                                <div>
                                    <div>{namecus} => หมายถึงชื่อลูกค้า </div>
                                    <div>{dateend} => วันที่ใกล้หมาดอายุ</div>
                                    <div>{package} => ชื่อแพ็คเกจใกล้หมดอายุ</div>
                                </div>
                                <table style="margin-top: 10px;width:100%">
                                    <tr>
                                        {{-- <td style="padding: 5px;">Content Mail : </td> --}}
                                        <td style="padding: 5px;">
                                            <div><Label>Content Mail : </Label></div>
                                            <textarea name="content_mail" id="content_mail" style="width: 100%;height:80px;">{{$DefaultConfig->content_mail}}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        {{-- <td></td> --}}
                                        <td style="padding : 10px;text-align:end"><button class="btn btn-primary">Change</button></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!-- Add icon library -->
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                        <!-- Add font awesome icons to buttons (note that the fa-spin class rotates the icon) -->
                        {{-- <button class="buttonload">
                        <i class="fa fa-spinner fa-spin"></i>Loading
                        </button>

                        <button class="buttonload">
                        <i class="fa fa-circle-o-notch fa-spin"></i>Loading
                        </button>

                        <button class="buttonload">
                        <i class="fa fa-refresh fa-spin"></i>Loading
                        </button> --}}
                        <div class="dt-responsive table-responsive" style="padding: 25px;">
                            <div style="border-style: groove;padding:15px;">
                                <b style="font-size: 18px;">*สามารถทดสอบ ได้ด้วยการกรอก user ที่ต้องการทดสอบที่เตรียมหรือสมัครไว้ที่ยังไม่หมดอายุหรือสม้คร package มาใหม่</b>
                                <table>
                                    <tr>
                                        <td style="padding: 5px;">
                                            <label for="">ป้อนรหัส user เพี่อทดสอบ</label><br>
                                            <input type="text" name="user_u" id="user_u">
                                        </td>
                                        <td>
                                            <br>
                                            <button type="button" class="btn btn-warning" onclick="searchTimeTestBeforeOverdue(document.getElementById('user_u').value)">ค้นหา</button>
                                        </td>
                                        <td style="padding: 5px;">
                                            <label for="">วันที่เริ่มต้น</label><br>
                                            <input type="hidden" name="datestart_u" id="datestart_u">
                                            <input type="date" name="datestart" id="datestart">
                                        </td>
                                        <td style="padding: 5px;">
                                            <label for="">วันที่สิ้นสุด</label><br>
                                            <input type="hidden" name="dateend_u" id="dateend_u">
                                            <input type="date" name="dateend" id="dateend">
                                        </td>
                                        <td style="padding: 5px;">
                                            <input type="hidden" name="mailtest_u" id="mailtest_u">
                                            <label for="">เมล</label><br>
                                            <input type="text" name="mailtest" id="mailtest">
                                        </td>
                                        <td style="padding: 5px;">
                                            <br>
                                            <input type="hidden" name="userIDTmail" id="userIDTmail">
                                            <input type="hidden" name="userininmail" id="userininmail">
                                            <button type="button" class="btn btn-warning" id="btnw1" onclick="TestBeforeOverdue(document.getElementById('userIDTmail').value,document.getElementById('userininmail').value)">ทดสอบส่งเมล</button>
                                            <button class="btn btn-warning buttonload" style="display: none" id="btnw2"><i class="fa fa-circle-o-notch fa-spin"></i>Waitting..</button>
                                        </td>
                                    </tr>
                                </table>     
                            </div>
                            <br>
                            <br>
                            &nbsp;&nbsp;<span style="font-size: 25px;"><b> Log Notify Mail ส่งให้ลูกค้า </b></span><br>
                            <iframe src="{{route('logmailnotify')}}" frameborder="0" id="ifm01" style="width: 100%;height:990px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main-body end -->


        <div id="styleSelector">


        </div>
    </div>
</div>
</div>


@endsection

@section('script')


<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/package_open_close") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, open: isOpen }),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Failed to update status.');
                    // Revert the switch state if update fails
                    this.checked = !this.checked;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert the switch state if an error occurs
                this.checked = !this.checked;
            });
        });
    });
});

function searchTimeTestBeforeOverdue(userID) { 
    fetch('{{ route("searchTimeTestBeforeOverdue") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ userID }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data.users_in_intestmail!=null) {
            document.getElementById('datestart').value = document.getElementById('datestart_u').value = data.users_in_intestmail.date_start;
            document.getElementById('dateend').value = document.getElementById('dateend_u').value = data.users_in_intestmail.date_end;
            document.getElementById('userIDTmail').value = data.users_in_intestmail.id_user;
            document.getElementById('mailtest').value = data.user_testmail.email;
            document.getElementById('mailtest_u').value = data.user_testmail.email;
            document.getElementById('userininmail').value = data.users_in_intestmail.id;
            if(data?.user_testmail?.email?.trim()=='undefined'||data?.user_testmail?.email?.trim()==''||data?.user_testmail?.email?.trim()==null) alert('กรุณาเลือกท่านลูกค้าท่านใหม่ เพราะไม่มีเมลทดสอบ...');
            // alert(data?.user_testmail?.email?.trim());
        } else alert('No have data...')
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function TestBeforeOverdue(userID,userininId) { 
    document.getElementById('btnw2').style.display = 'block';
    document.getElementById('btnw1').style.display = 'none';
    let datestart_u = document.getElementById('datestart_u').value;
    let datestart = document.getElementById('datestart').value;
    let dateend_u = document.getElementById('dateend_u').value;
    let dateend = document.getElementById('dateend').value;
    let mailtest_u = document.getElementById('mailtest_u').value;
    let mailtest = document.getElementById('mailtest').value;
    fetch('{{ route("TestBeforeOverdue") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ userID ,userininId ,datestart_u ,dateend_u ,datestart ,dateend ,mailtest_u ,mailtest }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data.data==1) alert('Sent test mail success.');
        else alert('Sorry , not Sent mail.');
        document.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>


@endsection