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
                        <h5 class="m-b-10">ADMIN Account/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('admin_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->

                                        @if(@$item->picture!=null)
                                        <br><div><a href="{{asset('img/upload/'.@$item->picture)}}" target="_blank">
                                        <img src="{{asset('img/upload/'.@$item->picture)}}" width="200px" id="imgA"></a></div>
                                        @else
                                        <br><div><img src="#" width="200px" id="imgA"></div>
                                        @endif
                                        <div>
                                            <input type="file" name="picture" id="picture1" class="hidden"
                                                onchange="readURL(this, '#imgA');">
                                            <div class="sm:grid grid-cols-3 gap-2">
                                                <div class="input-group mt-2 sm:mt-0">
                                                </div>
                                            </div>
                                        </div>
                                        <h6 style="color: red;" >(ขนาดรูปไม่เกิน ขนาด Width 100px Height 100px)</h6>
                                        <label for="picture1" class="btn btn-warning " style="color:white;"> 
                                        <i class="fa fa-picture-o"></i>Upload Picture</label><br><br>



                                        <div class="form-group row">
                                       <div class="col-sm-6">
                                            <label for="">Postion</label>
                                            <select name="type" id="" class="form-control"  >
                                                <option @if(@$item->type == '0') selected @endif value="0">Super</option>
                                                <option @if(@$item->type == '1') selected @endif value="1">Admin</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="{{@$item->name}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email*</label>
                                                <input type="email" name="email" class="form-control" id=""  maxlength = "25"
                                                     required value="{{@$item->email}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">New Password* (ไม่เกิน 20 ตัวอักษร)</label>
                                                <input type="text" name="password" class="form-control" id="" required  maxlength="20">
                                            </div>
                                        </div>


                                        <p class="text-right">
                                            <a href="{{ url('admin') }}"
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