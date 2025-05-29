<!DOCTYPE html>
<html data-bs-theme="light" lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Netflix Pricing</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Krona+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Edit-Form.css">
</head>

@php
    $userCKReferFrst = Auth::guard('users')->user();
    $ReferFriendFrst = App\Models\ReferFriend::where('referee_username',@$userCKReferFrst->username)->whereNull('referrer_username')->first();
@endphp

<body id="bodystart">
    <div style="position:absolute;right: 0;padding:5px;" id="btnMenuS1">
        @if(@$ReferFriendFrst&&@$ProfileNows)
            <button class="btn btn-primary logout-bt" type="button" id="ReferFriend" onclick="confirmReferrerFRSTBTN();">ให้คะแนผู้แนะนำ</button>
        @endif
        {{-- <button class="btn btn-primary logout-bt" type="button" id="ReferFriend" onclick="shareAndCopyTF(`https://lin.ee/jgB0ld5`);">แนะนำเพื่อน</button> --}}
        {{-- <button class="btn btn-primary logout-bt" type="button" id="RewardsBtn" onclick="document.location.href=`{{route('frontend.rewards')}}`;">Rewards</button> --}}
        <button class="btn btn-primary logout-bt" type="button" id="ProfileBtn" onclick="document.location.href=`{{route('frontend.profile')}}`;">หน้าหลัก</button> <!--Profile-->
    </div>
    @yield('contentfront')
    
    <div>
        <p class="copy-r">Copyright ©&nbsp;NF Theater&nbsp;2024.</p>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('message'))
        <script>
            alert('{{session("message")}}');
        </script>
    @endif

</body>

</html>

<script>
    function fallbackCopyToClipboard(text) {
        const textarea = document.createElement("textarea");
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);
        alert(`Copied ${text} to clipboard !`);
    }

    // Example usage
    // fallbackCopyToClipboard("Hello, World!");


    function shareAndCopyTF(text) { 
        fallbackCopyToClipboard(text);
        window.open(text);
    }
</script>

<script>
    function datetimeShow() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formatted = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        // console.log(formatted); // Output: "2025-04-25 15:45:12"
        return formatted;
    }
</script>

<script>
    function OnlineUserUpdatetimeNow() {
        console.log(`Check Online Update {{@$userCKReferFrst->id}} {{@$userCKReferFrst->name}} ${datetimeShow()}`);
        fetch('{{ route("frontend.OnlineUserUpdatetimeNow") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ iduser : {{@$userCKReferFrst->id??0}}}),
        })
        .then(response => response.json())
        .then(data => {
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    setInterval(() => {
        OnlineUserUpdatetimeNow();
    }, 60000);
</script>


