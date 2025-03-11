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
                        <h5 class="m-b-10">USERS NETFLIX BACKEND</h5>

                    </div>
                </div>
                <!-- Page-header end -->


                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">

                                    <form class="form-horizontal" action="{{url('users_add_many')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row" >
                                        <div class="col-sm-1">
                                        <input type="number" class="form-control" id="number_input" name="number" value="1" min="1" max="10" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="submit" class="btn btn-success" style="color:white;">
                                                <i class="fa fa-plus"></i> สร้างแบบหลาย User
                                                </button>
                                            </div>

                                            <div class="col-sm-1">
                                            
                                            </div>

                                            <div class="col-sm-1">
                                            <a style="color:white;" class="btn btn-success" href="{{url('users_add')}}"> <i class="fa fa-plus"></i> สร้างแบบ User เดียว</a>
                                            </div>


                                            
                                            
                                        </div>
                                        </form>
                                        <script>
                                        document.getElementById("number_input").addEventListener("input", function () {
                                            if (this.value > 10) {
                                                this.value = 10;
                                            } else if (this.value < 1) {
                                                this.value = 1;
                                            }
                                        });
                                        </script>


                                        <?php
                                            $status_account = $status_account ?? 999;
                                        ?>
                                    
                                        <br>
                                        <form class="form-horizontal" action="{{url('users')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row" style="display: flex; justify-content: flex-end;">
                                        <div class="col-sm-2">
                                            <select name="status_account" id="" class="form-control">
                                            <option  value="999" @if(@$status_account==999) selected  @endif >ทั้งหมด (สถานะแอคเคาท์)</option>
                                            <option  value="0" @if(@$status_account==0) selected  @endif >มีแอคเคาท์</option>
                                            <option  value="1" @if(@$status_account==1) selected  @endif >ไม่มีแอคเคาท์</option>
                                            <option  value="2" @if(@$status_account==2) selected  @endif >หมดอายุ</option>
                                            </select>
                                            </div>

                                            <div class="col-sm-2">
                                            <select name="status_user" id="" class="form-control">
                                            <option  value="1" @if(@$status_user==1) selected  @endif >สถานะตัวแทน (ทั้งหมด)</option>
                                            <option  value="2" @if(@$status_user==2) selected  @endif >เฉพาะตัวแทน</option>
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
                                    


                                        <div class="col-sm-2">
                                            <a style="color:white;" class="btn btn-info" href="{{url('his_created')}}" target="_blank" >ประวัติการสร้าง User</a>
                                            </div>

                                            <br><br>

                                </div>

                                <style>
                                                    .status-active {
                                                        color: white;
                                                        background-color: #dc3545; /* สีแดง */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    .status-inactive {
                                                        color: white;
                                                        background-color: #28a745; /* สีเขียว */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    .status-expired {
                                                        color: white;
                                                        background-color: #6c757d; /* สีเทา */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }


                                                    .status-oo {
                                                        color: white;
                                                        background-color: #ea7500; /* สีเทา */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    @keyframes beepEffect {
                                                            0% { opacity: 1; }
                                                            50% { opacity: 0; }
                                                            100% { opacity: 1; }
                                                        }

                                                        .beepbeep {
                                                            animation: beepEffect 2s infinite;
                                                            color: white; 
                                                            font-weight: bold; 
                                                        }
                                                    </style>

                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Open/Close</th>
                                                    <th>สถานะแก้ใข</th>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Username</th>
                                                    <th>Name Profile</th>
                                                    <th>ชื่อไลน์ลูกค้า</th>
                                                    <th>Package</th>
                                                    <th>วันที่ใช้งานคงเหลือ</th>
                                                    <th>สถานะ Account</th>
                                                    <th>Tool</th>
                                                    <th>Add Profile</th>
                                                    <th>Account</th>
                                                   
                                                    

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <?php  $t_users = App\Models\users::whereNotNull('type_netflix')->where('id','!=',$items->id)->where('username',$items->username)->orderBy('id','asc')->get();  ?>
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>

                                                    <td>
                                                    <form method="post" id="form{{$items->id}}" name="form{{$items->id}}">
                                                        @csrf
                                                        <label class="switch">
                                                            <input type="checkbox" class="toggle-switch" data-id="{{$items->id}}" 
                                                                {{ $items->open == 0 ? 'checked' : '' }}> <!-- ค่าที่เปิดจะเป็น 0 -->
                                                            <span class="slider"></span>
                                                        </label>
                                                    </form>
                                                    </td>

                                                    <td>
                                                        @if($items->status_edit == 1)
                                                            <span class="status-oo beepbeep">กำลังมีการแก้ใข</span>
                                                        @else
                                                           
                                                        @endif
                                                    </td>

                                                    <?php
                                                    if($items->type=='PC'){
                                                        $paga='TV '.@$items->package;
                                                    }else{
                                                        $paga='ยกเว้นทีวี '.@$items->package;
                                                    }

                                                    ?>

                                                    <!-- <td><img src="{{asset('/img/upload/'.$items->picture)}}" style="width:90px"></td> -->
                                                    <td>
                                                    @if($items->username == null and $items->password==null)
                                                            <span class="status-expired">ตัวแทน</span>
                                                        @endif
                                                        {{$items->username}}
                                                    </td>
                                                    <td>{{$items->name}}
                                                        @foreach($t_users as $t_userss)
                                                        <br><a href="{{url('users_edit/'.$t_userss->id)}}" target="_blank">{{$t_userss->name}}</a>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$items->line}}</td>

                                                    <td>{{@$paga}}
                                                    @foreach($t_users as $t_userss)
                                                    <?php
                                                    if($t_userss->type=='PC'){
                                                        $paga_a='TV '.@$t_userss->package;
                                                    }else{
                                                        $paga_a='ยกเว้นทีวี '.@$t_userss->package;
                                                    }

                                                    ?>
                                                    <br>{{@$paga_a}}
                                                    @endforeach
                                                    </td>

                                                    <?php
                                                    $date_start = $items->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    $date_end = $items->date_end; // วันที่สิ้นสุด (Y-m-d)
                                                    $today = date('Y-m-d'); // วันที่ปัจจุบัน

                                                    if ($date_start && $date_end) {
                                                        if (strtotime($today) < strtotime($date_start)) {
                                                            $status = "ยังไม่เข้าช่วง";
                                                        } elseif (strtotime($today) >= strtotime($date_start) && strtotime($today) <= strtotime($date_end)) {
                                                            $days_remaining = (strtotime($date_end) - strtotime($today)) / (60 * 60 * 24);
                                                            $status = "เหลืออีก $days_remaining วัน";
                                                        } else {
                                                            $status = "หมดอายุแล้ว";
                                                        }
                                                    } else {
                                                        $status = "ไม่มีข้อมูลวันที่";
                                                    }

                                                    if ($date_start) {
                                                        $formatted_date1 = date('d/m/Y', strtotime($date_start));
                                                    } else {
                                                        $formatted_date1 = null;
                                                    }
                                                    if ($date_end) {
                                                        $formatted_date2 = date('d/m/Y', strtotime($date_end));
                                                    } else {
                                                        $formatted_date2 = null;
                                                    }
                                                    ?>

                                                    

                                                    <td>{{@$formatted_date1}} ถึง {{@$formatted_date2}} ({{@$status}})
                                                    @foreach($t_users as $t_userss)
                                                    <?php
                                                    $date_start = $t_userss->date_start; // วันที่เริ่มต้น (Y-m-d)
                                                    $date_end = $t_userss->date_end; // วันที่สิ้นสุด (Y-m-d)
                                                    $today = date('Y-m-d'); // วันที่ปัจจุบัน

                                                    if ($date_start && $date_end) {
                                                        if (strtotime($today) < strtotime($date_start)) {
                                                            $status = "ยังไม่เข้าช่วง";
                                                        } elseif (strtotime($today) >= strtotime($date_start) && strtotime($today) <= strtotime($date_end)) {
                                                            $days_remaining = (strtotime($date_end) - strtotime($today)) / (60 * 60 * 24);
                                                            $status = "เหลืออีก $days_remaining วัน";
                                                        } else {
                                                            $status = "หมดอายุแล้ว";
                                                        }
                                                    } else {
                                                        $status = "ไม่มีข้อมูลวันที่";
                                                    }

                                                    if ($date_start) {
                                                        $formatted_date1 = date('d/m/Y', strtotime($date_start));
                                                    } else {
                                                        $formatted_date1 = null;
                                                    }
                                                    if ($date_end) {
                                                        $formatted_date2 = date('d/m/Y', strtotime($date_end));
                                                    } else {
                                                        $formatted_date2 = null;
                                                    }
                                                    ?>
                                                    <br>{{@$formatted_date1}} ถึง {{@$formatted_date2}} ({{@$status}})
                                                    @endforeach
                                                    </td>
                                                    <td>
                                                        @if($items->status_account == 0)
                                                            <span class="status-active">มีแอคเคาท์</span>
                                                        @elseif($items->status_account == 1)
                                                            <span class="status-inactive">ไม่มีแอคเคาท์</span>
                                                        @else
                                                            <span class="status-expired">หมดอายุ</span>
                                                        @endif

                                                        @foreach($t_users as $t_userss)
                                                        <br>
                                                        @if($t_userss->status_account == 0)
                                                            <span class="status-active">มีแอคเคาท์</span>
                                                        @elseif($t_userss->status_account == 1)
                                                            <span class="status-inactive">ไม่มีแอคเคาท์</span>
                                                        @else
                                                            <span class="status-expired">หมดอายุ</span>
                                                        @endif
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                    <a href="{{url('users_edit/'.$items->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('users_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                        <button class="btn btn-sm btn-primary" onclick="copyUserInfo('{{$items->username}}', '{{$items->password}}', '{{$items->name}}', '{{@$paga}}', '{{$items->link}}')">
                                                            <i class="fa fa-copy"></i> Copy
                                                        </button>
                                                    </td>

                                                    <td>
                                                    <form method="GET" action="{{url('users_add')}}" id="form{{$items->id}}" name="form{{$items->id}}" target="_blank">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{@$items->id}}">
                                                        <button type="submit" class="btn btn-sm btn-success" style="color:white;" target="_blank"><i class="fa fa-gear"></i>NETFLIX</button>
                                                    </form>
                                                    </td>

                                                    <?php
                                                     $accounts=App\Models\users_in_in::where('id_user',@$items->id)->orderby('id','desc')->cursor();
                                                    ?>
                                                     <td>
                                                    @foreach($accounts as $accountss)
                                                    <?php
                                                    $check_test=App\Models\users_in::where('id',@$accountss->id_user_in)->first();
                                                    ?>
                                                    <a href="{{url('users_in_edit/'.@$check_test->id)}}" target="_blank" >{{@$check_test->name}}</a>
                                                    <br>
                                                    @endforeach
                                                     </td>

                                                   

                                                  

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <script>
                                    function fallbackCopyTextToClipboard(text) {
                                        const textArea = document.createElement("textarea");
                                        textArea.value = text;
                                        document.body.appendChild(textArea);
                                        textArea.focus();
                                        textArea.select();
                                        try {
                                            document.execCommand("copy");
                                            alert("คัดลอกข้อมูลสำเร็จ!");
                                        } catch (err) {
                                            console.error("คัดลอกไม่สำเร็จ: ", err);
                                            alert("คัดลอกไม่สำเร็จ กรุณาลองอีกครั้ง");
                                        }
                                        document.body.removeChild(textArea);
                                    }

                                    function copyUserInfo(username, password, name, package, link) {
                                        let textToCopy = `Username : ${username}\nPassword : ${password}\nชื่อโปรไฟล์: ${name}\nแพ็กเกจที่สมัคร : ${package}\nลิงก์เข้าใช้งาน : ${link}`;

                                        if (navigator.clipboard && navigator.clipboard.writeText) {
                                            navigator.clipboard.writeText(textToCopy).then(() => {
                                                alert("คัดลอกข้อมูลสำเร็จ!");
                                            }).catch(err => {
                                                console.error('คัดลอกไม่สำเร็จ: ', err);
                                                fallbackCopyTextToClipboard(textToCopy);
                                            });
                                        } else {
                                            console.warn("ใช้ HTTP → เปลี่ยนไปใช้ execCommand แทน");
                                            fallbackCopyTextToClipboard(textToCopy);
                                        }
                                    }
                                    </script>

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



                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
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

            fetch('{{ url("/users_open_close") }}', {
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
</script>


@endsection