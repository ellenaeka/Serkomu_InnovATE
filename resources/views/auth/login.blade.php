<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - SerKoMu</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
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
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }

        a:focus-visible, button:focus-visible, input:focus-visible {
            outline: 3px solid rgba(66, 100, 181, .45);
            outline-offset: 2px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 26px;
            border: 1px solid #e8ecf6;
            padding: 30px 26px;
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
            color: #5f6b85;
            font-size: 14px;
            text-align: center;
            margin-bottom: 26px;
        }

        .form-label {
            color: #34466f;
            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            border: 1px solid #e3e8f2;
            background: #f9faff;
            border-radius: 14px;
            padding: 12px 14px;
            min-height: 46px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #4565b4;
            box-shadow: 0 0 0 3px rgba(69, 101, 180, 0.10);
        }

        .forgot-link {
            display: block;
            width: fit-content;
            margin-left: auto;
            padding: 12px 0 4px;
            font-size: 13px;
            color: #4565b4;
            text-decoration: none;
            margin-top: 0;
        }

        .btn-login {
            width: 100%;
            background: #304579;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 12px;
            min-height: 48px;
            font-size: 15px;
            font-weight: 700;
            margin-top: 22px;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 44px;
            border: 1px solid #f1d4d0;
            background: #fff8f7;
            color: #a33d31;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            transition: background .2s;
        }

        .emergency a:hover {
            background: #fbefed;
        }

        .staff-link {
            text-align: center;
            margin-top: 17px;
            font-size: 13px;
            color: #5f6b85;
        }

        .staff-link a {
            color: #4565b4;
            font-weight: 600;
            text-decoration: none;
        }

        .footer-text {
            text-align: center;
            color: #6b7690;
            font-size: 12px;
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            body {
                padding: 18px;
            }

            .login-card {
                padding: 25px 20px;
            }

        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- Logo dan identitas aplikasi -->
        <div class="brand">
            <x-brand-logo size="lg" align="center" subtitle="Student Health Assistance" />
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

                {{-- Tombol login --}}
                <button type="submit" class="btn btn-login">
                    Masuk
                </button>

            

            {{-- Link Registrasi --}}
            <p style="text-align: center; margin-top: 18px; margin-bottom: 0; font-size: 14px; color: #5f6b85;">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   style="color: #4565b4; font-weight: 700; text-decoration: none;">
                    Daftar sekarang
                </a>
            </p>

            </form>

        </div>

        <!-- Bantuan darurat -->
        <div class="emergency">
            <a href="{{ route('kontak-darurat') }}">
                <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                Darurat? Telepon Bantuan Tanpa Login
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