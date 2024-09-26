<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Eye Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f2f3f5;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
        }

        .login-image {
            max-width: 100%;
            height: auto;
            margin-right: 20px;
        }

        .form-control {
            border-radius: 5px;
            padding-left: 15px;
        }

        .btn-primary {
            border-radius: 5px;
        }

        .text-muted {
            font-size: 14px;
        }

        .text-danger {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .login-image {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .login-container {
                flex-direction: column;
            }

            .login-box {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid login-container">
        <div class="container col-lg-9 col-md-12 text-center bg-white rounded-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6 d-none d-md-block">
                    <img src="{{ asset('assets/images/6333040.jpg') }}" alt="Login Image" class="login-image">
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login-box">
                        <h4 class="text-center" id="formTitle">Login as User</h4>
                        <div class="login-options text-center d-flex justify-content-center">
                            <button class="btn btn-outline-primary me-2" id="userLoginBtn">User Login</button>
                            <button class="btn btn-outline-primary" id="adminLoginBtn">Admin Login</button>
                        </div>

                        <form class="mt-4" id="userLoginForm" method="POST" action="{{ route('login.user') }}">
                            @csrf
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                            @endif
                            <div class="mb-3">
                                <label for="userEmail" class="form-label fw-medium d-flex">Enter Your Email</label>
                                <input type="email" class="form-control" id="userEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label fw-medium d-flex">Enter Your
                                    Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="userPassword" name="password"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleUserPassword">
                                        <i class="fa-solid fa-eye" id="userEyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                        </form>

                        <form class="mt-4 d-none" id="adminLoginForm" method="POST"
                            action="{{ route('login.admin') }}">
                            @csrf
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                            @endif
                            <div class="mb-3">
                                <label for="adminEmail" class="form-label fw-medium d-flex">Enter Your Email</label>
                                <input type="email" class="form-control" id="adminEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="adminPassword" class="form-label fw-medium d-flex">Enter Your
                                    Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="adminPassword" name="password"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleAdminPassword">
                                        <i class="fa-solid fa-eye" id="adminEyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <span class="text-muted">Don't have an account? <a href="#!">Register</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userLoginBtn = document.getElementById('userLoginBtn');
            const adminLoginBtn = document.getElementById('adminLoginBtn');
            const userLoginForm = document.getElementById('userLoginForm');
            const adminLoginForm = document.getElementById('adminLoginForm');
            const formTitle = document.getElementById('formTitle');

            // User Login
            userLoginBtn.addEventListener('click', function() {
                userLoginForm.classList.remove('d-none');
                adminLoginForm.classList.add('d-none');
                formTitle.textContent = 'Login as User';
                userLoginBtn.classList.remove('btn-outline-primary');
                userLoginBtn.classList.add('btn-primary');
                adminLoginBtn.classList.remove('btn-primary');
                adminLoginBtn.classList.add('btn-outline-primary');
            });

            // Admin Login
            adminLoginBtn.addEventListener('click', function() {
                adminLoginForm.classList.remove('d-none');
                userLoginForm.classList.add('d-none');
                formTitle.textContent = 'Login as Admin';
                adminLoginBtn.classList.remove('btn-outline-primary');
                adminLoginBtn.classList.add('btn-primary');
                userLoginBtn.classList.remove('btn-primary');
                userLoginBtn.classList.add('btn-outline-primary');
            });

            // Toggle User Password Visibility
            const toggleUserPassword = document.getElementById('toggleUserPassword');
            const userEyeIcon = document.getElementById('userEyeIcon');
            toggleUserPassword.addEventListener('click', function() {
                const userPasswordField = document.getElementById('userPassword');
                if (userPasswordField.type === 'password') {
                    userPasswordField.type = 'text';
                    userEyeIcon.classList.remove('fa-eye');
                    userEyeIcon.classList.add('fa-eye-slash');
                } else {
                    userPasswordField.type = 'password';
                    userEyeIcon.classList.remove('fa-eye-slash');
                    userEyeIcon.classList.add('fa-eye');
                }
            });

            // Toggle Admin Password Visibility
            const toggleAdminPassword = document.getElementById('toggleAdminPassword');
            const adminEyeIcon = document.getElementById('adminEyeIcon');
            toggleAdminPassword.addEventListener('click', function() {
                const adminPasswordField = document.getElementById('adminPassword');
                if (adminPasswordField.type === 'password') {
                    adminPasswordField.type = 'text';
                    adminEyeIcon.classList.remove('fa-eye');
                    adminEyeIcon.classList.add('fa-eye-slash');
                } else {
                    adminPasswordField.type = 'password';
                    adminEyeIcon.classList.remove('fa-eye-slash');
                    adminEyeIcon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>

</html>
