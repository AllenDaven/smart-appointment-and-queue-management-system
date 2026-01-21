<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QueueSmart | Dashboard</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800&family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Vite Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', 'Inter', sans-serif;
            background: #f9fafb;
        }

        /* Navigation */
        nav {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .nav-link {
            padding: 0.6rem 1rem;
            text-decoration: none;
            color: #6b7280;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .nav-link:hover {
            color: #3b82f6;
            background: #f0f9ff;
        }

        .nav-link.active {
            color: #3b82f6;
            background: #eff6ff;
            font-weight: 600;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            font-size: 0.95rem;
            color: #374151;
            font-weight: 500;
        }

        .logout-btn {
            padding: 0.6rem 1.25rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            font-size: 1rem;
            color: #6b7280;
        }

        /* Stats Grid for Admin */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.75rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-icon.yellow {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .stat-icon.red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }

        /* User Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(79, 70, 229, 0.8) 100%), 
                        url('/images/BGImage3.png') center/cover;
            border-radius: 1.5rem;
            padding: 4rem 2rem;
            color: white;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(79, 70, 229, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 10;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .welcome-text {
            font-size: 1.1rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .quick-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 0.85rem 2rem;
            background: white;
            color: #3b82f6;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        .action-btn.secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .action-btn.secondary:hover {
            background: white;
            color: #3b82f6;
        }

        /* Features Grid for User */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            border-color: #3b82f6;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            color: white;
            font-size: 1.75rem;
        }

        .feature-card:nth-child(2) .feature-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .feature-card:nth-child(3) .feature-icon {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #1f2937;
        }

        .feature-description {
            color: #6b7280;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="nav-left">
                <a href="{{ route('dashboard') }}" class="logo">QueueSmart</a>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('appointments.create') }}" class="nav-link {{ request()->routeIs('appointments.create') ? 'active' : '' }}">
                        Book Appointment
                    </a>
                    <a href="{{ route('appointments.index') }}" class="nav-link {{ request()->routeIs('appointments.*') && !request()->routeIs('appointments.create') ? 'active' : '' }}">
                        View Appointments
                    </a>
                    @if(Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
                        <a href="{{ route('admin.appointments.index') }}" class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                            Approve Appointments
                        </a>
                    @endif
                </div>
            </div>
            <div class="nav-right">
                <div class="user-info">
                    Welcome, {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        @if(Auth::user()->role && Auth::user()->role->name === 'admin')
            <!-- ADMIN DASHBOARD -->
            <div class="dashboard-header">
                <h1 class="dashboard-title">Admin Dashboard</h1>
                <p class="dashboard-subtitle">Monitor your appointment system performance</p>
            </div>

            <div class="stats-grid">
                <!-- Total Users -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ \App\Models\User::count() }}</div>
                            <div class="stat-label">Total Users</div>
                        </div>
                        <div class="stat-icon blue">👥</div>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ \App\Models\Appointment::where('status', 'pending')->count() }}</div>
                            <div class="stat-label">Pending Approvals</div>
                        </div>
                        <div class="stat-icon yellow">⏳</div>
                    </div>
                </div>

                <!-- Approved Today -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ \App\Models\Appointment::where('status', 'approved')->whereDate('updated_at', today())->count() }}</div>
                            <div class="stat-label">Approved Today</div>
                        </div>
                        <div class="stat-icon green">✓</div>
                    </div>
                </div>

                <!-- Total Approved -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ \App\Models\Appointment::where('status', 'approved')->count() }}</div>
                            <div class="stat-label">Total Approved</div>
                        </div>
                        <div class="stat-icon green">📊</div>
                    </div>
                </div>

                <!-- Total Rejected -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ \App\Models\Appointment::where('status', 'rejected')->count() }}</div>
                            <div class="stat-label">Total Rejected</div>
                        </div>
                        <div class="stat-icon red">✗</div>
                    </div>
                </div>

                <!-- Total Appointments -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value">{{ \App\Models\Appointment::count() }}</div>
                            <div class="stat-label">Total Appointments</div>
                        </div>
                        <div class="stat-icon blue">📅</div>
                    </div>
                </div>
            </div>

        @else
            <!-- USER DASHBOARD -->
            <div class="welcome-section">
                <div class="welcome-content">
                    <h1 class="welcome-title">Welcome to QueueSmart</h1>
                    <p class="welcome-text">
                        Manage your appointments effortlessly. Book, track, and stay informed about your queue status in real-time.
                    </p>
                    <div class="quick-actions">
                        <a href="{{ route('appointments.create') }}" class="action-btn">Book Appointment</a>
                        <a href="{{ route('appointments.index') }}" class="action-btn secondary">View My Appointments</a>
                    </div>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3 class="feature-title">Easy Booking</h3>
                    <p class="feature-description">
                        Schedule your appointments in just a few clicks. Choose your preferred date and time with our intuitive booking system.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔔</div>
                    <h3 class="feature-title">Real-time Updates</h3>
                    <p class="feature-description">
                        Stay informed with instant notifications about your appointment status, queue position, and any changes.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-title">Track Progress</h3>
                    <p class="feature-description">
                        Monitor all your appointments in one place. View history, upcoming bookings, and manage your schedule effectively.
                    </p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>