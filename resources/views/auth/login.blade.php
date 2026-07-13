<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نظام إدارة المدرسة</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#0d6efd,#0a58ca);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family: Tahoma, sans-serif;
        }

        .login-card{
            width:100%;
            max-width:450px;
            border:none;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
            overflow:hidden;
        }

        .login-header{
            background:#0d6efd;
            color:white;
            text-align:center;
            padding:25px;
        }

        .school-icon{
            font-size:60px;
        }

        .btn-login{
            background:#0d6efd;
            color:white;
            font-weight:bold;
        }

        .btn-login:hover{
            background:#0b5ed7;
            color:white;
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="login-header">
        <div class="school-icon">🏫</div>
        <h3>نظام إدارة المدرسة</h3>
        <p class="mb-0">تسجيل الدخول إلى لوحة التحكم</p>
    </div>

    <div class="card-body p-4">

        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       required
                       autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input"
                       type="checkbox"
                       name="remember"
                       id="remember">
                <label class="form-check-label" for="remember">
                    تذكرني
                </label>
            </div>

            <button type="submit" class="btn btn-login w-100">
                تسجيل الدخول
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}"
                       class="text-decoration-none">
                        نسيت كلمة المرور؟
                    </a>
                </div>
            @endif
        </form>

    </div>
</div>

</body>
</html>