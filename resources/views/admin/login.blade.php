<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - Toko UMKM Pro</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, #dbeafe, transparent 35%),
                radial-gradient(circle at bottom right, #fef3c7, transparent 35%),
                #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            margin: auto;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            background: linear-gradient(135deg, #1769ff, #4f8cff);
            color: white;
            box-shadow: 0 15px 35px rgba(23,105,255,.25);
        }

        .brand h1 {
            margin-top: 15px;
            font-size: 27px;
            color: #101828;
        }

        .brand p {
            margin-top: 7px;
            color: #667085;
        }

        .card {
            background: rgba(255,255,255,.97);
            border: 1px solid #e5e7eb;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 25px 70px rgba(16,24,40,.10);
        }

        .card h2 {
            font-size: 22px;
            color: #101828;
            margin-bottom: 7px;
        }

        .subtitle {
            color: #667085;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .alert {
            padding: 13px 15px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .success {
            background: #ecfdf3;
            color: #027a48;
        }

        .error {
            background: #fef3f2;
            color: #b42318;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #344054;
            margin-bottom: 8px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #d0d5dd;
            border-radius: 13px;
            outline: none;
            font-size: 15px;
            background: white;
            transition: .2s;
        }

        input:focus {
            border-color: #1769ff;
            box-shadow: 0 0 0 4px rgba(23,105,255,.10);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 5px 0 22px;
            color: #667085;
            font-size: 14px;
        }

        .remember input {
            width: 16px;
            height: 16px;
        }

        .btn {
            width: 100%;
            border: none;
            border-radius: 14px;
            padding: 15px;
            background: linear-gradient(135deg, #1769ff, #4f8cff);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 12px 25px rgba(23,105,255,.20);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #98a2b3;
            font-size: 13px;
        }

        @media(max-width:480px) {
            .card {
                padding: 23px;
                border-radius: 21px;
            }

            .brand h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="brand">
        <div class="brand-icon">🛍️</div>

        <h1>Toko UMKM Pro</h1>

        <p>Panel Administrator</p>
    </div>

    <div class="card">

        <h2>Selamat datang 👋</h2>

        <p class="subtitle">
            Masuk untuk mengelola toko kamu.
        </p>

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">

            @csrf

            <div class="field">
                <label>Email Admin</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@tokoumkmpro.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="field">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <label class="remember">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                Ingat saya
            </label>

            <button type="submit" class="btn">
                🔐 Masuk ke Dashboard
            </button>

        </form>

    </div>

    <div class="footer">
        © {{ date('Y') }} Toko UMKM Pro
    </div>

</div>

</body>
</html>
