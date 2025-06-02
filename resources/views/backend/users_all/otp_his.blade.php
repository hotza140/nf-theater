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
                        <h5 class="m-b-10">OTP And Mail History</h5>

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

                                <h3>คนที่ส่งยืนยัน EMAIL</h3>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="db_table table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th>profile</th>
                                                    <th>email</th>
                                                    <th>phone</th>
                                                    <th>วันที่ยืนยัน Email</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <?php 
                                            $date_start=$items->otp_status_mail;
                                            if ($date_start) {
                                                        $formatted_date1 = date('d/m/Y', strtotime($date_start));
                                                    } 
                                                    
                                                    ?>
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$items->username}}</td>
                                                    <td>{{$items->name}}</td>
                                                    <td>{{$items->email}}</td>
                                                    <td>{{$items->phone}}</td>
                                                    <td>{{@$formatted_date1}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->





                  <!-- Page-body start -->
                  <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">

                                <h3>คนที่ส่งยืนยัน OTP</h3>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="db_table table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th>profile</th>
                                                    <th>email</th>
                                                    <th>phone</th>
                                                    <th>วันที่ยืนยัน Email</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item2 as $key=>$item2s)
                                            <?php 
                                            $date_start2=$item2s->otp_status_phone;
                                            if ($date_start2) {
                                                        $formatted_date2 = date('d/m/Y', strtotime($date_start2));
                                                    } 
                                                    
                                                    ?>
                                            <tr class="num" id="{{$item2s->id}}">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item2s->username}}</td>
                                                    <td>{{$item2s->name}}</td>
                                                    <td>{{$item2s->email}}</td>
                                                    <td>{{$item2s->phone}}</td>
                                                    <td>{{@$formatted_date2}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
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