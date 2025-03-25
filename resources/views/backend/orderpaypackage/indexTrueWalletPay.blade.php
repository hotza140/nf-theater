@extends('layouts.menubar')
@section('content')
<style>
    .button {
        border-radius: 25px;
    }
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

    input:checked+.slider {
        background-color: #93D600;
        /* ใช้สีเขียวตามความชอบ */
    }

    input:checked+.slider:before {
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
                        <h3 class="m-b-10" style="color: red"><b></b>Payment Packages By TrueMoney Wallet.</h3>

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

                                    <a style="color:white;" class="btn btn-primary"
                                        href="{{url('orderpaypackage')}}"> Order Payment Packages</a>


                                    <br>
                                    <form class="form-horizontal" action="{{url('orderpaypackage')}}" method="GET"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row" style="display: flex; justify-content: flex-end;">
                                            {{-- <div class="col-sm-2">
                                                <select name="status_account" id="" class="form-control">
                                                    <option value="999" @if(@$status_account==999) selected @endif>
                                                        ทั้งหมด</option>
                                                    <option value="0" @if(@$status_account==0) selected @endif>
                                                        ยังไม่หมดอายุ</option>
                                                    <option value="1" @if(@$status_account==1) selected @endif>หมดอายุ
                                                    </option>
                                                </select>
                                            </div> --}}
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

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable_call" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>Open/Close</th>
                                                    <th>OrderPayCode </th>
                                                    <th>username</th>
                                                    <th>E-mail</th>
                                                    <th>package_Name</th>
                                                    <th>Subpackage_Name</th>
                                                    <th>Subpackage Price</th>
                                                    {{-- <th>Cus Paymoney</th>
                                                    <th>Ref. Payment</th>
                                                    <th>Message Payment</th> --}}
                                                    <th>Show Slip</th>
                                                    {{-- <th>Reware Gift</th> --}}
                                                    {{-- <th>Tool</th> --}}

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                                @foreach($item as $key=>$items)
                                                <tr class="num" id="{{$items->id}}">
                                                    <td>{{$key+1}}</td>

                                                    <td>
                                                        <form method="post" id="form{{$items->id}}"
                                                            name="form{{$items->id}}">
                                                            @csrf
                                                            <label class="switch">
                                                                <input type="checkbox" class="toggle-switch"
                                                                    data-id="{{$items->id}}" {{ $items->OrderCheck == 0
                                                                ? 'checked' : '' }}>
                                                                <!-- ค่าที่เปิดจะเป็น 0 -->
                                                                <span class="slider"></span>
                                                            </label>
                                                        </form>
                                                    </td>

                                                    <td>{{$items->OrderPayCode }}</td>
                                                    <td>{{$items->username}}</td>
                                                    <td>{{$items->Orderemail}}</td>
                                                    <td>{{$items->package_Name}}</td>
                                                    <td>{{$items->Subpackage_Name}}</td>
                                                    <td style="text-align: right; margin-right:5px;">{{$items->Subpackage_Paymoney}}</td>
                                                    {{-- <td style="text-align: right; margin-right:5px;">{{$items->Cus_Paymoney}}</td>
                                                    <td>{{$items->RefPayment}}</td>
                                                    <td>{{$items->messageslip}}</td> --}}
                                                    <td style="text-align: center">
                                                        <button class="btn btn-primary btn-sm"
                                                            onclick="ShowSlipImg({{$items->id}},'{{$items->imgSlip}}','Truewallet');">Slip</button>
                                                    </td>
                                                    {{-- <td>
                                                        <a href="{{url('orderpaypackage_edit/'.$items->id)}}"
                                                            class="btn btn-sm btn-warning" style="color:white;"><i
                                                                class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('orderpaypackage_destroy/'.$items->id)}}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="javascript:return confirm('Confirm?')"
                                                            style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td> --}}
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <style>
                                        .pagination-wrapper {
                                            text-align: right;
                                            /* จัดให้อยู่ขวาสุด */
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


        <div id="styleSelector"></div>
    </div>
</div>

<style>
    .swal-wides{
        width:450px;
    }
</style>
<script>
    function ShowSlipImg(id,img,path) {
        Swal.fire({
            title: "Show Slip",
            html: `<img src="" id="imgSlipS1" style="width:100%">`,
            customClass: "swal-wides"
        });
        // document.getElementById('imgSlipS1').src = `{{asset('storage/Frongdrv')}}/${img}`;
        fetch('{{route('frontend.getimgSlipBase64')}}', {
            method: 'POST', // or 'PUT'
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                _token : "{{csrf_token()}}",
                id,img,path
            }),
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data }))) // Get status + body
        .then(({ status, body }) => {
            console.log('Success:', body , status);
            if(status==200) {
                document.getElementById('imgSlipS1').src = body.img;
            } 
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>

@endsection

@section('script')

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const isOpen = this.checked ? 0 : 1; // ค่าที่ส่ง 0 = เปิด, 1 = ปิด

            fetch('{{ url("/orderpaypackage_open_close") }}', {
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