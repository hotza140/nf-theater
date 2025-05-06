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
                        <h5 class="m-b-10">Sub Package/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('subpackage_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        <input type="hidden" name="package_Code" value="{{$package_Code}}">
                                        <input type="hidden" name="package_id" value="{{$package_id}}">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Sub Package Auto Code</label>
                                                <input type="Subpackage_Code" name="Subpackage_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="Suppackage code"  readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Sub Package Name*</label>
                                                <input type="text" name="Subpackage_Name" class="form-control" id="" required >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">จำนวนเดือน</label>
                                                <input type="number" name="Subpackage_Dayuse" class="form-control" id=""
                                                      value="0">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ราคา</label>
                                                <input type="number" name="Subpackage_Paymoney" class="form-control" id=""
                                                      value="0">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">แต้มของ Package</label>
                                                <input type="number" name="Making_Scoring" class="form-control" id="Making_Scoring">
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>

                                        {{-- <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">รูปแบบ*</label>
                                                <select name="type" id="type" class="form-control" required="">
                                                    <option value="MOBILE" selected>ยกเว้นทีวี</option>
                                                    <option value="PC">TV</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                        </div> --}}
                                        <input type="hidden" name="type" id="type" value="MOBILE">


                                        <?php $country=DB::table('dataset_country')->orderByRaw("CONVERT(ct_nameTHA USING tis620) ASC")->cursor(); ?>
                                        <!-- <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Country</label>
                                                <select name="country" id="country" class="form-control add_select2"  >
                                                @foreach($country as $key=>$countrys)
                                                <option value="{{@$countrys->ct_nameTHA}}" @if(@$item->country==@$countrys->ct_nameTHA) selected  @endif >{{@$countrys->ct_nameTHA}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div> -->



                                        <p class="text-right">
                                            <a href="{{ url('package_edit') }}/{{$package_id}}"
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