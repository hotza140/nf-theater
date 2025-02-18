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
                        <h5 class="m-b-10">Gift/EDIT</h5>

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
                                        action="{{ url('gift_update/'.@$item->id) }}"
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
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Gift Code*</label>
                                                <input type="Gift_Code" name="Gift_Code" class="form-control" id=""  maxlength = "25"
                                                placeholder="รหัสคูปอง"  required readonly value="{{$item->Gift_Code}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Gift Name*</label>
                                                <input type="text" name="Gift_Name" class="form-control" id="" required value="{{$item->Gift_Name}}">
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
                                                    <option value="" selected>กรุณาเลือกประเภทคูปอง</option>
                                                    <option value="ลดราคา" {{$item->type=='ลดราคา'?'selected':''}}>ลดราคา</option>
                                                    <option value="ฟรี" {{$item->type=='ฟรี'?'selected':''}}>ฟรี</option>
                                                    <option value="ของขวัญ" {{$item->type=='ของขวัญ'?'selected':''}}>ของขวัญ</option>
                                                    <option value="อื่นๆ" {{$item->type=='อื่นๆ'?'selected':''}}>อื่นๆ</option>
                                                </select>
                                            </div> --}}
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เงื่อนไข</label>
                                                <input type="text" name="conditional" class="form-control" id="conditional"
                                                      value="{{@$item->conditional}}">
                                            </div>
                                            <div class="col-sm-3">
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


<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/gift_in_open_close") }}', {
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