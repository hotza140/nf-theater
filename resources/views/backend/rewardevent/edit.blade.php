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
                                        action="{{ url('rewardevent_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Code of Customer.</label>
                                                <input type="text" name="rewardevent_Code" class="form-control" id=""  
                                                placeholder="" readonly value="{{@$item->rewardevent_Code}}">
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username Code*</label>
                                                <input type="text" name="username_reward" class="form-control" id=""  
                                                placeholder=""  readonly value="{{@$item->username_reward}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">รางวัลที่ได้/รายละเอียด*</label>
                                                <input type="text" name="reward_what" class="form-control" id="" required value="{{@$item->reward_what}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Start*</label>
                                                <input type="date" name="reward_start" class="form-control" id="" 
                                                placeholder="" required value="{{@$item->reward_start??''}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Stop*</label>
                                                <input type="date" name="reward_stop" class="form-control" id=""  
                                                placeholder="" required value="{{@$item->reward_stop??''}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Reward Event Status</label>
                                                <select name="reward_event_status" id="reward_event_status" class="form-control">
                                                    <option value="0" {{$item->reward_event_status==0?'selected':''}}>ปิด</option>
                                                    <option value="1" {{$item->reward_event_status==1?'selected':''}}>เปิด</option>
                                                    <option value="2" {{$item->reward_event_status==2?'selected':''}}>ลูกค้ามารับ Event</option>
                                                    <option value="3" {{$item->reward_event_status==3?'selected':''}}>ยกเลิก Event ลูกค้า</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                            </div>
                                        </div>

                                        <p class="text-right">
                                            <a href="{{ url('rewardevent') }}"
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