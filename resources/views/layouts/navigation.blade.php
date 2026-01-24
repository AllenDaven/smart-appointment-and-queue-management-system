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
        white-space: nowrap;
    }

    .hamburger-menu {
        display: none;
        flex-direction: column;
        cursor: pointer;
        gap: 0.4rem;
    }

    .hamburger-menu span {
        width: 25px;
        height: 3px;
        background-color: #3b82f6;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .hamburger-menu.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .hamburger-menu.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger-menu.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
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

    /* Mobile Menu Styles */
    .mobile-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1rem 2rem;
        flex-direction: column;
        gap: 0.5rem;
        animation: slideDown 0.3s ease-out;
    }

    .mobile-menu.active {
        display: flex;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mobile-menu .nav-link {
        padding: 0.75rem 0.5rem;
        width: 100%;
        border-radius: 0.5rem;
    }

    .mobile-menu .user-info {
        padding: 1rem 0.5rem;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 0.5rem;
    }

    .mobile-menu .logout-btn {
        width: 100%;
        margin-top: 0.5rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        nav {
            padding: 1rem;
        }

        .nav-container {
            flex-wrap: wrap;
        }

        .nav-left {
            gap: 1rem;
            width: 100%;
            justify-content: space-between;
        }

        .hamburger-menu {
            display: flex;
        }

        .nav-links {
            display: none;
        }

        .nav-right {
            display: none;
        }

        .mobile-menu {
            position: static;
            box-shadow: none;
            border: none;
            width: 100%;
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .logo {
            font-size: 1.25rem;
        }

        .user-info {
            font-size: 0.85rem;
        }

        .logout-btn {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 480px) {
        nav {
            padding: 0.75rem 1rem;
        }

        .logo {
            font-size: 1.1rem;
        }

        .hamburger-menu span {
            width: 22px;
            height: 2.5px;
        }

        .user-info {
            font-size: 0.8rem;
        }
    }
</style>

 <nav>
    <div class="nav-container">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="logo">QueueSmart</a>
            <button class="hamburger-menu" id="hamburgerMenu" aria-label="Toggle navigation menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        
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

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="user-info">
            Welcome, {{ Auth::user()->name }}
        </div>
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
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<script>
    document.getElementById('hamburgerMenu').addEventListener('click', function() {
        this.classList.toggle('active');
        document.getElementById('mobileMenu').classList.toggle('active');
    });

    // Close menu when a link is clicked
    document.querySelectorAll('.mobile-menu .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('hamburgerMenu').classList.remove('active');
            document.getElementById('mobileMenu').classList.remove('active');
        });
    });
</script>