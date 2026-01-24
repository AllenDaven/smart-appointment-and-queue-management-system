<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QueueSmart - Smart Appointment & Queue Management System</title>
        <link rel="icon" type="image/png" href="{{ asset('images/queue_logo.png') }}">
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
                scroll-behavior: smooth;
            }

            /* ===== HERO SECTION ===== */
            .hero-section {
                position: relative;
                min-height: 100vh;
                width: 100%;
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.75) 0%, rgba(79, 70, 229, 0.75) 100%), 
                            url('/images/BGImage.png') center/cover;
                background-attachment: fixed;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                color: white;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(79, 70, 229, 0.15) 0%, transparent 50%);
                pointer-events: none;
                z-index: 1;
            }

            /* ===== NAVIGATION ===== */
            nav {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.97);
                backdrop-filter: blur(10px);
                padding: 1rem 2rem;
                z-index: 999;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .nav-container {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .logo {
                font-size: 1.75rem;
                font-weight: 800;
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-decoration: none;
                letter-spacing: -0.5px;
            }

            .nav-links {
                display: flex;
                gap: 1.5rem;
                align-items: center;
                list-style: none;
            }

            .nav-link {
                padding: 0.75rem 1.25rem;
                text-decoration: none;
                color: #374151;
                font-weight: 500;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                border-radius: 0.5rem;
            }

            .nav-link:hover {
                color: #3b82f6;
                background: #f0f9ff;
            }

            .nav-link-primary {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: white;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            }

            .nav-link-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            }

            /* ===== HERO CONTENT ===== */
            .hero-content {
                position: relative;
                z-index: 10;
                text-align: center;
                padding: 2rem;
                margin-top: 60px;
                max-width: 900px;
                animation: slideUp 0.8s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .hero-title {
                font-size: 4.5rem;
                font-weight: 800;
                margin-bottom: 1.5rem;
                text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                line-height: 1.1;
                letter-spacing: -1px;
            }

            .hero-subtitle {
                font-size: 1.35rem;
                margin-bottom: 2.5rem;
                opacity: 0.95;
                max-width: 700px;
                margin-left: auto;
                margin-right: auto;
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                font-weight: 300;
                line-height: 1.6;
            }

            .hero-buttons {
                display: flex;
                gap: 1.5rem;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 2.5rem;
            }

            .btn {
                padding: 1rem 2.5rem;
                font-size: 1rem;
                font-weight: 600;
                border: none;
                border-radius: 0.75rem;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            .btn-primary {
                background: white;
                color: #3b82f6;
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
                background: #f0f9ff;
            }

            .btn-secondary {
                background: transparent;
                color: white;
                border: 2.5px solid white;
            }

            .btn-secondary:hover {
                background: white;
                color: #3b82f6;
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
            }

            /* ===== FEATURES SECTION ===== */
            .features-section {
                padding: 5rem 2rem;
                background: linear-gradient(to bottom, #ffffff 0%, #f9fafb 100%);
                margin-top: -3rem;
                position: relative;
                z-index: 20;
            }

            .section-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .section-title {
                font-size: 3rem;
                font-weight: 800;
                color: #1f2937;
                margin-bottom: 1rem;
                letter-spacing: -0.5px;
            }

            .section-subtitle {
                font-size: 1.1rem;
                color: #6b7280;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            .feature-card {
                background: white;
                padding: 2.5rem;
                border-radius: 1.5rem;
                border: 1.5px solid #e5e7eb;
                transition: all 0.4s ease;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
                border-color: #3b82f6;
            }

            .feature-icon {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                border-radius: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                color: white;
                font-size: 2rem;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            }

            .feature-card:nth-child(2) .feature-icon {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            }

            .feature-card:nth-child(3) .feature-icon {
                background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
                box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
            }

            .feature-title {
                font-size: 1.35rem;
                font-weight: 700;
                margin-bottom: 1rem;
                color: #1f2937;
            }

            .feature-description {
                color: #6b7280;
                line-height: 1.7;
                font-weight: 400;
            }

            /* ===== HOW IT WORKS SECTION ===== */
            .how-section {
                padding: 5rem 2rem;
                background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%);
            }

            .steps-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2.5rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            .step-card {
                text-align: center;
                transition: all 0.3s ease;
            }

            .step-card:hover {
                transform: translateY(-8px);
            }

            .step-number {
                width: 90px;
                height: 90px;
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: white;
                font-size: 2.5rem;
                font-weight: 800;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
            }

            .step-card:nth-child(2) .step-number {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
            }

            .step-card:nth-child(3) .step-number {
                background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
                box-shadow: 0 4px 20px rgba(139, 92, 246, 0.4);
            }

            .step-card:nth-child(4) .step-number {
                background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
                box-shadow: 0 4px 20px rgba(236, 72, 153, 0.4);
            }

            .step-title {
                font-size: 1.35rem;
                font-weight: 700;
                margin-bottom: 1rem;
                color: #1f2937;
            }

            .step-description {
                color: #6b7280;
                line-height: 1.7;
            }

            /* ===== FOOTER ===== */
            footer {
                background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
                color: white;
                padding: 4rem 2rem 2rem;
            }

            .footer-content {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
                margin-bottom: 2rem;
            }

            .footer-section h5 {
                font-size: 1.25rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }

            .footer-section p {
                color: #d1d5db;
                line-height: 1.8;
            }

            .footer-section ul {
                list-style: none;
            }

            .footer-section li {
                margin-bottom: 0.75rem;
            }

            .footer-section a {
                color: #d1d5db;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .footer-section a:hover {
                color: #3b82f6;
            }

            .footer-bottom {
                border-top: 1px solid #374151;
                padding-top: 2rem;
                text-align: center;
                color: #9ca3af;
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 1024px) {
                .hero-title {
                    font-size: 3.5rem;
                }

                .hero-subtitle {
                    font-size: 1.15rem;
                }

                .section-title {
                    font-size: 2.5rem;
                }
            }

            @media (max-width: 768px) {
                nav {
                    padding: 0.75rem 1rem;
                }

                .nav-container {
                    justify-content: space-between;
                }

                .nav-links {
                    gap: 0.75rem;
                }

                .nav-link {
                    padding: 0.5rem 0.75rem;
                    font-size: 0.85rem;
                }

                .hero-section {
                    margin-top: 60px;
                }

                .hero-content {
                    margin-top: 20px;
                    padding: 1rem;
                }

                .hero-title {
                    font-size: 2.5rem;
                    margin-bottom: 1rem;
                }

                .hero-subtitle {
                    font-size: 1rem;
                    margin-bottom: 1.5rem;
                }

                .hero-buttons {
                    flex-direction: column;
                    gap: 1rem;
                }

                .btn {
                    width: 100%;
                    padding: 0.875rem 2rem;
                }

                .section-title {
                    font-size: 2rem;
                }

                .section-subtitle {
                    font-size: 1rem;
                }

                .features-section {
                    padding: 3rem 1rem;
                }

                .how-section {
                    padding: 3rem 1rem;
                }

                .feature-card {
                    padding: 1.5rem;
                }

                .features-grid {
                    gap: 1.5rem;
                }

                .steps-grid {
                    gap: 1.5rem;
                }

                .step-number {
                    width: 70px;
                    height: 70px;
                    font-size: 2rem;
                }

                .logo {
                    font-size: 1.35rem;
                }
            }

            @media (max-width: 480px) {
                .hero-title {
                    font-size: 1.75rem;
                }

                .hero-subtitle {
                    font-size: 0.9rem;
                }

                .section-title {
                    font-size: 1.5rem;
                }

                .section-header {
                    margin-bottom: 2rem;
                }

                .feature-card {
                    padding: 1.25rem;
                }

                .feature-title {
                    font-size: 1.1rem;
                }

                .step-title {
                    font-size: 1.1rem;
                }

                .nav-link-primary {
                    font-size: 0.8rem;
                    padding: 0.5rem 1rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav>
            <div class="nav-container">
                <a href="#" class="logo">QueueSmart</a>
                <ul class="nav-links">
                    @auth
                        <li><a href="{{ url('/dashboard') }}" class="nav-link nav-link-primary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="nav-link">Log In</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="nav-link nav-link-primary">Register</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Smart Appointment & Queue Management</h1>
                <p class="hero-subtitle">Streamline your scheduling with our intelligent system. Book appointments, track queues, and manage your time efficiently.</p>
                <div class="hero-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="section-header">
                <h2 class="section-title">Key Features</h2>
                <p class="section-subtitle">Everything you need to manage appointments efficiently</p>
            </div>

            <div class="features-grid">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3 class="feature-title">Easy Scheduling</h3>
                    <p class="feature-description">Book appointments instantly with our intuitive calendar interface. Choose your preferred date and time with just a few clicks.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="feature-icon">⏱️</div>
                    <h3 class="feature-title">Real-time Queue Tracking</h3>
                    <p class="feature-description">Monitor your position in the queue in real-time. Get notified when your turn is approaching.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <h3 class="feature-title">Appointment Approval</h3>
                    <p class="feature-description">Administrators can efficiently review and approve appointments with detailed insights and reporting.</p>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-section">
            <div class="section-header">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle">Simple steps to manage your appointments</p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Create Account</h3>
                    <p class="step-description">Sign up for free and get instant access to the system</p>
                </div>

                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Book Appointment</h3>
                    <p class="step-description">Choose your preferred date and time slot</p>
                </div>

                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Get Confirmed</h3>
                    <p class="step-description">Receive approval and queue number</p>
                </div>

                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Track Status</h3>
                    <p class="step-description">Monitor your appointment in real-time</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h5>QueueSmart</h5>
                    <p>Smart appointment and queue management system for efficient scheduling and better user experience.</p>
                </div>
                <div class="footer-section">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5>Contact</h5>
                    <p>Email: support@queuesmart.com</p>
                    <p style="margin-top: 0.5rem;">Phone: +1 (555) 123-4567</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} QueueSmart. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
