<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - Admin</title>
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

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-unread {
            background: #e74c3c;
            color: white;
        }

        .badge-read {
            background: #27ae60;
            color: white;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-success {
            background: #27ae60;
            color: white;
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
                <a href="/admin/contacts" class="active">
                    <i class="fas fa-envelope"></i>
                    <span>Contact Messages</span>
                </a>
                <a href="/admin/users">
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
                <h1><i class="fas fa-envelope"></i> Contact Messages</h1>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer;">Logout</button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ Str::limit($contact->message, 50) }}</td>
                            <td>
                                <span class="badge {{ $contact->is_read ? 'badge-read' : 'badge-unread' }}">
                                    {{ $contact->is_read ? 'Read' : 'Unread' }}
                                </span>
                            </td>
                            <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                @if(!$contact->is_read)
                                <form action="/admin/contacts/{{ $contact->id }}/read" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn-sm btn-success">Mark Read</button>
                                </form>
                                @endif
                                <form action="/admin/contacts/{{ $contact->id }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Delete this message?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No contact messages yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="pagination">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>