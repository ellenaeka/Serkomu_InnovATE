<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - SerKoMu</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef3ff, #f8faff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 410px;
        }

        .brand {
            text-align: center;
            margin-bottom: 22px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: #ffffff;
            color: #4565b4;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 30px;
            font-weight: bold;
            box-shadow: 0 4px 14px rgba(45, 68, 120, 0.12);
        }

        .brand h1 {
            font-size: 21px;
            font-weight: 800;
            color: #304579;
            margin-bottom: 2px;
        }

        .brand small {
            color: #8290ac;
            font-size: 10px;
            letter-spacing: 1px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px 24px;
            box-shadow: 0 8px 30px rgba(48, 69, 121, 0.10);
        }

        .login-title {
            color: #25365f;
            font-size: 21px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 6px;
        }

        .login-subtitle {
            color: #8490a7;
            font-size: 13px;
            text-align: center;
            margin-bottom: 26px;
        }

        .form-label {
            color: #34466f;
            font-size: 12px;
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #e3e8f2;
            background: #f9faff;
            border-radius: 10px;
            padding: 12px;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: #4565b4;
            box-shadow: 0 0 0 3px rgba(69, 101, 180, 0.10);
        }

        .forgot-link {
            display: block;
            text-align: right;
            font-size: 11px;
            color: #4565b4;
            text-decoration: none;
            margin-top: 9px;
        }

        .btn-login {
            width: 100%;
            background: #304579;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 24px;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #243660;
            color: #ffffff;
        }

        .emergency {
            margin-top: 24px;
            text-align: center;
        }

        .emergency a {
            display: inline-block;
            border: 1px solid #f3d8d8;
            background: #fff8f8;
            color: #b54c4c;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 30px;
            font-size: 11px;
        }

        .staff-link {
            text-align: center;
            margin-top: 17px;
            font-size: 11px;
            color: #8993a8;
        }

        .staff-link a {
            color: #4565b4;
            font-weight: 600;
            text-decoration: none;
        }

        .footer-text {
            text-align: center;
            color: #a1a9ba;
            font-size: 10px;
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            body {
                padding: 18px;
            }

            .login-card {
                padding: 25px 20px;
            }

            .brand h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- Logo dan identitas aplikasi -->
        <div class="brand">
            <div class="brand-icon">+</div>
            <h1>serkomu.</h1>
            <small>STUDENT HEALTH ASSISTANCE</small>
        </div>

        <!-- Form Login -->
        <div class="login-card">

            <h2 class="login-title">Selamat datang!</h2>

            <p class="login-subtitle">
                Masuk ke akun mahasiswa
            </p>

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email Mahasiswa
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="nama@student.telkomuniversity.ac.id"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="form-label">
                        Kata Sandi
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan kata sandi"
                        autocomplete="current-password"
                        required
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Pesan kesalahan login -->
                @if ($errors->has('email') && !$errors->has('password'))
                    <div class="alert alert-danger mt-3 mb-0"
                         style="font-size: 12px;">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <!-- Lupa password -->
                <a href="#" class="forgot-link">
                    Lupa kata sandi?
                </a>

                <!-- Tombol login -->
                <button type="submit" class="btn btn-login">
                    Masuk
                </button>

            </form>

        </div>

        <!-- Bantuan darurat -->
        <div class="emergency">
            <a href="#">
                ☎ Darurat? Telepon Bantuan Tanpa Login
            </a>
        </div>

        <!-- Login petugas -->
        <div class="staff-link">
            Masuk sebagai Petugas?
            <a href="#">Login Petugas</a>
        </div>

        <div class="footer-text">
            SerKoMu © 2026 — Student Health Assistance
        </div>

    </div>

</body>
</html>
v