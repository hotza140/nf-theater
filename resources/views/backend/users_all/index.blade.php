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
                        <h5 class="m-b-10">USERS ALL</h5>

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


                                        <?php
                                            $status_account = $status_account ?? 999;
                                        ?>
                                    
                                        <br>
                                        <form class="form-horizontal" action="{{url('users_all')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row" style="display: flex; justify-content: flex-end;">

                                            <div class="col-sm-2">
                                                <input type="text" name="search" value="{{@$search}}">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="submit" class="btn btn-warning" style="color:white;">
                                                    <i class="fa fa-check-circle-o"></i> Search
                                                </button>
                                            </div>
                                            
                                        </div>
                                        </form>

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
                                        <table id="" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Username</th>
                                                    <th>ชื่อไลน์ลูกค้า</th>
                                                    <th>Package</th>
                                                    <th>Type</th>
                                                    <th>Type Netflix</th>
                                                    <th>Type Youtube</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($item as $key=>$items)
                                            <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>

                                                    <?php
                                                    if($items->type=='PC'){
                                                        $paga='TV '.@$items->package;
                                                    }else{
                                                        $paga='ยกเว้นทีวี '.@$items->package;
                                                    }

                                                    ?>

                                                    <!-- <td><img src="{{asset('/img/upload/'.$items->picture)}}" style="width:90px"></td> -->
                                                    <td>{{$items->username}}</td>
                                                    <td>{{$items->line}}</td>
                                                    <td>{{@$paga}}</td>

                                                    @if($items->type_netflix!=null)
                                                    <td>NETFLIX</td>
                                                    @else
                                                    <td>YOUTUBE</td>
                                                    @endif


                                                    <td>
                                                    <form method="GET" action="{{url('users_add')}}" id="form{{$items->id}}" name="form{{$items->id}}" target="_blank">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{@$items->id}}">
                                                        <button type="submit" class="btn btn-sm btn-success" style="color:white;" target="_blank"><i class="fa fa-gear"></i>NETFLIX</button>
                                                    </form>
                                                    </td>


                                                <td>
                                                     <form method="GET" action="{{url('youtube_add')}}" id="form{{$items->id}}" name="form{{$items->id}}" target="_blank">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{@$items->id}}">
                                                        <button type="submit" class="btn btn-sm btn-info" style="color:white;" target="_blank"><i class="fa fa-gear"></i>YOUTUBE</button>
                                                    </form>
                                                </td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <script>
                                    function fallbackCopyTextToClipboard(text) {
                                        const textArea = document.createElement("textarea");
                                        textArea.value = text;
                                        document.body.appendChild(textArea);
                                        textArea.focus();
                                        textArea.select();
                                        try {
                                            document.execCommand("copy");
                                            alert("คัดลอกข้อมูลสำเร็จ!");
                                        } catch (err) {
                                            console.error("คัดลอกไม่สำเร็จ: ", err);
                                            alert("คัดลอกไม่สำเร็จ กรุณาลองอีกครั้ง");
                                        }
                                        document.body.removeChild(textArea);
                                    }

                                    function copyUserInfo(username, password, name, package, link) {
                                        let textToCopy = `Username : ${username}\nPassword : ${password}\nชื่อโปรไฟล์: ${name}\nแพ็กเกจที่สมัคร : ${package}\nลิงก์เข้าใช้งาน : ${link}`;

                                        if (navigator.clipboard && navigator.clipboard.writeText) {
                                            navigator.clipboard.writeText(textToCopy).then(() => {
                                                alert("คัดลอกข้อมูลสำเร็จ!");
                                            }).catch(err => {
                                                console.error('คัดลอกไม่สำเร็จ: ', err);
                                                fallbackCopyTextToClipboard(textToCopy);
                                            });
                                        } else {
                                            console.warn("ใช้ HTTP → เปลี่ยนไปใช้ execCommand แทน");
                                            fallbackCopyTextToClipboard(textToCopy);
                                        }
                                    }
                                    </script>

                                    <!-- Pagination -->
                                    <style>
                                        .pagination-wrapper {
                                            text-align: right; /* จัดให้อยู่ขวาสุด */
                                        }
                                    </style>
                                    <div class="pagination-wrapper">
                                        <div>{{ $item->appends(Request::all())->links() }}</div>
                                    </div>
                                    <!-- Pagination -->

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