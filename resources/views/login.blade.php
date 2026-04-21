<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BlogPlatform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Dark Mode Variables */
        :root {
            --bg-gradient-start: #667eea;
            --bg-gradient-end: #764ba2;
            --card-bg: white;
            --text-primary: #333;
            --text-secondary: #666;
            --border-color: #e0e0e0;
            --input-bg: white;
        }

        body.dark {
            --bg-gradient-start: #1a1a2e;
            --bg-gradient-end: #16213e;
            --card-bg: #1e1e2e;
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --border-color: #2d2d3a;
            --input-bg: #2d2d3a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            transition: background 0.3s ease;
        }

        /* Dark Mode Toggle Button */
        .dark-mode-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
            cursor: pointer;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .dark-mode-toggle:hover {
            transform: scale(1.1);
        }

        .login-container {
            max-width: 450px;
            width: 100%;
        }

        .card {
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            transition: background 0.3s ease;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 50px;
            color: #667eea;
        }

        .logo h1 {
            color: var(--text-primary);
            margin-top: 10px;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: var(--text-primary);
            margin-bottom: 30px;
            text-align: center;
            transition: color 0.3s ease;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 18px;
            z-index: 1;
        }

        input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
            background: var(--input-bg);
            color: var(--text-primary);
        }

        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input::placeholder {
            color: var(--text-secondary);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: var(--text-secondary);
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-messages {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f5c6cb;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }

        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .back-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
        🌙
    </button>

    <script>
        (function () {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const isDarkMode = localStorage.getItem('darkMode') === 'true';

            if (isDarkMode || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.body.classList.add('dark');
                if (darkModeToggle) darkModeToggle.innerHTML = '☀️';
            } else {
                document.body.classList.remove('dark');
                if (darkModeToggle) darkModeToggle.innerHTML = '🌙';
            }

            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', function () {
                    document.body.classList.toggle('dark');
                    const isDark = document.body.classList.contains('dark');
                    localStorage.setItem('darkMode', isDark);
                    darkModeToggle.innerHTML = isDark ? '☀️' : '🌙';
                });
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!('darkMode' in localStorage)) {
                    if (e.matches) {
                        document.body.classList.add('dark');
                        if (darkModeToggle) darkModeToggle.innerHTML = '☀️';
                    } else {
                        document.body.classList.remove('dark');
                        if (darkModeToggle) darkModeToggle.innerHTML = '🌙';
                    }
                }
            });
        })();
    </script>

    <div class="login-container">
        <div class="card">
            <div class="logo">
                <i class="fas fa-blog"></i>
                <h1>BlogPlatform</h1>
            </div>

            <h2 class="form-title">Welcome Back!</h2>

            @if($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" name="loginname" placeholder="Username" value="{{ old('loginname') }}" required>
                </div>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="loginpassword" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-btn">Log In</button>
            </form>
            <div class="forgot-link" style="text-align: center; margin-top: 15px;">
                <a href="/forgot-password" style="color: #667eea; text-decoration: none; font-size: 14px;">Forgot
                    Password?</a>
            </div>

            <div class="register-link">
                Don't have an account? <a href="/register-page">Register</a>
            </div>
        </div>
        <div class="back-home">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>
    </div>
</body>

</html>