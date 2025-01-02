<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Reservation Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 20px;
            color: #444;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            margin: 10px 0;
        }

        .highlight {
            font-weight: bold;
            color: #0056b3;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0056b3;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #004494;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Live Meeting Request</h1>
        <p>
            Dear <span class="highlight">{{ $details['instructor_name'] ?? 'N/A' }}</span>, <br><br>
            <span class="highlight">{{ $details['student_name'] ?? 'N/A' }}</span> has requested an online live
            meeting. Below are the details: <br><br>
            <strong>Date:</strong> {{ $details['reservation_date'] ?? 'N/A' }}<br>
            <strong>Time:</strong> {{ $details['reservation_time'] ?? 'N/A' }}<br><br>
            Please respond to their request via notification if you are available.
        </p>
        <p>
            <strong>Student Message:</strong> <br>
            "{{ $details['student_message'] ?? 'No message provided.' }}"
        </p>
        <p class="footer">
            Thank you for your attention.<br>
            <em>This is an automated message. Please do not reply to this email.</em>
        </p>
    </div>
</body>

</html>
