<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/queue_logo.png') }}">
    <title>Create Account - QueueSmart</title>
    
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
                        url('/images/BGImage3.png') center/cover;
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
            max-width: 500px;
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
            padding: 1.5rem 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 1.25rem;
        }

        .auth-logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.6rem;
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            font-size: 0.85rem;
            color: #6b7280;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 0.9rem;
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
            padding: 0.65rem 0.85rem;
            font-size: 0.95rem;
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

        .submit-btn {
            width: 100%;
            padding: 0.65rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            margin-top: 0.5rem;
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
            margin-top: 1rem;
            font-size: 0.9rem;
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
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-content">
            <div class="auth-card">
                <div class="auth-header">
                    <div class="auth-logo">QueueSmart</div>
                    <h1 class="auth-title">Create Account</h1>
                    <p class="auth-subtitle">Join QueueSmart and manage your appointments with ease</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        @if ($errors->has('name'))
                            <div class="error-message">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        @if ($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                        @if ($errors->has('password'))
                            <div class="error-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                        @if ($errors->has('password_confirmation'))
                            <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">Create Account</button>

                    <div class="auth-footer">
                        Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
