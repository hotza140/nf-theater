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

<body id="bodystart">
    <div style="position:absolute;right: 0;padding:5px;" id="btnMenuS1">
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
