<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPlatform - Share Your Stories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Dark Mode Variables */
        :root {
            --bg-gradient-start: #667eea;
            --bg-gradient-end: #764ba2;
            --navbar-bg: rgba(255, 255, 255, 0.95);
            --text-primary: #333;
            --text-secondary: #666;
            --card-bg: white;
            --section-bg: white;
            --section-alt-bg: #f8f9fa;
            --footer-bg: #1a1a2e;
            --border-color: #e0e0e0;
            --stat-bg: white;
            --service-card-bg: white;
        }

        body.dark {
            --bg-gradient-start: #1a1a2e;
            --bg-gradient-end: #16213e;
            --navbar-bg: rgba(30, 30, 46, 0.95);
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --card-bg: #1e1e2e;
            --section-bg: #1e1e2e;
            --section-alt-bg: #252536;
            --footer-bg: #0f0f1a;
            --border-color: #2d2d3a;
            --stat-bg: #1e1e2e;
            --service-card-bg: #1e1e2e;
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

        /* Navbar Styles */
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

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px 60px;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero h1 {
            font-size: 3.5rem;
            color: white;
            margin-bottom: 1rem;
            animation: fadeInUp 0.8s ease;
        }

        .hero p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            animation: fadeInUp 1.2s ease;
        }

        .btn-primary {
            background: white;
            color: #667eea;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-outline:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
        }

        /* Sections */
        .section {
            padding: 80px 20px;
            background: var(--section-bg);
            transition: background 0.3s ease;
        }

        .section:nth-child(even) {
            background: var(--section-alt-bg);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--text-primary);
            margin-bottom: 3rem;
            transition: color 0.3s ease;
        }

        /* About Section */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-text p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            text-align: center;
        }

        .stat {
            background: var(--stat-bg);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .stat i {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .stat h3 {
            font-size: 2rem;
            color: var(--text-primary);
        }

        .stat p {
            color: var(--text-secondary);
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: var(--service-card-bg);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-card i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .service-card h3 {
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .service-card p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Contact Section */
        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-item i {
            font-size: 1.5rem;
            color: #667eea;
            width: 40px;
        }

        .info-item p {
            color: var(--text-secondary);
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-family: inherit;
            background: var(--card-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #667eea;
            outline: none;
        }

        .contact-form textarea {
            min-height: 150px;
            resize: vertical;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }

        /* Footer */
        .footer {
            background: var(--footer-bg);
            color: white;
            text-align: center;
            padding: 2rem;
            transition: background 0.3s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .about-content,
            .contact-content {
                grid-template-columns: 1fr;
            }

            .about-stats {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }

        /* User Dropdown Styles */
        .user-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            background: transparent;
            border: 2px solid #667eea;
            border-radius: 50px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .dropdown-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: none;
        }

        .dropdown-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 10px;
            background: var(--card-bg);
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .dropdown-content a,
        .dropdown-content .dropdown-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-primary);
            font-size: 14px;
            transition: background 0.2s ease;
            width: 100%;
            text-align: left;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .dropdown-content a:hover,
        .dropdown-content .dropdown-logout:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: none;
        }

        .dropdown-content hr {
            margin: 5px 0;
            border-color: var(--border-color);
        }

        .dropdown-content i {
            width: 20px;
            color: #667eea;
        }

        .dropdown-logout {
            color: #e74c3c !important;
        }

        .dropdown-logout i {
            color: #e74c3c !important;
        }

        /* Show dropdown when active */
        .dropdown-content.show {
            display: block;
            animation: fadeIn 0.2s ease;
        }

        /* Posts Section */
        .section-subtitle {
            text-align: center;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .post-card {
            background: var(--card-bg);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .post-card-header {
            padding: 20px 20px 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .post-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-avatar i {
            font-size: 28px;
            color: white;
        }

        .author-info h4 {
            color: var(--text-primary);
            font-size: 16px;
            margin-bottom: 4px;
        }

        .author-info span {
            color: var(--text-secondary);
            font-size: 12px;
        }

        .post-card-body {
            padding: 20px;
        }

        .post-card-body h3 {
            color: var(--text-primary);
            font-size: 1.3rem;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .post-card-body p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .post-card-footer {
            padding: 15px 20px 20px;
            border-top: 1px solid var(--border-color);
        }

        .read-more {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s ease;
        }

        .read-more:hover {
            gap: 12px;
        }

        .view-all {
            text-align: center;
            margin-top: 2rem;
        }

        .no-posts {
            text-align: center;
            padding: 60px;
            background: var(--card-bg);
            border-radius: 15px;
            color: var(--text-secondary);
        }

        /* Post Modal */
        .post-modal-content {
            max-width: 700px !important;
            max-height: 80vh;
            overflow-y: auto;
        }

        .post-modal-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-secondary);
            font-size: 14px;
        }

        .post-modal-text {
            color: var(--text-primary);
            line-height: 1.8;
            font-size: 16px;
        }

        .post-modal-text p {
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .posts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Dark Mode Toggle Button -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
        🌙
    </button>

    <script>
        // Dark mode initialization and management
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

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <i class="fas fa-blog"></i> BlogPlatform
            </a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#posts">Blog</a>
                <a href="#contact">Contact</a>
                <a href="/about">Team</a>
                <div class="auth-buttons">
                    @auth
                        <div class="user-dropdown">
                            <button class="dropdown-btn" onclick="toggleDropdown()">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile"
                                        class="dropdown-avatar">
                                @else
                                    <i class="fas fa-user-circle" style="font-size: 24px; color: #667eea;"></i>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-content" id="userDropdown">
                                <a href="/dashboard">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                                <a href="#" onclick="openProfileModal()">
                                    <i class="fas fa-user-circle"></i> My Profile
                                </a>
                                <a href="#" onclick="openPasswordModal()">
                                    <i class="fas fa-key"></i> Change Password
                                </a>
                                <hr>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-logout">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login-page" class="btn-login">Login</a>
                        <a href="/register-page" class="btn-register">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to BlogPlatform</h1>
            <p>Share your stories, connect with readers, and grow your audience. Join thousands of bloggers who express
                themselves every day.</p>
            <div class="cta-buttons">
                @guest
                    <a href="/register-page" class="btn-primary">Get Started</a>
                    <a href="#about" class="btn-outline">Learn More</a>
                @else
                    <a href="/dashboard" class="btn-primary">Go to Dashboard</a>
                    <a href="#about" class="btn-outline">Learn More</a>
                @endguest
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>BlogPlatform is a modern blogging platform designed for writers, creators, and thinkers. We
                        believe everyone has a story to tell, and we're here to help you share it with the world.</p>
                    <p>Founded in 2024, our mission is to provide a clean, intuitive platform where bloggers can focus
                        on what matters most - creating great content.</p>
                    <p>With our easy-to-use interface and powerful features, you can start blogging in minutes and reach
                        readers globally.</p>
                </div>
                <div class="about-stats">
                    <div class="stat">
                        <i class="fas fa-users"></i>
                        <h3>10K+</h3>
                        <p>Active Users</p>
                    </div>
                    <div class="stat">
                        <i class="fas fa-newspaper"></i>
                        <h3>50K+</h3>
                        <p>Blog Posts</p>
                    </div>
                    <div class="stat">
                        <i class="fas fa-heart"></i>
                        <h3>100K+</h3>
                        <p>Happy Readers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-pen-fancy"></i>
                    <h3>Easy Blog Creation</h3>
                    <p>Create beautiful blog posts with our rich text editor. Format your content easily and add images.
                    </p>
                </div>
                <div class="service-card">
                    <i class="fas fa-moon"></i>
                    <h3>Dark Mode</h3>
                    <p>Enjoy comfortable reading with our dark mode feature. Switch between light and dark themes.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-user-circle"></i>
                    <h3>Custom Profiles</h3>
                    <p>Personalize your profile with custom avatars and bios. Showcase your personality.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Secure Platform</h3>
                    <p>Your data is safe with us. We prioritize security and privacy for all our users.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Analytics</h3>
                    <p>Track your post performance with built-in analytics. See how your content resonates.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-headset"></i>
                    <h3>24/7 Support</h3>
                    <p>Our support team is always here to help you with any questions or issues.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>123 Blog Street, Digital City, DC 12345</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <p>hello@blogplatform.com</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <p>+1 (555) 123-4567</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <p>Mon - Fri: 9AM - 6PM</p>
                    </div>
                </div>
                <form class="contact-form" action="/contact" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Latest Blog Posts Section -->
    <section id="posts" class="section">
        <div class="container">
            <h2 class="section-title">Latest Blog Posts</h2>
            <p class="section-subtitle">Discover what our community is sharing</p>

            <div class="posts-grid">
                @forelse($posts as $post)
                    <div class="post-card">
                        <div class="post-card-header">
                            <div class="post-author">
                                <div class="author-avatar">
                                    @if($post->user->profile_picture)
                                        <img src="{{ asset('storage/' . $post->user->profile_picture) }}"
                                            alt="{{ $post->user->name }}">
                                    @else
                                        <i class="fas fa-user-circle"></i>
                                    @endif
                                </div>
                                <div class="author-info">
                                    <h4>{{ $post->user->name }}</h4>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="post-card-body">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->body, 150) }}</p>
                        </div>
                        <div class="post-card-footer">
                            <a href="#" class="read-more" onclick="showPostModal({{ $post->id }})">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="no-posts">
                        <p>No posts yet. Be the first to create a post!</p>
                    </div>
                @endforelse
            </div>

            @if($posts->count() > 0)
                <div class="view-all">
                    @auth
                        <a href="/dashboard" class="btn-primary">Create Your Own Post →</a>
                    @else
                        <a href="/login-page" class="btn-primary">Login to Create a Post →</a>
                    @endauth
                </div>
            @endif
        </div>
    </section>
    <!-- Post Detail Modal -->
    <div id="postModal" class="modal">
        <div class="modal-content post-modal-content">
            <div class="modal-header">
                <h3 id="modalTitle"></h3>
                <span class="close" onclick="closePostModal()">&times;</span>
            </div>
            <div class="post-modal-body">
                <div class="post-modal-meta">
                    <span id="modalAuthor"></span>
                    <span id="modalDate"></span>
                </div>
                <div id="modalBody" class="post-modal-text"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 BlogPlatform. All rights reserved.</p>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function (event) {
            if (!event.target.matches('.dropdown-btn') && !event.target.closest('.dropdown-btn')) {
                const dropdowns = document.getElementsByClassName('dropdown-content');
                for (let i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
        }

        function openProfileModal() {
            // You can create a profile modal or redirect to profile page
            window.location.href = '/dashboard';
        }

        function openPasswordModal() {
            // Redirect to dashboard with password modal open
            window.location.href = '/dashboard?open=password';
        }
    </script>

    <script>
        function showPostModal(postId) {
            // Get post data from the DOM (or you can fetch via AJAX)
            const postCard = event.target.closest('.post-card');
            const title = postCard.querySelector('.post-card-body h3').innerText;
            const body = postCard.querySelector('.post-card-body p').innerText;
            const author = postCard.querySelector('.author-info h4').innerText;
            const date = postCard.querySelector('.author-info span').innerText;

            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalBody').innerHTML = `<p>${body}</p>`;
            document.getElementById('modalAuthor').innerHTML = `<i class="fas fa-user"></i> ${author}`;
            document.getElementById('modalDate').innerHTML = `<i class="fas fa-calendar"></i> ${date}`;

            document.getElementById('postModal').style.display = 'block';
        }

        function closePostModal() {
            document.getElementById('postModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('postModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>