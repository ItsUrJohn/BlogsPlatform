<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team Member - Admin</title>
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

        .sidebar-nav a:hover {
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
        }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .current-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .checkbox-label input {
            width: auto;
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
                <a href="/admin/team">Team Members</a>
                <a href="/dashboard">Back to Site</a>
            </div>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <h1><i class="fas fa-user-edit"></i> Edit Team Member</h1>
            </div>

            <div class="form-container">
                <form action="/admin/team/{{ $member->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @if($member->avatar)
                        <div class="form-group">
                            <label>Current Avatar</label><br>
                            <img src="{{ $member->avatar_url }}" class="current-avatar" alt="{{ $member->name }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" value="{{ $member->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Role *</label>
                        <input type="text" name="role" value="{{ $member->role }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description">{{ $member->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Profile Picture (leave empty to keep current)</label>
                        <input type="file" name="avatar" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Display Order</label>
                        <input type="number" name="order" value="{{ $member->order }}">
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_active" {{ $member->is_active ? 'checked' : '' }}> Active (show on website)
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Member</button>
                    <a href="/admin/team" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>