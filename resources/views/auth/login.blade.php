<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/queue_logo.png') }}">
    <title>Sign In - QueueSmart</title>
    
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

        .auth-container {
            position: relative;
            min-height: 100vh;
            width: 100%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(79, 70, 229, 0.8) 100%), 
                        url('/images/BGImage2.png') center/cover;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-container::before {
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
            z-index: 1;
        }

        .auth-content {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 2rem;
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

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            padding: 2rem 1.75rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .auth-logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .auth-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.35rem;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.4rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            border: 2px solid #e5e7eb;
            border-radius: 0.4rem;
            cursor: pointer;
            accent-color: #3b82f6;
        }

        .checkbox-label {
            margin-left: 0.75rem;
            font-size: 0.95rem;
            color: #6b7280;
            cursor: pointer;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            gap: 1rem;
        }

        .forgot-link {
            font-size: 0.9rem;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: #2563eb;
        }

        .submit-btn {
            width: 100%;
            padding: 0.85rem 1.5rem;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.95rem;
            color: #6b7280;
        }

        .auth-footer a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .auth-footer a:hover {
            color: #2563eb;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.4rem;
        }

        .success-message {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-content">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="auth-logo">QueueSmart</div>
                    <h1 class="auth-title">Welcome back</h1>
                    <p class="auth-subtitle">Sign in to manage your appointments and queues</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="success-message" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                        @if ($errors->has('password'))
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="checkbox-group">
                        <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                        <label for="remember_me" class="checkbox-label">Remember me</label>
                    </div>

                    <div class="form-footer">
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">Sign In</button>

                    <div class="auth-footer">
                        Don't have an account? <a href="{{ route('register') }}">Create one now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
