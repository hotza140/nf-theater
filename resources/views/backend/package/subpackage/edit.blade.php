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
                        <h5 class="m-b-10">Sub Package/EDIT</h5>

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
                                        action="{{ url('subpackage_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf
                                        <input type="hidden" name="package_Code" value="{{$package_Code}}">
                                        <input type="hidden" name="package_id" value="{{$package_id}}">

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Sub Package Code*</label>
                                                <input type="Subpackage_Code" name="Subpackage_Code" class="form-control" id=""  maxlength = "150"
                                                placeholder="รหัสแพ็คเกจ"  required readonly value="{{$item->Subpackage_Code}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Sub Package Name*</label>
                                                <input type="text" name="Subpackage_Name" class="form-control" id="" required value="{{$item->Subpackage_Name}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">จำนวนวัน</label>
                                                <input type="number" name="Subpackage_Dayuse" class="form-control" id=""
                                                      value="{{@$item->Subpackage_Dayuse}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ราคา</label>
                                                <input type="number" name="Subpackage_Paymoney" class="form-control" id=""
                                                      value="{{@$item->Subpackage_Paymoney}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">แต้มของ Package</label>
                                                <input type="number" name="Making_Scoring" class="form-control" id="Making_Scoring"
                                                value="{{@$item->Making_Scoring}}">
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>

                                        {{-- <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">รูปแบบ*</label>
                                                <select name="type" id="type" class="form-control" required="">
                                                    <option value="MOBILE" {{@$item->type=="MOBILE"?'selected':''}}>ยกเว้นทีวี</option>
                                                    <option value="PC" {{@$item->type=="PC"?'selected':''}}>TV</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                        </div> --}}

                                        <input type="hidden" name="type" value="{{@$item->type}}">

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
                                            <a href="{{ url('package_edit/'.$package_id) }}"
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