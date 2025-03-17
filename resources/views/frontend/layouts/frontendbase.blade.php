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
    $ReferFriendFrst = App\Models\ReferFriend::where('referee_user_id',@$userCKReferFrst->id)->whereNull('referrer_user_id')->first();
@endphp

<body id="bodystart">
    <div style="position:absolute;right: 0;padding:5px;" id="btnMenuS1">
        @if(@$ReferFriendFrst&&@$ProfileNows)
            <button class="btn btn-primary logout-bt" type="button" id="ReferFriend" onclick="confirmReferrerFRSTBTN();">ให้คะแนผู้แนะนำ</button>
        @endif
        <button class="btn btn-primary logout-bt" type="button" id="ReferFriend" onclick="shareAndCopyTF(`https://lin.ee/jgB0ld5`);">แนะนำเพื่อน</button>
        <button class="btn btn-primary logout-bt" type="button" id="RewardsBtn" onclick="document.location.href=`{{route('frontend.rewards')}}`;">Rewards</button>
        <button class="btn btn-primary logout-bt" type="button" id="ProfileBtn" onclick="document.location.href=`{{route('frontend.profile')}}`;">Profile</button>
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


