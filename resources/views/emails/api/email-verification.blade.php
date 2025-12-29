<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body>
    <p>Hello {{ $user->name }}</p>
    <h1>Verify your email address</h1>
    <p>Thanks for creating an account.</p>
    <p>Please Enter the below otp verify your email address</p>
    <p>OTP: <strong>{{ $otp }}</strong></p>
</body>
</html>
