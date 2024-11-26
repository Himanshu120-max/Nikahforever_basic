<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NikahForever</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <h3>Welcome back</h3>
                <p class="text-muted">Let's find your soulmate.</p>
            </div>
            <form method="POST" action="login/submit">
                <!-- Email Field -->
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter Email*" required>
                </div>
                <!-- Password Field -->
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                    <button type="button" class="btn btn-sm position-absolute end-0 top-50 translate-middle-y" onclick="togglePasswordVisibility()" style="background: none; border: none;">
                        <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                    </button>
                </div>
                <!-- Forgot Password -->
                <!-- <div class="mb-3 text-end">
                    <a href="" class="text-danger text-decoration-none">Forgot Password?</a>
                </div> -->
                <!-- Login Button -->
                <button type="submit" class="btn btn-danger w-100 mb-3">Login</button>
            </form>
            <!-- Register Now -->
            <div class="text-center">
                <p class="mb-0">New to NikahForever? <a href="register" class="text-danger text-decoration-none">Register Now</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.querySelector('[name="password"]');
            const icon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</body>
</html>
