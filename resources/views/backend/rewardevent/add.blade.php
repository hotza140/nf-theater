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
                        <h5 class="m-b-10">Reward Event /ADD</h5>

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

                                    <form method="post" id="" action="{{ url('rewardevent_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username Code*</label>
                                                <input type="text" name="username_reward" class="form-control" id=""  
                                                placeholder=""  required>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">รางวัลที่ได้/รายละเอียด*</label>
                                                <input type="text" name="reward_what" class="form-control" id="" required >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Start*</label>
                                                <input type="date" name="reward_start" class="form-control" id="" 
                                                placeholder="" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Stop*</label>
                                                <input type="date" name="reward_stop" class="form-control" id=""  
                                                placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Status</label>
                                                <select name="reward_event_status" id="reward_event_status" class="form-control">
                                                    <option value="0" selected>ปิด</option>
                                                    <option value="1">เปิด</option>
                                                    <option value="2">ลูกค้ามารับ Event</option>
                                                    <option value="3">ยกเลิก Event ลูกค้า</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                        </div>

                                        <p class="text-right">
                                            <a href="{{ url('rewardevent') }}"
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