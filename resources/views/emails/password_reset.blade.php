<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <p>Hello,</p>
    <p>Click the link below to reset your password:</p>
    <p><a href="{{ url('password/reset', ['token' => $token, 'email' => $email]) }}">Reset Password</a></p>
</body>
</html>
