@extends('layouts.menubar')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">USERS YOUTUBE/ADD</h5>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('y_users_in_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->

                                     

                                        <?php
                                        $runnum=DB::table('tb_users_in')->orderby('id','desc')->count();
                                        $runtotal=$runnum+1;
                                        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
                                        $run = "NF-{$xxxx}";

                                        $run = 'YT';

                                        if(@$item->name!=null){
                                            $run=@$item->name;
                                        }

                                        ?>


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Account</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="{{@$run}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email*</label>
                                                <input type="email" name="email" class="form-control" id=""  maxlength = "150"
                                                     required value="{{@$item->email}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$item->password}}" placeholder="รหัสผ่าน" >
                                            </div>
                                        </div>

                                      

                                        <?php
                                        $date_s=date('Y-m-d');
                                        if(@$item->date_start!=null){
                                            $date_s=@$item->date_start;
                                        }

                                        ?>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">วันต่ออายุ</label>
                                                <input type="date" name="date_start" class="form-control" id=""
                                                      value="{{@$date_s}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เวลา</label>
                                                <input type="time" name="time" class="form-control" id=""
                                                      value="{{@$item->time}}">
                                            </div>
                                        </div>


                                        <?php $country=DB::table('tb_country')->orderByRaw("CONVERT(title USING tis620) ASC")->cursor(); ?>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Country</label>
                                                <select name="country" id="country" class="form-control add_select2"  >
                                                @foreach($country as $key=>$countrys)
                                                <option value="{{@$countrys->title}}" @if(@$item->country==@$countrys->title) selected  @endif >{{@$countrys->title}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">รหัส 8 หลัก</label>
                                                <input type="test" name="code" class="form-control" id=""
                                                      value="{{@$item->code}}">
                                            </div>
                                        </div>


                                        <br><br>
                                        <h3>รอบบิล</h3>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">กรอกข้อมูลรอบบิล</label>
                                                <input type="text" name="date_ee" class="form-control" id=""
                                                      value="{{@$item->date_ee}}">
                                            </div>
                                        </div>



                                        <p class="text-right">
                                            <a href="{{ url('y_users_in') }}"
                                                style="color:white;" class="btn btn-warning"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>


    @endsection

    @section('script')


    @endsection