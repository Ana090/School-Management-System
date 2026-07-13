<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - تصميم Bootstrap</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: row-reverse; /* Reverse to match original image: Image left, Form right */
        }
        .login-illustration {
            background-color: #fff;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }
        .login-illustration img {
            max-width: 100%;
            height: auto;
        }
        .login-form-section {
            padding: 60px 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-title {
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }
        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            background-color: #f9f9f9;
        }
        .input-group-text {
            background: transparent;
            border: none;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #888;
        }
        .input-group {
            position: relative;
        }
        .input-group .form-control {
            padding-left: 45px;
        }
        .btn-login {
            background-color: #4a90e2;
            border: none;
            border-radius: 25px;
            padding: 12px;
            color: white;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .btn-login:hover {
            background-color: #357abd;
        }
        .forgot-password {
            text-align: left;
            display: block;
            font-size: 0.85rem;
            color: #4a90e2;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
        .signup-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: bold;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 20px;
            }
            .login-illustration {
                display: none; /* Hide illustration on small screens like the original style often does */
            }
        }
    </style>
</head>
<body>

    <div class="login-container" dir="ltr">
        <!-- Form Section -->
        <div class="login-form-section">
            <h2 class="login-title">Login</h2>
            
            <form>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                </div>

                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password">
                </div>

                <a href="#" class="forgot-password">Forgot Password?</a>

                <button type="submit" class="btn btn-login">Login</button>

                <div class="signup-link">
                    Don't have an account? <a href="#">Create your account</a>
                </div>
            </form>
        </div>

        <!-- Illustration Section -->
        <div class="login-illustration">
            <img src="{{ asset('asset/img/illustration.jpg') }}" alt="Login Illustration">
        </div>
 
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
