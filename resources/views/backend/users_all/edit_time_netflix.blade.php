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

                                <?php
                                            $status_account = $status_account ?? 999;
                                        ?>

                                    <a style="color:white;" class="btn btn-info" href="{{url('users_in')}}"> <i class="fa fa-plus"></i> ย้อนกลับ</a>
                 
                                        <br>
                                        <form class="form-horizontal" action="{{url('edit_time_netflix')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="form-group row" style="display: flex; justify-content: flex-end;">
                                        <div class="col-sm-2">
                                        <select name="status_account" id="" class="form-control">
                                            <option  value="999" @if(@$status_account==999) selected  @endif >ทั้งหมด</option>
                                            <option  value="0" @if(@$status_account==0) selected  @endif >ยังไม่หมดอายุ</option>
                                            <option  value="1" @if(@$status_account==1) selected  @endif >หมดอายุ</option>
                                            <option  value="2" @if(@$status_account==2) selected  @endif >Account ที่ใกล้หมดอายุ 1 วัน</option>
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

                                    
                                    <form class="form-horizontal" action="{{url('edit_time_netflix_send')}}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                        <table id="simpletable_call_out" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>เลือก</th>
                                                    <th>Name Account</th>
                                                    <th>Email / Password</th>
                                                    <th>วันที่ใช้งาน</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>
                                                    <!-- ✅ ช่องติ๊ก -->
                                                    <td>
                                                    <input type="checkbox" name="selected_ids[]" value="{{ $items->id }}" class="checkbox-item">
                                                    </td>
                                                    
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
                                                </tr>
                                                
                                                @endforeach

                                            </tbody>

                                            <?php $date=date('Y-m-d'); $date_plus_30 = date('Y-m-d', strtotime($date . ' +30 days')); ?>

                                            <div class="form-group row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id="date_start"
                                                      value="{{@$date}}"  required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                      value="{{@$date_plus_30}}"  required >
                                            </div>
                                            </div>

                                            <div class="form-group row">

                                            <div class="col-sm-2">
                                                <button type="button" id="select_all" class="btn btn-warning" style="color:white;">เลือกทั้งหมด
                                                </button>
                                            </div>

                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-success" style="color:white;"
                                                    onclick="return confirm('Confirm!');">
                                                    <i class="fa fa-check-circle-o"></i> Save
                                                </button>
                                            </div>

                                           
                                        </div>

                                            

                                      <script>
    document.getElementById('select_all').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('.checkbox-item');
        let anyUnchecked = false;

        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                anyUnchecked = true;
            }
        });

        checkboxes.forEach(checkbox => {
            checkbox.checked = anyUnchecked;
        });

        // ตั้งค่า select_all ให้ตรงกับผลลัพธ์ด้วย
        this.checked = anyUnchecked;
    });
</script>

                                        </table>
                                        </form>

                                    </div>

                                    <!-- Pagination -->

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




@endsection