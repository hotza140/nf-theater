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
                        <h5 class="m-b-10">Rewards /ADD</h5>

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

                                    <form method="post" id="" action="{{ url('reward_store') }}"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Rewards Code*</label>
                                                <input type="reward_Code" name="reward_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="รหัสคูปอง"  readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Rewards Name*</label>
                                                <input type="text" name="reward_Name" class="form-control" id="" required >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3"> 
                                                {{-- <label class="col-form-label">Package Use*</label> --}}
                                                {{-- <input type="package_Code" name="package_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="กำหนดค่าแต้ม"  readonly> --}}
                                                @php
                                                    $Packagewatch = App\Models\Packagewatch::all();
                                                @endphp
                                                <label class="col-form-label">Package Use*</label>
                                                <select name="package_Code" id="package_Code" class="form-control" required>
                                                    {{-- <option value="MOBILE" selected="">ยกเว้นทีวี</option>
                                                    <option value="PC">TV</option> --}}
                                                    <option value="" selected>กรุณาเลือก</option>
                                                    @foreach ($Packagewatch as $itemPK)
                                                        <option value="{{$itemPK->package_Code}}">{{$itemPK->package_Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Rewards Score(แต้ม)*</label>
                                                <input type="reward_Score" name="reward_Score" class="form-control" id=""  maxlength = "150"
                                                placeholder="กำหนดค่าแต้ม" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Day</label>
                                                <input type="number" name="reward_Day" class="form-control" id=""
                                                      value="0" required>
                                            </div>
                                            <div class="col-sm-3">
                                                {{-- <label class="col-form-label">Reward Gift Name</label>
                                                <input type="text" name="reward_giftName" class="form-control" id=""
                                                      value=""> --}}
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
                                            <a href="{{ url('reward') }}"
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