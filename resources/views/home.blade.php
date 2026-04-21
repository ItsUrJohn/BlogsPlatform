<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BlogPlatform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Dark Mode Variables */
        :root {
            --bg-gradient-start: #667eea;
            --bg-gradient-end: #764ba2;
            --card-bg: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border-color: #e0e0e0;
            --input-bg: #ffffff;
            --post-bg: #f8f9fa;
            --modal-bg: #ffffff;
            --navbar-bg: #ffffff;
            --success-bg: #d4edda;
            --success-text: #155724;
            --error-bg: #f8d7da;
            --error-text: #721c24;
        }

        body.dark {
            --bg-gradient-start: #1a1a2e;
            --bg-gradient-end: #16213e;
            --card-bg: #1e1e2e;
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --border-color: #2d2d3a;
            --input-bg: #2d2d3a;
            --post-bg: #252536;
            --modal-bg: #1e1e2e;
            --navbar-bg: #1e1e2e;
            --success-bg: #1a3a2a;
            --success-text: #90ee90;
            --error-bg: #3a1a1a;
            --error-text: #ff9999;
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
            padding: 20px;
            transition: background 0.3s ease;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: 0 auto;
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

        /* Navbar */
        .navbar {
            background: var(--navbar-bg);
            border-radius: 15px;
            padding: 15px 25px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .navbar h2 {
            color: var(--text-primary);
        }

        .nav-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-links a {
            color: #667eea;
            text-decoration: none;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .card h2 {
            color: var(--text-primary);
            margin-bottom: 20px;
        }

        .card p {
            color: var(--text-secondary);
        }

        /* Profile Card */
        .profile-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-avatar i {
            font-size: 40px;
            color: white;
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }

        .user-avatar:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay i {
            font-size: 24px;
        }

        .user-details h2 {
            color: var(--text-primary);
            font-size: 22px;
            margin-bottom: 5px;
        }

        .user-details p {
            color: var(--text-secondary);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-details p i {
            color: #667eea;
        }

        .profile-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .profile-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        /* Form Elements */
        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            margin-bottom: 15px;
            background: var(--input-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--text-secondary);
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
        }

        .create-btn {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        }

        /* Posts */
        .post {
            background: var(--post-bg);
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            transition: background 0.3s ease;
        }

        .post h3 {
            color: var(--text-primary);
            margin-bottom: 10px;
        }

        .post-meta {
            color: var(--text-secondary);
            font-size: 12px;
            margin-bottom: 10px;
        }

        .post-body {
            color: var(--text-primary);
            margin: 10px 0;
            line-height: 1.6;
        }

        .post-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .edit-btn,
        .delete-btn {
            padding: 5px 15px;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .edit-btn {
            background: #3498db;
        }

        .delete-btn {
            background: #e74c3c;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: var(--modal-bg);
            margin: 10% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 450px;
            position: relative;
            animation: slideDown 0.3s ease;
            transition: background 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
        }

        .modal-header h3 {
            color: var(--text-primary);
        }

        .close {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .close:hover {
            color: var(--text-primary);
        }

        .current-avatar {
            text-align: center;
            margin-bottom: 20px;
        }

        .current-avatar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #667eea;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: block;
            padding: 12px;
            background: var(--input-bg);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-primary);
        }

        .file-input-label:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .success-message {
            background: var(--success-bg);
            color: var(--success-text);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }

        .error-messages {
            background: var(--error-bg);
            color: var(--error-text);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f5c6cb;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                text-align: center;
            }

            .user-info {
                flex-direction: column;
                text-align: center;
            }

            .profile-actions {
                width: 100%;
                justify-content: center;
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

    <div class="dashboard-container">

        <!-- Navbar -->
        <div class="navbar">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
            <div class="nav-links">
                <a href="/"><i class="fas fa-home"></i> Home</a>
                <form action="/logout" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- User Profile Card -->
        <div class="profile-card">
            <div class="user-info">
                <div class="user-avatar" onclick="openProfilePictureModal()">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <i class="fas fa-user-circle"></i>
                    @endif
                    <div class="avatar-overlay">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <div class="user-details">
                    <h2>Welcome back, {{ Auth::user()->name }}! 😋</h2>
                    <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
                    <p><i class="fas fa-calendar-alt"></i> Member since {{ Auth::user()->created_at->format('F Y') }}
                    </p>
                </div>
            </div>
            <div class="profile-actions">
                <button onclick="openPasswordModal()" class="profile-btn">
                    <i class="fas fa-key"></i> Change Password
                </button>
            </div>
        </div>

        <!-- Profile Picture Modal -->
        <div id="profilePictureModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="fas fa-camera"></i> Profile Picture</h3>
                    <span class="close" onclick="closeProfilePictureModal()">&times;</span>
                </div>

                <div class="current-avatar">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <img src="https://ui-avatars.com/api/?background=667eea&color=fff&name={{ urlencode(Auth::user()->name) }}"
                            alt="{{ Auth::user()->name }}">
                    @endif
                </div>

                <form action="/update-profile-picture" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="file-input-wrapper">
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                            onchange="previewImage(this)">
                        <label for="profile_picture" class="file-input-label">
                            <i class="fas fa-upload"></i> Choose Image
                        </label>
                    </div>
                    <div id="imagePreview" style="text-align: center; margin-bottom: 20px; display: none;">
                        <img id="preview" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    </div>
                    <button type="submit" class="profile-btn" style="width: 100%;">Upload Picture</button>
                </form>

                @if(Auth::user()->profile_picture)
                    <form action="/remove-profile-picture" method="POST" style="margin-top: 15px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="profile-btn"
                            style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); width: 100%;">
                            <i class="fas fa-trash"></i> Remove Picture
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Change Password Modal -->
        <div id="passwordModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="fas fa-key"></i> Change Password</h3>
                    <span class="close" onclick="closePasswordModal()">&times;</span>
                </div>
                <form action="/change-password" method="POST">
                    @csrf
                    <div class="input-wrapper" style="position: relative; margin-bottom: 20px;">
                        <i class="fas fa-lock"
                            style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #667eea;"></i>
                        <input type="password" name="current_password" placeholder="Current Password"
                            style="padding-left: 45px;" required>
                    </div>
                    <div class="input-wrapper" style="position: relative; margin-bottom: 20px;">
                        <i class="fas fa-lock"
                            style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #667eea;"></i>
                        <input type="password" name="new_password" id="newPassword" placeholder="New Password"
                            style="padding-left: 45px;" required>
                    </div>
                    <div class="input-wrapper" style="position: relative; margin-bottom: 20px;">
                        <i class="fas fa-lock"
                            style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #667eea;"></i>
                        <input type="password" name="new_password_confirmation" id="confirmPassword"
                            placeholder="Confirm New Password" style="padding-left: 45px;" required>
                    </div>
                    <button type="submit" class="profile-btn" style="width: 100%;">Update Password</button>
                </form>
            </div>
        </div>

        <!-- Create Post Card -->
        <div class="card">
            <h2><i class="fas fa-pen-alt"></i> Create New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Post Title" required>
                <textarea name="body" placeholder="Write your post content here..." rows="5" required></textarea>
                <button type="submit" class="create-btn"><i class="fas fa-paper-plane"></i> Publish Post</button>
            </form>
        </div>

        <!-- All Posts -->
        <div class="card">
            <h2><i class="fas fa-newspaper"></i> Your Posts</h2>
            @forelse ($posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <div class="post-meta">
                        <i class="fas fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                    </div>
                    <div class="post-body">
                        {{ $post->body }}
                    </div>
                    <div class="post-actions">
                        <a href="/edit-post/{{ $post->id }}" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                        <form action="/delete-post/{{ $post->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Delete this post?')"><i
                                    class="fas fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p style="color: var(--text-secondary); text-align: center;">No posts yet. Create your first post above!</p>
            @endforelse
        </div>
    </div>

    <script>
        function openPasswordModal() {
            document.getElementById('passwordModal').style.display = 'block';
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').style.display = 'none';
        }

        function openProfilePictureModal() {
            document.getElementById('profilePictureModal').style.display = 'block';
        }

        function closeProfilePictureModal() {
            document.getElementById('profilePictureModal').style.display = 'none';
        }

        function previewImage(input) {
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Close modals when clicking outside
        window.onclick = function (event) {
            const passwordModal = document.getElementById('passwordModal');
            const profileModal = document.getElementById('profilePictureModal');

            if (event.target == passwordModal) {
                passwordModal.style.display = 'none';
            }
            if (event.target == profileModal) {
                profileModal.style.display = 'none';
            }
        }
            < script >
            function toggleDropdown() {
                const dropdown = document.getElementById('userDropdown');
                dropdown.classList.toggle('show');
            }

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
            window.location.href = '/dashboard';
        }

        function openPasswordModal() {
            document.getElementById('passwordModal').style.display = 'block';
            // Close dropdown if open
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.remove('show');
        }
        <script>
            window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
                window.location.reload();
        }
    });
    </script>

    </script>
    </script>
</body>

</html>