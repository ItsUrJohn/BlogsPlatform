<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BlogPlatform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 22px;
        }

        .sidebar-header i {
            font-size: 40px;
            margin-bottom: 10px;
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
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }

        /* Main Content */
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-info h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-info .number {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .stat-icon i {
            font-size: 48px;
            color: #667eea;
        }

        .growth {
            font-size: 12px;
            margin-top: 5px;
        }

        .growth.positive {
            color: #27ae60;
        }

        .growth.negative {
            color: #e74c3c;
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .chart-container h3 {
            margin-bottom: 20px;
            color: #333;
        }

        .chart-wrapper {
            max-width: 100%;
            height: 300px;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            overflow-x: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
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

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header h2,
            .sidebar-nav a span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
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
                <a href="/admin/users">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="/admin/team">
                    <i class="fas fa-user-friends"></i>
                    <span>Team Members</span>
                </a>
                <a href="/dashboard">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Site</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-bar">
                <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Total Users</h3>
                        <div class="number">{{ $totalUsers }}</div>
                        <div class="growth positive">
                            <i class="fas fa-arrow-up"></i> {{ $userGrowth }}% from last month
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>New Users (This Month)</h3>
                        <div class="number">{{ $usersThisMonth }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Contact Messages</h3>
                        <div class="number">{{ $totalContacts }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>Unread Messages</h3>
                        <div class="number">{{ $unreadContacts }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                </div>
            </div>

            <!-- User Registration Chart -->
            <div class="chart-container">
                <h3><i class="fas fa-chart-line"></i> User Registration Trend (Last 6 Months)</h3>
                <div class="chart-wrapper">
                    <canvas id="userChart"></canvas>
                </div>
            </div>

            <!-- Recent Contacts -->
            <div class="table-container">
                <h3><i class="fas fa-clock"></i> Recent Contact Messages</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentContacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ Str::limit($contact->message, 50) }}</td>
                                <td>
                                    <span class="badge {{ $contact->is_read ? 'badge-read' : 'badge-unread' }}">
                                        {{ $contact->is_read ? 'Read' : 'Unread' }}
                                    </span>
                                </td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="/admin/contacts" class="btn-sm btn-primary">View All</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center;">No contact messages yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Recent Users -->
            <div class="table-container" style="margin-top: 20px;">
                <h3><i class="fas fa-user-plus"></i> Recent User Registrations</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined Date</th>
                            <th>Posts</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>{{ $user->posts()->count() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center;">No users yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // User Registration Chart
        const ctx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($userChartData, 'month')) !!},
                datasets: [{
                    label: 'New Users',
                    data: {!! json_encode(array_column($userChartData, 'count')) !!},
                    backgroundColor: 'rgba(102, 126, 234, 0.2)',
                    borderColor: '#667eea',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
        <script>
            window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
                window.location.reload();
        }
    });
    </script>
    </script>
</body>

</html>