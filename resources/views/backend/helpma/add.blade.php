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
                        <h5 class="m-b-10">helpma/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('helpma_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        @if(@$item->picture!=null)
                                            <br><div><a href="{{asset('img/upload/helpma/'.@$item->picture)}}" target="_blank">
                                            <img src="{{asset('img/upload/helpma/'.@$item->picture)}}" width="200px" id="imgA"></a></div>
                                        @else
                                            <br><div><img src="#" width="200px" id="imgA"></div>
                                        @endif
                                        <div>
                                            <input type="file" name="picture" id="picture1" class="hidden" accept="image/*"
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
                                            <div class="col-sm-3">
                                                <label class="col-form-label">helpma Code*</label>
                                                <input type="helpma_Code" name="helpma_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="รหัสคูปอง"  readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">helpma Name*</label>
                                                <input type="text" name="helpma_Name" class="form-control" id="" required >
                                            </div>
                                        </div>

                                        <p class="text-right">
                                            <a href="{{ url('helpma') }}"
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