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
                        <h5 class="m-b-10">ประวัติการสร้าง USERS NETFLIX BACKEND</h5>

                    </div>
                </div>
                <!-- Page-header end -->


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

                                                    @keyframes beepEffect {
                                                            0% { opacity: 1; }
                                                            50% { opacity: 0; }
                                                            100% { opacity: 1; }
                                                        }

                                                        /* .beepbeep {
                                                            animation: beepEffect 2s infinite;
                                                            color: white; 
                                                            font-weight: bold; 
                                                        } */
                                                    </style>

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                            <a style="color:white;" class="btn btn-warning" href="{{url('users')}}">ย้อนกลับ</a>
                                            
                                        </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Admin ที่เพิ่มข้อมูล</th>
                                                    <th>รายละเอียด</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <?php
                                            $admin=DB::table('tb_admin')->where('id',$items->id_admin)->first();
                                            $all = DB::table('tb_his_created_user')
                                            ->where('number', $items->number)
                                            ->orderBy('id_user_in', 'asc')
                                            ->get();

                                            $check_all = DB::table('tb_his_created_user')
                                            ->where('number', $items->number)
                                            ->where('status',0)
                                            ->orderBy('id_user_in', 'asc')
                                            ->first();
                                            ?>
                                            <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{@$admin->name}} 
                                                        @if(@$check_all!=null)
                                                    <a href="{{url('users_edit_status_check_admin_all/'.$items->number)}}" class="btn btn-danger" style="color:white;" onclick="javascript:return confirm('Confirm?')" >
                                                                <span >เปลี่ยนทั้งหมด</span>
                                                            </a> 
                                                            @endif 
                                                    </td>
                                                    <td>
                                                    @php 
                                                        $previousGroup = null;
                                                    @endphp

                                                    @foreach($all as $alls)
                                                        @if ($previousGroup !== null && $previousGroup != $alls->id_user_in)
                                                            <li style="margin-top: 10px; border-top: 2px solid #ccc; padding-top: 10px;"></li> 
                                                        @endif

                                                        <li>
                                                            {!! @$alls->detail !!} 
                                                            @if($alls->status == 0)
                                                                <a href="{{url('users_edit_status_check_admin/'.$alls->id)}}" onclick="return confirm('Confirm?')">
                                                                    <span style="color: red; font-weight: bold;">&nbsp&nbsp รอส่งคำเชิญ</span>
                                                                </a>
                                                            @endif
                                                        </li>

                                                        @php 
                                                            $previousGroup = $alls->id_user_in;
                                                        @endphp
                                                    @endforeach
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($items->created_at)->format('d/m/Y : H:i') }}</td>

                                                </tr>
                                                <br>
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


@endsection