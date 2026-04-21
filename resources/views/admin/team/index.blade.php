<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team - Admin</title>
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

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
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

        .team-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .badge-active {
            background: #27ae60;
            color: white;
        }

        .badge-inactive {
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
                <a href="/admin/dashboard">Dashboard</a>
                <a href="/admin/contacts">Contact Messages</a>
                <a href="/admin/users">Users</a>
                <a href="/admin/team" class="active">Team Members</a>
                <a href="/dashboard">Back to Site</a>
            </div>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <h1><i class="fas fa-users"></i> Team Members</h1>
                <a href="/admin/team/create" class="btn btn-primary">+ Add New Member</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-container">
                 <table>
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                        <tr>
                            <td>
                                <img src="{{ $member->avatar_url }}" class="team-avatar" alt="{{ $member->name }}">
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->role }}</td>
                            <td>{{ Str::limit($member->description, 50) }}</td>
                            <td>
                                <span class="badge {{ $member->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $member->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $member->order }}</td>
                            <td>
                                <a href="/admin/team/{{ $member->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                <a href="/admin/team/{{ $member->id }}/toggle" class="btn btn-sm" style="background: #f39c12; color: white;">Toggle</a>
                                <form action="/admin/team/{{ $member->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this member?')">Delete</button>
                                </form>
                             </td>
                         </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No team members yet. Add your first member!</td>
                         </tr>
                        @endforelse
                    </tbody>
                 </table>
            </div>
        </div>
    </div>
</body>
</html>