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
                        <h5 class="m-b-10">Gift/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('gift_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

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
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Gift Code*</label>
                                                <input type="Gift_Code" name="Gift_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="รหัสคูปอง"  readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Gift Name*</label>
                                                <input type="text" name="Gift_Name" class="form-control" id="" required >
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

                                        <div class="form-group row">
                                            {{-- <div class="col-sm-3">
                                                <label class="col-form-label">Type Gift</label>
                                                <select name="type" id="type" class="form-control add_select2">
                                                    <option value="">กรุณาเลือกประเภทคูปอง</option>
                                                    <option value="ลดราคา">ลดราคา</option>
                                                    <option value="ฟรี">ฟรี</option>
                                                    <option value="ของขวัญ">ของขวัญ</option>
                                                    <option value="อื่นๆ">อื่นๆ</option>
                                                </select>
                                            </div> --}}
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เงื่อนไข</label>
                                                <input type="text" name="conditional" class="form-control" id="conditional"
                                                      value="{{@$item->conditional}}">
                                            </div>
                                            <div class="col-sm-3"></div>
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
                                            <a href="{{ url('gift') }}"
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