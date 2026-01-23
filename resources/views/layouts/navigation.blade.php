<style>
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
</style>

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