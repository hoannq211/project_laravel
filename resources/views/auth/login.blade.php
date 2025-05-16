<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
        }

        .login-container {
            margin-top: 5rem;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: #4e73df;
            color: white;
            border-radius: 1rem 1rem 0 0 !important;
            padding: 1.5rem;
            text-align: center;
        }

        .btn-login {
            background-color: #4e73df;
            color: white;
            border: none;
            width: 100%;
            padding: 0.75rem;
        }

        .btn-login:hover {
            background-color: #224abe;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .remember-me {
            color: #5a5c69;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .footer-link {
            color: #4e73df;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #224abe;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Đăng nhập hệ thống</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Nhập mật khẩu">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label remember-me" for="remember">Ghi nhớ đăng nhập</label>
                            </div>

                            <button type="submit" class="btn btn-login btn-primary mb-3">Đăng nhập</button>

                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="footer-link">Quên mật khẩu?</a>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer text-center py-3">
                        <span>Chưa có tài khoản? </span>
                        <a href="{{ route('register') }}" class="footer-link">Tạo tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
