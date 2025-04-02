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
                        <h5 class="m-b-10">Package/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('package_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Package Auto Code</label>
                                                <input type="package_Code" name="package_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="รหัสแพ็คเกจ"  readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Package Name*</label>
                                                <input type="text" name="package_Name" class="form-control" id="" required >
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
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id=""
                                                      value="{{@$date_s}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id=""
                                                      value="{{@$item->date_end}}">
                                            </div>
                                        </div>


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
                                            <a href="{{ url('package') }}"
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