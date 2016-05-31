<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('label')->sign_up_confirmation}}</title>
</head>
<body>


<h1>{{config('label')->thanks_for_signing_up}}</h1>


<p>
    {{config('label')->we_just_need_you_to}} <a href='{{ url("register/confirm/{$user->token}") }}'>{{config('label')->confirm_your_email_address}}</a> {{config('label')->real_quick}}
</p>


</body>
</html>