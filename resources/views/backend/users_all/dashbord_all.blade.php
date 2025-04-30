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


                <style>
                .status-active {
                    color: white;
                    background-color: #dc3545;
                    /* สีแดง */
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                .status-inactive {
                    color: white;
                    background-color: #28a745;
                    /* สีเขียว */
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                .status-expired {
                    color: white;
                    background-color: #6c757d;
                    /* สีเทา */
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                @keyframes beepEffect {
                    0% {
                        opacity: 1;
                    }

                    50% {
                        opacity: 0;
                    }

                    100% {
                        opacity: 1;
                    }
                }

                .h1,
                h1 {
                    font-size: 25px !important;
                    /* นำ !important มาไว้ก่อน ; */
                }

                /* .beepbeep {
                                                            animation: beepEffect 2s infinite;
                                                            color: white; 
                                                            font-weight: bold; 
                                                        } */
                </style>

                <style>
                .flashing-card {
                    width: 350px;
                    height: 200px;
                    background-color: #800020; /* สีเลือดหมู */
                    color: white;
                    display: flex;
                    flex-direction: column; /* ⭐ เพิ่มบรรทัดนี้ */
                    align-items: center;
                    justify-content: center;
                    border-radius: 20px;
                    font-size: 12px;
                    font-weight: bold;
                    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
                    box-shadow: 0 10px 25px rgba(128, 0, 32, 0.6);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    margin-bottom: 20px; /* ✅ เพิ่มระยะห่างด้านล่างของกล่อง */
                }

                .flashing-card:hover {
                    transform: scale(1.03);
                    box-shadow: 0 15px 30px rgba(128, 0, 32, 0.75);
                }

                #table-container>.dt-responsive {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    display: none;
                    /* ซ่อนทั้งหมดก่อน */
                }

                #table-container>.dt-responsive.active {
                    display: block;
                    /* โชว์ตัวที่ต้องการ */
                }

                .toggle-btn {
                    cursor: pointer;
                    /* แสดงเป็นรูปมือเมื่อเลื่อนไปที่ปุ่ม */
                }

                /* เลือกปุ่มที่มีไอคอน fa-copy อยู่ข้างใน */
                button.btn.btn-sm.btn-primary:has(i.fa-copy) {
                    padding: 2px 6px;
                    font-size: 12px;
                    line-height: 1;
                    height: auto;
                    display: inline-flex;
                    align-items: center;
                    gap: 4px;
                }
                </style>


                <?php $date=date('Y-m-d'); ?>

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                    <h2>Dashboard Super</h2>
                                </div>
                            </div>
                            <div class="card-block">

                                <div style="overflow-x: auto; white-space: nowrap;">
                                    <table>



                                    <?php 
                                        $ty1=App\Models\dash_regis_to::where('type',0)->count();
                                        $ty2=App\Models\dash_regis_to::where('type',1)->count();
                                        ?>
                                        <tr>
                                        <td>
                                                <div class="flashing-card " >
                                                    <h4><i class="fa fa-user"></i> จำนวนลูกค้าที่สมัคร:
                                                        ({{ number_format(@$ty1, 0) }}) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                                            <td>
                                                <div class="flashing-card " >
                                                    <h4><i class="fa fa-user"></i> จำนวนลูกค้าที่ต่ออายุ:
                                                        ({{ number_format(@$ty2, 0) }}) </h4>
                                                </div>
                                            </td>
                                        </tr>


                                        <?php 
                                        $i1=App\Models\users_in::whereNull('type_f')->count();
                                        $i2=App\Models\users_in::whereNotNull('type_f')->count();



                                        $e1 = App\Models\users_in::whereNull('type_f')->pluck('id')->ToArray();
                                        $e2 = App\Models\users_in::whereNotNull('type_f')->pluck('id')->ToArray();

                                        $na = App\Models\users_in::whereNull('type_f')->count();
                                        $ta = App\Models\users_in::whereNotNull('type_f')->count();

                                        $aa=$na*5;
                                        $ab=$na*2;
                                        $bb=$ta*5;

                                        $in = App\Models\users_in_in::whereNull('type_mail')->whereIn('id_user_in',@$e1)->count();
                                        $q1=$aa-$in;

                                        $in1 = App\Models\users_in_in::whereNotNull('type_mail')->whereIn('id_user_in',@$e1)->count();
                                        $q11=$ab-$in1;

                                        $inn = App\Models\users_in_in::whereIn('id_user_in',@$e2)->count();
                                        $q2=$bb-$inn;

                                        ?>
                                        <tr>
                                        <td>
                                                <div class="flashing-card " >
                                                    <h4><i class="fa fa-user"></i> จำนวนที่ว่างใน Netflix(ไม่รวมทีวี):
                                                        ({{ number_format(@$q1, 0) }})</h4>

                                                        <h4><i class="fa fa-user"></i> จำนวนที่ว่างใน Netflix(รวมทีวี):
                                                        ({{ number_format(@$q11, 0) }})</h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card " >
                                                    <h4><i class="fa fa-user"></i> จำนวนที่ว่างใน Youtube:
                                                        ({{ number_format(@$q2, 0) }})</h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card " >
                                                    <h4><i class="fa fa-user"></i> จำนวน Account Netflix:
                                                        ({{ number_format(@$i1, 0) }}) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card " >
                                                    <h4><i class="fa fa-user"></i> จำนวน Account YouTube Premium:
                                                        ({{ number_format(@$i2, 0) }}) </h4>
                                                </div>
                                            </td>
                                        </tr>




                                        <?php  
                                        $all_user = App\Models\users::distinct('username')->count();
                                        $pak =App\Models\PackageSubwatch::get();

                                        $date=('Y-m-d');

                                        $dar = App\Models\users::distinct('username')->whereDate('created_at',$date)->count();

                                        $mon = App\Models\users::where('time_online', '>=', Carbon\Carbon::now('Asia/Bangkok')->subMinutes(10))->count();

                                        ?>

                                        <tr>
                                            <td>
                                                <div class="flashing-card toggle-btn" data-target="#table-expired">
                                                    <h4><i class="fa fa-user"></i> จำนวนผู้ใช้ทั้งหมด:
                                                        ({{ number_format(@$all_user, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card toggle-btn" data-target="#table-expired-2">
                                                    <h4><i class="fa fa-user"></i> จำนวนลูกค้าที่สมัครวันนี้:
                                                        ({{ number_format(@$dar, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <div class="flashing-card" >
                                                    <h4><i class="fa fa-user"></i> ลูกค้าที่ออนไลน์บนเว็ปไซต์:
                                                        ({{ number_format(@$mon, 0) }} คน) </h4>
                                                </div>
                                            </td>
                                        </tr>


                                    </table>
                                </div>
                                <br><br><br>


                                <div id="table-container" style="position: relative; min-height: 5000px;">

                                    <div class="dt-responsive table-responsive" id="table-expired">
                                        <h3><i class="fa fa-user"></i>จำนวนผู้ใช้ทั้งหมด
                                            ({{ number_format(@$all_user, 0) }} คน) </h3>
                                        <table id="simpletable_no2" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>Name Package</th>
                                                    <th>จำนวนคนทีใช้งาน Package</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                                @foreach($pak as $key=>$paks)
                                                <?php $nus = App\Models\users::distinct('username')->where('id_package',$paks->id)->count(); ?>
                                                <tr>
                                                    <td>{{@$key+1}}</td>
                                                    <td>{{@$paks->Subpackage_Name}} @if(@$paks->type=='PC') (รวมทีวี)  @endif </td>
                                                    <td>{{@$nus}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <br><br><br><br>


                                    <div class="dt-responsive table-responsive" id="table-expired-2">
                                        <h3><i class="fa fa-user"></i>จำนวนลูกค้าที่สมัครวันนี้
                                            ({{ number_format(@$dar, 0) }} คน) </h3>
                                        <table id="simpletable_no" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>Name Package</th>
                                                    <th>จำนวนคนทีใช้งาน Package</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody class="">
                                                @foreach($pak as $key=>$paks)
                                                <?php $aaa = App\Models\users::distinct('username')->where('id_package',$paks->id)->whereDate('created_at',$date)->count(); ?>
                                                @if(@$aaa!=0)
                                                <tr>
                                                    <td>{{@$key+1}}</td>
                                                    <td>{{@$paks->Subpackage_Name}} @if(@$paks->type=='PC') (รวมทีวี)  @endif </td>
                                                    <td>{{@$aaa}}</td>
                                                </tr>
                                                @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>








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
$(document).ready(function() {
    // ซ่อนตารางทั้งหมดก่อน ยกเว้น table-expired
    $('#table-expired').show();
    $('#table-expired-2').hide();

    // เมื่อคลิกที่หัวข้อให้แสดงเฉพาะตารางที่เกี่ยวข้อง
    $('.toggle-btn').click(function() {
        var targetTable = $(this).data('target');
        $('div[id^="table-expired"]').hide(); // ซ่อนทุกตารางที่ชื่อขึ้นต้นด้วย table-expired
        $(targetTable).show(); // แสดงเฉพาะตารางที่คลิก
    });
});
</script>




@endsection