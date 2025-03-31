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
                                        action="{{ url('package_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->


                                        <div class="form-group row">
                                            {{-- <div class="col-sm-3">
                                                <label class="col-form-label">Package Code*</label>
                                                <input type="text" name="package_Code" class="form-control" id=""  maxlength = "25"
                                                placeholder="รหัสแพ็คเกจ"  required readonly value="{{$item->package_Code}}">
                                            </div> --}}
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Package Name*</label>
                                                <input type="text" name="package_Name" class="form-control" id="" required value="{{$item->package_Name}}">
                                            </div>
                                        </div>

                                        <?php
                                        // $date_s=date('Y-m-d');
                                        // if(@$item->date_start!=null){
                                        //     $date_s=@$item->date_start;
                                        // }

                                        ?>

                                        {{-- <div class="form-group row">
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
                                        </div>                                         --}}

                                        <p class="text-right">
                                            <a href="{{ url('package') }}"
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


        <!-- Page Package Sub in index package edit -->
        {{-- <div class="pcoded-content">
            <div class="pcoded-inner-content"> --}}
                <!-- Main-body start -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Page-header start -->
                        <div class="page-header card">
                            <div class="card-block">
                                <h5 class="m-b-10">Sub Package BACKEND</h5>
        
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
        
                                            <a style="color:white;" class="btn btn-success" href="{{url('subpackage_add')}}?package_Code={{$item->package_Code}}&package_id={{$item->id}}"> <i class="fa fa-plus"></i> Add</a>
        
                                            
                                                <br>
                                                <form class="form-horizontal" action="{{url('package_edit')}}/{{$item->id}}" method="GET" enctype="multipart/form-data">
                                                @csrf
                                                
                                                <div class="form-group row" style="display: flex; justify-content: flex-end;">
                                                {{-- <div class="col-sm-2">
                                                <select name="status_account" id="" class="form-control">
                                                    <option  value="999" @if(@$status_account==999) selected  @endif >ทั้งหมด</option>
                                                    <option  value="0" @if(@$status_account==0) selected  @endif >ยังไม่หมดอายุ</option>
                                                    <option  value="1" @if(@$status_account==1) selected  @endif >หมดอายุ</option>
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
                                                            {{-- <th>Open/Close</th> --}}
                                                            {{-- <th>Sub Package Code</th> --}}
                                                            <th>Sub Package Name</th>
                                                            <th>จำนวนวัน</th>
                                                            <th>ราคา</th>
                                                            <th>รูปแบบ</th>
                                                            <th>แต้มของ Package</th>
                                                            <th>Tool</th>
        
                                                        </tr>
                                                    </thead>
                                                    <!-- <tbody class="sortable"> -->
                                                    <tbody class="">
                                                    @foreach($itempk as $keys=>$items)
                                                    <tr class="num" id="{{$items->id}}">
                                                            <td>{{$keys+1}}</td>
        
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
                                                            <td>{{$items->Subpackage_Name}}</td>
                                                            <td>{{$items->Subpackage_Dayuse}} วัน</td>
                                                            <td>{{$items->Subpackage_Paymoney}} บาท</td>
                                                            <td>{{$items->type=='MOBILE'?'ยกเว้นทีวี':'TV'}}</td>
                                                            <td>{{$items->Making_Scoring}} แต้ม</td>
                                                            <td>
                                                            <a href="{{url('subpackage_edit/'.$items->id)}}?package_Code={{$item->package_Code}}&package_id={{$item->id}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a>
                                                                <a href="{{url('subpackage_destroy/'.$items->id)}}?package_Code={{$item->package_Code}}&package_id={{$item->id}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
        
                                                    </tbody>
                                                </table>
                                            </div>
        
                                            <!-- Pagination -->
                                            <style>
                                                .pagination-wrapper {
                                                    text-align: right; /* จัดให้อยู่ขวาสุด */
                                                }
                                            </style>
                                            <div class="pagination-wrapper">
                                                <div>{{ $itempk->appends(Request::all())->links() }}</div>
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
            {{-- </div>
        </div> --}}
        <!-- Page Package Sub in index package edit -->
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