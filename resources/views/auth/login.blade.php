<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/login.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <!-- Optional Logo -->
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo-itsm.png') }}" alt="Logo" class="logo-img">
        </div>

        <!-- Glassmorphism Card -->
        <div class="login-card @error('email') error @enderror @error('password') error @enderror">
            <!-- Header -->
            <div class="login-header">
                <h2>Acadex</h2>
                <p>Log in to start your session</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-gray-200">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        <label for="email">Email Address</label>
                    </div>
                    @error('email')
                        <div class="error-message">wrong email</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                        <button type="button" id="passwordToggle" class="password-toggle">
                            <span class="eye-icon"></span>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message">wrong password</div>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="login-btn">
                    Log In
                </button>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const pwInput = document.getElementById('password');
        const toggleBtn = document.getElementById('passwordToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                pwInput.type = pwInput.type === 'password' ? 'text' : 'password';
            });
        }
    </script>
</body>
</html>
