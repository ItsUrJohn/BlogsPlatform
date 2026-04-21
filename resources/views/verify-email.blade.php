<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - BlogPlatform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            width: 100%;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            text-align: center;
        }

        .logo i {
            font-size: 60px;
            color: #667eea;
            margin-bottom: 20px;
        }

        .logo h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .message {
            color: #666;
            margin: 20px 0;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin-top: 10px;
        }

        .resend-form {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .resend-btn {
            background: transparent;
            border: none;
            color: #667eea;
            cursor: pointer;
            font-size: 14px;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="logo">
                <i class="fas fa-envelope"></i>
                <h1>Verify Your Email</h1>
            </div>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <p class="message">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>

            <form action="/email/verification-notification" method="POST" class="resend-form">
                @csrf
                <button type="submit" class="resend-btn">Resend Verification Email</button>
            </form>

            <div>
                <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn">
                    Logout
                </a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</body>
</html>