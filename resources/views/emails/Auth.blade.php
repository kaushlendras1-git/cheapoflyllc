<!DOCTYPE html>
<html>
<head>
    <title>Booking Acknowledgement</title>
</head>
<body>
    <h1>Booking Acknowledgement</h1>
    <p>Dear {{ $booking->name }},</p>
    <p>Thank you for your booking. Here are the details:</p>
    <ul>
        <li><strong>PNR:</strong> {{ $booking->pnr }}</li>
        <li><strong>Email:</strong> {{ $booking->email }}</li>
        <li><strong>Phone:</strong> {{ $booking->phone }}</li>
    </ul>
    <p><a href="{{ route('signature.form') }}">Click here to authorize your booking</a></p>
    <p>Best regards,<br>Your Company Name</p>
</body>
</html>