    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Admin Panel</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            * {
                font-family: 'Inter', sans-serif;
            }

            body {
                min-height: 100vh;
                background: #f1f5f9; /* خلفية مريحة */
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .login-card {
                width: 100%;
                max-width: 420px;
                background: #ffffff;
                border-radius: 18px;
                box-shadow: 0 15px 40px rgba(0,0,0,0.08);
                overflow: hidden;
            }

            .login-card::before {
                content: '';
                display: block;
                height: 5px;
                background: linear-gradient(90deg, #6366f1, #3b82f6);
            }

            .login-header {
                padding: 30px;
                text-align: center;
            }

            .logo {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                margin-bottom: 8px;
            }

            .logo-icon {
                width: 44px;
                height: 44px;
                background: #6366f1;
                color: #fff;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
            }

            .logo-text {
                font-size: 22px;
                font-weight: 700;
                color: #1e293b;
            }

            .subtitle {
                font-size: 14px;
                color: #64748b;
            }

            .login-body {
                padding: 30px;
            }

            .form-group {
                margin-bottom: 22px;
            }

            .form-label {
                display: block;
                margin-bottom: 6px;
                font-size: 14px;
                font-weight: 600;
                color: #334155;
            }

            .input-wrapper {
                position: relative;
            }

            .input-wrapper i {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
            }

            .form-control {
                width: 100%;
                padding: 14px 14px 14px 42px;
                border-radius: 10px;
                border: 1px solid #cbd5e1;
                font-size: 15px;
                color: #1e293b;
                transition: all .2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99,102,241,.15);
            }

            .input-error {
                margin-top: 5px;
                font-size: 13px;
                color: #ef4444;
            }

            .remember-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 25px;
            }

            .remember-me {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                color: #334155;
            }

            .remember-me input {
                accent-color: #6366f1;
            }

            .forgot {
                font-size: 14px;
                color: #6366f1;
                text-decoration: none;
            }

            .forgot:hover {
                text-decoration: underline;
            }

            .login-btn {
                width: 100%;
                padding: 14px;
                background: #6366f1;
                color: #fff;
                border: none;
                border-radius: 10px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: background .2s ease;
            }

            .login-btn:hover {
                background: #4f46e5;
            }

            .alert {
                padding: 14px;
                border-radius: 10px;
                margin-bottom: 20px;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .alert-success {
                background: #ecfdf5;
                color: #047857;
            }

            .alert-error {
                background: #fef2f2;
                color: #b91c1c;
            }

            .footer {
                text-align: center;
                font-size: 13px;
                color: #94a3b8;
                padding-bottom: 20px;
            }
        </style>
    </head>
    <body>

    <div class="login-card">
        <div class="login-header">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="logo-text">Admin Panel</div>
            </div>
            <div class="subtitle">Sign in to continue</div>
        </div>

        <div class="login-body">

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <input type="hidden" name="role" value="admin">

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                    <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    @error('password')
                    <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">
                    Log in
                </button>
            </form>

        </div>

        <div class="footer">
            © {{ date('Y') }} Admin Panel
        </div>
    </div>

    </body>
    </html>
