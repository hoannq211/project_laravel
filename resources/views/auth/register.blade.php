<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
        }

        .register-container {
            margin-top: 3rem;
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

        .btn-register {
            background-color: #4e73df;
            color: white;
            border: none;
            width: 100%;
            padding: 0.75rem;
        }

        .btn-register:hover {
            background-color: #224abe;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .terms-check {
            color: #5a5c69;
        }

        .terms-check input {
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

        .password-strength {
            height: 5px;
            margin-top: 5px;
            background-color: #e3e6f0;
            border-radius: 3px;
        }

        .password-strength-bar {
            height: 100%;
            border-radius: 3px;
            width: 0%;
            transition: width 0.3s;
        }

        .invalid-feedback {
            display: none;
            color: #e74a3b;
        }

        .is-invalid~.invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Tạo tài khoản mới</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Nhập tên người dùng" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Nhập email của bạn" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Nhập mật khẩu">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="confirm-password" class="form-label">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Nhập lại mật khẩu">
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                                    name="terms" {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label terms-check" for="terms">Tôi đồng ý với <a
                                        href="#" class="footer-link">điều khoản và điều kiện</a></label>
                                @error('terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-register btn-primary mb-3">Đăng ký</button>
                        </form>

                    </div>
                    <div class="card-footer text-center py-3">
                        <span>Đã có tài khoản? </span>
                        <a href="{{ route('login') }}" class="footer-link">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
