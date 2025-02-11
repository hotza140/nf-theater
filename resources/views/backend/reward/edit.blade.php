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
                        <h5 class="m-b-10">Reward /EDIT</h5>

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
                                        action="{{ url('reward_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Code*</label>
                                                <input type="reward_Code" name="reward_Code" class="form-control" id=""  maxlength = "25"
                                                placeholder="รหัสคูปอง"  required readonly value="{{$item->reward_Code}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Name*</label>
                                                <input type="text" name="reward_Name" class="form-control" id="" required value="{{$item->reward_Name}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3"> 
                                                {{-- <label class="col-form-label">Package Use*</label> --}}
                                                {{-- <input type="package_Code" name="package_Code" class="form-control" id=""  maxlength = "25"
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
                                                        <option value="{{$itemPK->package_Code}}" {{$itemPK->package_Code==$item->package_Code?'selected':''}}>{{$itemPK->package_Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Rewards Score(แต้ม)*</label>
                                                <input type="reward_Score" name="reward_Score" class="form-control" id=""  maxlength = "25"
                                                placeholder="กำหนดค่าแต้ม" value="{{$item->reward_Score}}" required>
                                            </div>
                                            {{-- <div class="col-sm-3">
                                            </div> --}}
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Day</label>
                                                <input type="number" name="reward_Day" class="form-control" id=""
                                                      value="{{$item->reward_Day}}" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Gift Name</label>
                                                <input type="text" name="reward_giftName" class="form-control" id=""
                                                      value="{{$item->reward_giftName}}">
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


<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/reward_in_open_close") }}', {
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