@extends('layouts.menubar')
@section('content')
<style>
.button{border-radius: 25px;}
</style>

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
                        <h5 class="m-b-10">Rewards BACKEND</h5>

                    </div>
                </div>
                <!-- Page-header end -->


                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">

                                    <a style="color:white;" class="btn btn-success" href="{{url('rewardevent_add')}}"> <i class="fa fa-plus"></i> Add</a>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Status</th>
                                                    <th>User Name</th>
                                                    <th>รางวัลที่ได้/รายละเอียด</th>
                                                    <th>กำหนดวันเริ่มประกาศ</th>
                                                    <th>กำหนดวันปิดประกาศ</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>

                                                    <td>
                                                        @switch($items->reward_event_status)
                                                            @case(0)
                                                                ปิด
                                                                @break
                                                            @case(1)
                                                                เปิด
                                                                @break
                                                            @case(2)
                                                                ลูกค้ามารับ Event
                                                                @break
                                                            @case(3)
                                                                ยกเลิก Event ลูกค้า
                                                                @break
                                                            @case(4)
                                                                ยกเลิก(หมดอายุ)
                                                                @break
                                                        @endswitch
                                                    </td>

                                                    {{-- <td>
                                                    <form method="post" id="form{{$items->id}}" name="form{{$items->id}}">
                                                        @csrf
                                                        <label class="switch">
                                                            <input type="checkbox" class="toggle-switch" data-id="{{$items->id}}" 
                                                                {{ $items->open == 0 ? 'checked' : '' }}> <!-- ค่าที่เปิดจะเป็น 0 -->
                                                            <span class="slider"></span>
                                                        </label>
                                                    </form>
                                                    </td> --}}

                                                    <td>{{$items->username_reward}}</td>
                                                    <td>{{$items->reward_what}}</td>
                                                    <td>{{$items->reward_start}}</td>
                                                    <td>{{$items->reward_stop}}</td>
                                                    {{-- <td>{{$items->reward_giftName}}</td> --}}
                                                    <td>
                                                    <a href="{{url('rewardevent_edit/'.$items->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('rewardevent_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main-body end -->


        <div id="styleSelector">


        </div>
    </div>
</div>
</div>


@endsection

@section('script')


<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/reward_open_close") }}', {
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