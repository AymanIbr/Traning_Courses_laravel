

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Emails</title>
</head>
<body>
    There is new Message from {{$data['name']}} as bellow
    <br>
    Email : {{$data['email']}}
    <br>
    Mobile : {{$data['mobile']}}
    <br>
    Subject : {{$data['subject']}}
    <br>
    Message : {{$data['message']}}
</body>
</html>
