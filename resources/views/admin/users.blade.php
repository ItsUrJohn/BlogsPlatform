<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            height: 100vh;
        }

        .sidebar-header {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(255,255,255,0.1);
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
        }

        .top-bar {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-avatar i {
            font-size: 24px;
            color: white;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #e74c3c;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-blog"></i>
                <h2>Admin Panel</h2>
            </div>
            <div class="sidebar-nav">
                <a href="/admin/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/contacts">
                    <i class="fas fa-envelope"></i>
                    <span>Contact Messages</span>
                </a>
                <a href="/admin/users" class="active">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="/dashboard">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Site</span>
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <h1><i class="fas fa-users"></i> Manage Users</h1>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer;">Logout</button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Posts</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="user-avatar">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}">
                                    @else
                                        <i class="fas fa-user-circle"></i>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->posts()->count() }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($user->email !== 'admin@blogplatform.com')
                                <form action="/admin/users/{{ $user->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Delete user {{ $user->name }}? This will also delete all their posts.')">Delete</button>
                                </form>
                                @else
                                    <span style="color: #27ae60;">Admin</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>