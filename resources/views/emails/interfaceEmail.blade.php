<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Xin chào!</h2>
    <p>Bạn đã yêu cầu đặt lại mật khẩu.</p>
    
    <p>Thông tin của bạn:</p>
    <ul>
        <li>Email: {{ $sentData['email'] ?? 'N/A' }}</li>
        <li>Mã xác nhận: {{ $sentData['code'] ?? 'N/A' }}</li>
    </ul>

    <p>Vui lòng sử dụng mã xác nhận trên để đặt lại mật khẩu của bạn.</p>
    
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>

    <p>Trân trọng,<br>
    {{ config('app.name') }}</p>
</body>
</html>