<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - BlogPlatform</title>
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
        }

        /* Dark Mode Variables */
        :root {
            --bg-gradient-start: #667eea;
            --bg-gradient-end: #764ba2;
            --navbar-bg: rgba(255, 255, 255, 0.95);
            --text-primary: #333;
            --text-secondary: #666;
            --card-bg: white;
            --footer-bg: #1a1a2e;
            --border-color: #e0e0e0;
            --tag-bg: #f0f0f0;
        }

        body.dark {
            --bg-gradient-start: #1a1a2e;
            --bg-gradient-end: #16213e;
            --navbar-bg: rgba(30, 30, 46, 0.95);
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --card-bg: #1e1e2e;
            --footer-bg: #0f0f1a;
            --border-color: #2d2d3a;
            --tag-bg: #2d2d3a;
        }

        /* Navbar */
        .navbar {
            background: var(--navbar-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            transition: background 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
        }

        .logo i {
            color: #667eea;
            margin-right: 8px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-login {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* Dark Mode Toggle */
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

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 100px 20px 60px;
        }

        .page-title {
            text-align: center;
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .page-subtitle {
            text-align: center;
            color: rgba(255,255,255,0.9);
            margin-bottom: 3rem;
            font-size: 1.2rem;
        }

        /* About Cards */
        .about-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
        }

        .about-card h2 {
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .about-card h2 i {
            color: #667eea;
        }

        .about-card p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        /* Mission Vision Section */
        .mv-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .mv-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .mv-card:hover {
            transform: translateY(-5px);
        }

        .mv-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .mv-icon i {
            font-size: 30px;
            color: white;
        }

        .mv-card h3 {
            color: var(--text-primary);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .mv-card p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Team Section */
        .team-section {
            margin-top: 1rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .team-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.2rem;
            overflow: hidden;
            border: 4px solid #667eea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .team-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-card h3 {
            color: var(--text-primary);
            font-size: 1.3rem;
            margin-bottom: 0.3rem;
        }

        .team-role {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            display: inline-block;
            padding: 4px 12px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 20px;
        }

        .team-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Skills Tags */
        .team-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-top: 1rem;
        }

        .skill-tag {
            background: var(--tag-bg);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Values Section */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .value-item {
            text-align: center;
            padding: 1.5rem;
            background: var(--card-bg);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .value-item:hover {
            transform: translateY(-3px);
        }

        .value-item i {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 0.8rem;
        }

        .value-item h4 {
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .value-item p {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        /* Footer */
        .footer {
            background: var(--footer-bg);
            color: white;
            text-align: center;
            padding: 2rem;
            transition: background 0.3s ease;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .mv-section {
                grid-template-columns: 1fr;
            }
            
            .team-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle">🌙</button>

    <script>
        (function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            
            if (isDarkMode || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.body.classList.add('dark');
                darkModeToggle.innerHTML = '☀️';
            } else {
                document.body.classList.remove('dark');
                darkModeToggle.innerHTML = '🌙';
            }
            
            darkModeToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark');
                const isDark = document.body.classList.contains('dark');
                localStorage.setItem('darkMode', isDark);
                darkModeToggle.innerHTML = isDark ? '☀️' : '🌙';
            });
        })();
    </script>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <i class="fas fa-blog"></i> BlogPlatform
            </a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/#about">About</a>
                <a href="/#services">Services</a>
                <a href="/#contact">Contact</a>
                <div class="auth-buttons">
                    @auth
                        <a href="/dashboard" class="btn-login">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <form action="/logout" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-register" style="cursor: pointer;">Logout</button>
                        </form>
                    @else
                        <a href="/login-page" class="btn-login">Login</a>
                        <a href="/register-page" class="btn-register">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">About Us</h1>
        <p class="page-subtitle">Learn more about our story, mission, and the team behind BlogPlatform</p>

        <!-- Our Story -->
        <div class="about-card">
            <h2><i class="fas fa-book-open"></i> Our Story</h2>
            <p>BlogPlatform was born from a simple idea: everyone has a story worth sharing. We created this platform to empower writers, creators, and thinkers to express themselves freely and connect with a global audience.</p>
            <p>What started as a university project has grown into a fully-featured blogging platform used by bloggers worldwide. Our mission is to provide a clean, intuitive, and powerful platform where creativity knows no bounds.</p>
        </div>

        <!-- Mission & Vision -->
        <div class="mv-section">
            <div class="mv-card">
                <div class="mv-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Our Mission</h3>
                <p>To provide a seamless, intuitive blogging platform that empowers individuals to share their stories, ideas, and expertise with the world.</p>
            </div>
            <div class="mv-card">
                <div class="mv-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Our Vision</h3>
                <p>To become the world's most trusted and beloved blogging platform, fostering a global community of creators and thinkers.</p>
            </div>
        </div>

        <!-- Meet Our Team -->
        <div class="about-card">
            <h2><i class="fas fa-users"></i> Meet Our Team</h2>
            <p>We are a passionate group of developers and designers committed to building the best blogging experience.</p>
            
            @php
                $teamMembers = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->get();
            @endphp

            @if($teamMembers->count() > 0)
            <div class="team-grid">
                @foreach($teamMembers as $member)
                <div class="team-card">
                    <div class="team-avatar">
                        <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}">
                    </div>
                    <h3>{{ $member->name }}</h3>
                    <span class="team-role">{{ $member->role }}</span>
                    <p class="team-desc">{{ $member->description }}</p>
                </div>
                @endforeach
            </div>
            @else
                <p style="text-align: center; color: var(--text-secondary); padding: 40px;">No team members added yet. Please check back soon!</p>
            @endif
        </div>

        <!-- Our Values -->
        <div class="about-card">
            <h2><i class="fas fa-gem"></i> Our Values</h2>
            <div class="values-grid">
                <div class="value-item">
                    <i class="fas fa-heart"></i>
                    <h4>Passion</h4>
                    <p>We love what we do and it shows in every feature we build.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-lightbulb"></i>
                    <h4>Innovation</h4>
                    <p>Constantly improving and adding new features.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Security</h4>
                    <p>Your data and privacy are our top priority.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-globe"></i>
                    <h4>Community</h4>
                    <p>Building a platform that brings people together.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 BlogPlatform. All rights reserved. | Built with <i class="fas fa-heart" style="color: #e74c3c;"></i> by the BlogPlatform Team</p>
    </footer>
</body>
</html>