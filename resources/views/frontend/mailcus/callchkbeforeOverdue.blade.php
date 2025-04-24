<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Check Befor Overdue.....
</body>
</html>

<script>
    var counts = 0;
    var pcount = 0;
    var dataid = [];
    fetch('{{ route("frontend.chkbeforeOverdue") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ }),
    })
    .then(response => response.json())
    .then(data => {
        dataid = data.users_bfover;
        counts = dataid.length;
        console.log(data.users_bfover,counts);
        if(pcount<counts) startSendmail();
    })
    .catch(error => {
        console.error('Error:', error);
    });

    function startSendmail() {
        fetch('{{ route("frontend.beforeOverdueSentMail") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ idbfOver: dataid[pcount] }),
        })
        .then(response => response.json())
        .then(data => {
            console.log(dataid[pcount]);

            pcount++;
            if(pcount<counts) 
                setTimeout(() => {
                    startSendmail();
                }, 6500);
            else console.log('Success Send Mail...');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>