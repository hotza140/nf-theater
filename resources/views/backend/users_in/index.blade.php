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
                        <h5 class="m-b-10">USERS Account BACKEND</h5>

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

                                    <a style="color:white;" class="btn btn-success" href="{{url('users_in_add')}}"> <i class="fa fa-plus"></i> Add</a>

                                    
                                        <br>
                                        <form class="form-horizontal" action="{{url('users_in')}}" method="GET" enctype="multipart/form-data">
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

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable_call" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Open/Close</th>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Status</th>
                                                    <th>Name Account</th>
                                                    <th>Email / Password</th>
                                                    <th>วันที่ใช้งาน</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
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
                                                    <i class="fa fa-mobile" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                        <i class="fa fa-mobile" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                        <i class="fa fa-mobile" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                        <i class="fa fa-mobile" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                        <i class="fa fa-mobile" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                        <i class="fa fa-desktop" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                        <i class="fa fa-desktop" style="font-size:30px; color:green;" title="ว่าง"></i>
                                                    </td>

                                                    <!-- <td><img src="{{asset('/img/upload/'.$items->picture)}}" style="width:90px"></td> -->
                                                    <td>{{$items->name}}</td>
                                                    <td>{{$items->email}} <br> {{$items->password}}</td>
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
                                                    <td>{{@$formatted_date1}} ถึง {{@$formatted_date2}} ({{@$status}})</td>
                                                    <!-- <td>{{$items->country}}</td> -->
                                                    <td>
                                                    <a href="{{url('users_in_edit/'.$items->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('users_in_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
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

            fetch('{{ url("/users_in_open_close") }}', {
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