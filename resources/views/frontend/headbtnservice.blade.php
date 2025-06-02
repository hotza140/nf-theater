<?php 
    $usersUse = Auth::guard('users')->user();
    $pak=DB::table('tb_users_in_in')->where('id_user',@$usersUse->id)->first();
    $ac=DB::table('tb_users_in')->where('id',@$pak->id_user_in)->first();
?>
<div class="d-link">
    <div class="d-link-in">
        @if(@$pak->date_start!=null)
            {{-- @if(@$selectNfYt=='NetFlix') --}}
            @if(@$usersUse->type_netflix==1)
                <div class="box-link-m"><a href="{{route('frontend.netflix')}}?id=1"><img src="assets/img/NF22%20(1).png"></a></div>
            @else
                <div class="box-link-m"><a href="{{route('frontend.youtube')}}?id=2"><img src="assets/img/NF11%20(1).png"></a></div>
            @endif
        @else
            <div class="box-link-m"><a class="cursor-box" href="https://lin.ee/4V1Jzlj" target="_blank"><img src="assets/img/NF7%20(1).png"></a></div><!--ต้องเอาไลน์ OA มาแสดง-->
        @endif
        {{-- <div class="box-link-m"><a href="{{route('frontend.netflix')}}?id=1"><img src="assets/img/NF22%20(1).png"></a></div>
        <div class="box-link-m"><a href="{{route('frontend.youtube')}}?id=2"><img src="assets/img/NF11%20(1).png"></a></div> --}}
        <div class="box-link-m"><a class="cursor-box" data-bs-target="#modal-member" data-bs-toggle="modal"><img src="assets/img/NF3%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" onclick="shareAndCopyTF(`https://lin.ee/jgB0ld5`);"><img src="assets/img/NF5%20(1).png"></a></div>
        <div class="box-link-m"><a class="cursor-box" data-bs-toggle="modal" data-bs-target="#modal-points"><img src="assets/img/NF4%20(1).png"></a></div>
        <div class="box-link-m"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url" target="_blank"><img src="assets/img/NF6%20(1).png"></a></div>
        {{-- <div class="box-link-m"><a href="{{route('frontend.Helpmanage')}}" target="_blank"><img src="assets/img/NF_help01.png"></a></div> --}}
    </div>
</div>

<script>
    document.getElementById('bodystart').style = `background: url("assets/img/image%201%20(1).jpg");`;
    // showmargin();
    // function showmargin() {
    //     let dlinkin = document.querySelector('.d-link-in');
    //     let boxlinkm = document.querySelectorAll('.box-link-m');
    //     let widthall = 0;
    //     let heightIS = 0;
    //     boxlinkm.forEach(element => {
    //         widthall += element.offsetWidth;
    //         heightIS  = element.offsetHeight;
    //     });
    //     // dlinkin.style = `margin-left: ${((dlinkin.offsetWidth-widthall)/2)}px;`; // +210
    //     let boxlinkmImg = document.querySelectorAll('.box-link-m img')
    //     boxlinkmImg.forEach(element => {
    //         element.style = `width:100%;`;
    //     });
    // }
    // window.addEventListener('resize', () => {
    //     // console.log('Window resized. New width:', document.body.clientWidth);
    //     // showmargin();
    // });
</script>