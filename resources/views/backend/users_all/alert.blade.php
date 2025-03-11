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
                        <h5 class="m-b-10">แจ้งเตือน</h5>

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

                                <style>
                                                    .status-active {
                                                        color: white;
                                                        background-color: #dc3545; /* สีแดง */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    .status-inactive {
                                                        color: white;
                                                        background-color: #28a745; /* สีเขียว */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    .status-expired {
                                                        color: white;
                                                        background-color: #6c757d; /* สีเทา */
                                                        padding: 5px 10px;
                                                        border-radius: 5px;
                                                    }

                                                    @keyframes beepEffect {
                                                            0% { opacity: 1; }
                                                            50% { opacity: 0; }
                                                            100% { opacity: 1; }
                                                        }

                                                        /* .beepbeep {
                                                            animation: beepEffect 2s infinite;
                                                            color: white; 
                                                            font-weight: bold; 
                                                        } */
                                                    </style>

                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>รายละเอียด</th>
                                                    <th>Username</th>
                                                    <th>Profile</th>
                                                    <th>วันที่</th>
                                                    <th>จัดการ User</th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$items->text}}</td>\
                                                    <?php  $uu = users::where('id', $items->id_user)->first();  ?>
                                                    <td>{{@$uu->username}}</td>
                                                    <td>{{@$uu->name}}</td>
                                                    <td>{{$items->created_at}}</td>


                                                    @if(Auth::guard('admin')->user()->type == 1 or Auth::guard('admin')->user()->type == 0)
                                                    <td>
                                                    <a href="{{url('users_edit/'.$items->id_user)}}" class="btn btn-sm btn-warning" style="color:white;" target="_blank"><i class="fa fa-gear"></i>Edit</a>
                                                    </td>
                                                    @else
                                                    <td></td>
                                                    @endif


                                                    @if(Auth::guard('admin')->user()->type == 2 or Auth::guard('admin')->user()->type == 0)
                                                <td>
                                                <a href="{{url('y_users_edit/'.$items->id_user)}}" class="btn btn-sm btn-warning" style="color:white;" target="_blank" ><i class="fa fa-gear"></i>Edit</a>
                                                </td>
                                                @else
                                                    <td></td>

                                                @endif

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

            fetch('{{ url("/users_open_close") }}', {
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