@extends('layouts.menubar')
@section('content')

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
                        <h5 class="m-b-10">Coupon/EDIT</h5>

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

                                    <form method="post" id=""
                                        action="{{ url('coupon_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->


                                     
                                        <?php
                                        $runnum=DB::table('tb_coupon')->orderby('id','desc')->count();
                                        $runtotal=$runnum+1;
                                        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
                                        $run = "NF-{$xxxx}";

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
                                                <input type="email" name="email" class="form-control" id=""  maxlength = "25"
                                                     required value="{{@$item->email}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$item->password}}" placeholder="รหัสผ่าน" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email เสริม 1</label>
                                                <input type="email" name="email01" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->email01}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email เสริม 2</label>
                                                <input type="email" name="email02" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->email02}}">
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
                                            <a href="{{ url('coupon') }}"
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


<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/coupon_in_open_close") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, open: isOpen }),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Failed to update status.');
                    // Revert the switch state if update fails
                    this.checked = !this.checked;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert the switch state if an error occurs
                this.checked = !this.checked;
            });
        });
    });
});
</script>


    @endsection

    @section('script')


    @endsection