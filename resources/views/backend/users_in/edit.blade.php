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
                        <h5 class="m-b-10">USERS Account/EDIT</h5>

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
                                        action="{{ url('users_in_update/'.@$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        <input type="hidden" name="edit" value="{{@$item->id}}">
                                        <!-- -------EDIT---------- -->


                                     
                                        <?php
                                        $runnum=DB::table('tb_users_in')->orderby('id','desc')->count();
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
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$item->password}}" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email รอง 1</label>
                                                <input type="email" name="email01" class="form-control" id=""  maxlength = "25"
                                                      value="{{@$item->email01}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email รอง 2</label>
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
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Country</label>
                                                <select name="country" id="country" class="form-control add_select2"  >
                                                @foreach($country as $key=>$countrys)
                                                <option value="{{@$countrys->ct_nameTHA}}" @if(@$item->country==@$countrys->ct_nameTHA) selected  @endif >{{@$countrys->ct_nameTHA}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <p class="text-right">
                                            <a href="{{ url('users_in') }}"
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




                <?php
                 $user_in_in=App\Models\users_in_in::where('id_user_in',@$item->id)->orderby('name','desc')->cursor();
                 $user_in_in_count=App\Models\users_in_in::where('id_user_in',@$item->id)->orderby('id','desc')->count();
                ?>
                 <!-- Page body2 start -->
                 <div class="page-body">
                 <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                <h1 class="mb-0" style="font-size: 1.5rem; color: #333; font-weight: bold;">จัดการผู้ใช้ใน Account</h1>
                                <br><br>

                               

                                <div class="form-group row">

                                <form method="post" id="add_user_in_in" action="{{ url('add_user_in_in') }}" enctype="multipart/form-data" >
                                @csrf

                                <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >

                                    <?php 
                                    $date_ch_in=date('Y-m-d');
                                    $user=App\Models\users::where('open',0)
                                    ->whereDate('date_start', '<=',$date_ch_in) // ยังไม่หมดอายุ (start <= ปัจจุบัน)
                                    ->whereDate('date_end', '>=',$date_ch_in) // ยังไม่หมดอายุ (end >= ปัจจุบัน)
                                    ->orderby('id','desc')->cursor();
                                    ?>
                                    <div class="col-sm-3">
                                    <select name="id_user" id="id_user" class="form-control add_select2"  required >
                                    @foreach($user as $key=>$users)
                                    <option value="{{@$users->id}}" >{{@$users->name}}</option>
                                     @endforeach
                                    </select>
                                    </div>
                                    
                                    <div class="col-sm-1">
                                    @if($user_in_in_count >= 6)
                                        <button type="submit" style="color:white;" class="btn btn-success"  onclick="javascript:return confirm('Confirm?')" disabled title="จำนวนผู้ใช้งานครบจำนวนแล้ว">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    @else
                                        <button type="submit" style="color:white;" class="btn btn-success"  onclick="javascript:return confirm('Confirm?')">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    @endif
                                    </div>    

                                    </form>  

                                    <div class="col-sm-2">
                                    <form method="post" id="autoCreateUsersInIn" action="{{ url('autoCreateUsersInIn') }}" enctype="multipart/form-data" >
                                    @csrf

                                    <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                    <button type="submit" style="color:white;" class="btn btn-danger"  onclick="javascript:return confirm('Confirm?')">
                                        <i class="fa fa-plus"></i> Add User Auto
                                    </button>
                                    </form>  
                                    </div>  


                                </div>
                                </div>

                                <div class="card">
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('users_store_form_in') }}"
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        <input type="hidden"  name="id_user_in" value="{{@$item->id}}" >
                                        <!-- -------EDIT---------- -->

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Name Profile</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="">
                                            </div>
                                        </div>
                                        
                                        <?php
                                        $runnum=DB::table('tb_users')->orderby('id','desc')->count();
                                        $runtotal=$runnum+1;
                                        $xxxx = str_pad($runtotal, 5, '0', STR_PAD_LEFT);
                                        $run = "NF{$xxxx}";

                                        if(@$item->username!=null){
                                            $run=@$item->username;
                                        }

                                        if(@$item->password!=null){
                                            $password=@$item->password;
                                        }else{
                                            $password = rand(111111, 999999);
                                        }

                                        ?>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Username*</label>
                                                <input type="username" name="username" class="form-control" id=""  maxlength = "25"
                                                     required value="{{@$run}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password*</label>
                                                <input type="text" name="password" class="form-control" id="" required value="{{@$password}}" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id=""  
                                                      value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" id=""  maxlength = "10"
                                                      value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Line</label>
                                                <input type="text" name="line" class="form-control" id=""  
                                                      value="">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Link Line</label>
                                                <input type="text" name="link_line" class="form-control" id=""  
                                                      value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label">Package*</label>
                                        <select name="type" id="type" class="form-control add_select2" required  >
                                        <option value="MOBILE" >ยกเว้นทีวี</option>
                                        <option value="PC" >TV</option>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        <div class="col-sm-2">
                                            <label class="col-form-label">Enter Days*</label>
                                            <input type="number" class="form-control" id="day_input" name="day" placeholder="Enter number of days" required >
                                        </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date Start</label>
                                                <input type="date" name="date_start" class="form-control" id="date_start"
                                                      value="" readonly required >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Date End</label>
                                                <input type="date" name="date_end" class="form-control" id="date_end"
                                                      value="" readonly required >
                                            </div>
                                        </div>

                                        <p class="text-right">
                                            <button type="submit" class="btn btn-success" style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>
                            </div>


                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="" class="table  table-bordered nowrap">
                                        <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <!-- <th>Open/Close</th> -->
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>วันที่เชื่อมต่อ</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                            @foreach($user_in_in as $key=>$user_ins)
                                            <tr class="num" id="{{$user_ins->id}}">
                                                    <td>{{$key+1}}</td>

                                                    <!-- <td>
                                                        <form method="post" id="form{{$user_ins->id}}" name="form{{$user_ins->id}}">
                                                        @csrf
                                                        <label class="switch">
                                                            <input type="checkbox" class="toggle-switch" data-id="{{$user_ins->id}}" 
                                                                {{ $user_ins->open == 0 ? 'checked' : '' }}>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </form>
                                                    </td> -->

                                                    <td>
                                                        @if($user_ins->type=='MOBILE' or $user_ins->type=='')
                                                        <i class="fa fa-mobile" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @else
                                                        <i class="fa fa-desktop" style="font-size:30px; color:red;" title="กำลังใช้งาน"></i>
                                                        @endif
                                                    </td>
                                                    <?php 
                                                    $user_aa=App\Models\users::where('id',$user_ins->id_user)->first();
                                                    ?>

                                                    <td>{{@$user_aa->name}}</td>
                                                    <td>{{@$user_aa->email}}</td>
                                                    <td>{{@$user_ins->created_at}}</td>
                                                    <td>
                                                    <!-- <a href="{{url('users_in_in_edit/'.$user_ins->id)}}" class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-gear"></i>Edit</a> -->
                                                        <a href="{{url('users_in_in_destroy/'.$user_ins->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
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
                <!-- Page body2 end -->

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

            fetch('{{ url("/users_in_in_open_close") }}', {
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