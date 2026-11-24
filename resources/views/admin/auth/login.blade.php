
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Gentala Coffe</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            overflow: hidden;
        }

        /* HALAMAN LOGIN */

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            background: #503e36;
        }

        .left-section {
            position: relative;
            width: 57%;
            min-height: 100vh;
            background: #fff;
            overflow: hidden;
            border-radius: 0 0 48% 0 / 0 0 48% 0;
        }

        .brand {
            position: absolute;
            top: 35px;
            left: 40px;
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 5;
        }

        .brand-logo {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #24170f;
            border: 5px double #c4a77d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: Georgia, serif;
            font-size: 24px;
        }

        .brand-name {
            font-family: Georgia, serif;
            font-size: 46px;
            font-weight: bold;
            color: #503e36;
        }

        /* ILUSTRASI */

        .coffee-art {
            position: absolute;
            width: 540px;
            height: 430px;
            left: 12%;
            top: 27%;
        }

        .bean-shape {
            position: absolute;
            width: 500px;
            height: 390px;
            background: #aaa29f;
            border-radius: 40% 35% 48% 30% / 45% 35% 40% 45%;
            transform: rotate(-18deg);
        }

        .bean-inner {
            position: absolute;
            width: 245px;
            height: 170px;
            left: 125px;
            top: 170px;
            background: #75645d;
            border-radius: 45% 30% 40% 45%;
            transform: rotate(12deg);
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: #aaa29f;
        }

        .bubble.one {
            width: 85px;
            height: 85px;
            top: -35px;
            left: 170px;
        }

        .bubble.two {
            width: 40px;
            height: 40px;
            top: 35px;
            left: 75px;
        }

        .bubble.three {
            width: 80px;
            height: 80px;
            top: 145px;
            left: -30px;
        }

        .bubble.four {
            width: 28px;
            height: 28px;
            top: 180px;
            right: -5px;
        }

        .bubble.five {
            width: 52px;
            height: 52px;
            bottom: -10px;
            right: 20px;
        }

        .bubble.six {
            width: 42px;
            height: 42px;
            bottom: -65px;
            left: 320px;
        }

        /* FORM LOGIN */

        .right-section {
            flex: 1;
            min-height: 100vh;
            background: #503e36;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-form {
            width: 100%;
            max-width: 380px;
            color: #fff;
        }

        .login-title {
            font-size: 40px;
            text-align: center;
            margin-bottom: 44px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .input-box {
            height: 58px;
            width: 100%;
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #171717;
            border-radius: 35px;
            padding: 0 20px;
            box-shadow: 0 5px 18px rgba(0,0,0,.2);
        }

        .input-box svg {
            width: 25px;
            height: 25px;
            fill: #686868;
            flex-shrink: 0;
        }

        .input-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            padding-left: 22px;
            font-size: 16px;
            color: #333;
        }

        .input-box input::placeholder {
            color: #929292;
        }

        .login-button {
            display: block;
            width: 125px;
            height: 43px;
            margin: 42px auto 0;
            border: none;
            border-radius: 8px;
            background: #fff;
            color: #555;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-button:hover {
            background: #eaeaea;
        }

        /* PESAN */

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-error {
            background: #ffe0e0;
            color: #a00000;
        }

        .alert-success {
            background: #e0ffe5;
            color: #176b2c;
        }

        /* POP-UP MFA */

        .mfa-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
            padding: 20px;
        }

        .mfa-overlay.active {
            display: flex;
        }

        .mfa-modal {
            width: 100%;
            max-width: 590px;
            min-height: 490px;
            background: #fff;
            border-radius: 12px;
            padding: 26px;
            color: #000;
        }

        .mfa-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mfa-header h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .mfa-close {
            border: none;
            background: transparent;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .mfa-description {
            text-align: center;
            font-size: 20px;
            line-height: 1.25;
            margin-top: 42px;
            margin-bottom: 26px;
        }

        .otp-container {
            display: flex;
            justify-content: center;
            gap: 14px;
        }

        .otp-input {
            width: 55px;
            height: 55px;
            border: 1px solid #000;
            border-radius: 6px;
            background: #f5f5f5;
            text-align: center;
            font-size: 23px;
            font-weight: bold;
            outline: none;
        }

        .otp-input:focus {
            border: 2px solid #503e36;
            background: #fff;
        }

        .mfa-actions {
            margin-top: 55px;
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .mfa-next,
        .mfa-back {
            width: 100%;
            height: 45px;
            border-radius: 15px;
            font-size: 19px;
            font-weight: bold;
            cursor: pointer;
        }

        .mfa-next {
            background: #503e36;
            color: #fff;
            border: none;
        }

        .mfa-back {
            background: #fff;
            color: #000;
            border: 1px solid #000;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {
            body {
                overflow: auto;
            }

            .login-container {
                flex-direction: column;
            }

            .left-section {
                width: 100%;
                min-height: 220px;
                border-radius: 0 0 45% 0 / 0 0 25% 0;
            }

            .brand {
                top: 25px;
                left: 20px;
            }

            .brand-logo {
                width: 50px;
                height: 50px;
                font-size: 17px;
            }

            .brand-name {
                font-size: 29px;
            }

            .coffee-art {
                display: none;
            }

            .right-section {
                min-height: 550px;
                padding: 35px 25px;
            }

            .login-title {
                font-size: 34px;
            }
        }

        @media (max-width: 480px) {
            .mfa-modal {
                padding: 22px 16px;
                min-height: 420px;
            }

            .otp-container {
                gap: 7px;
            }

            .otp-input {
                width: 43px;
                height: 50px;
            }

            .mfa-description {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <!-- HALAMAN LOGIN ADMIN -->

    <div class="login-container">

        <section class="left-section">

            <div class="brand">
                <div class="brand-logo">G</div>
                <div class="brand-name">Gentala Coffe</div>
            </div>

            <div class="coffee-art">
                <div class="bean-shape"></div>
                <div class="bean-inner"></div>
                <div class="bubble one"></div>
                <div class="bubble two"></div>
                <div class="bubble three"></div>
                <div class="bubble four"></div>
                <div class="bubble five"></div>
                <div class="bubble six"></div>
            </div>

        </section>

        <section class="right-section">

            <div class="login-form">

                <h1 class="login-title">Masuk</h1>

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form
                    action="{{ route('admin.login.submit') }}"
                    method="POST"
                >
                    @csrf

                    <div class="form-group">
                        <label for="nama_pengguna">Nama Pengguna</label>

                        <div class="input-box">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>

                            <input
                                type="text"
                                id="nama_pengguna"
                                name="nama_pengguna"
                                placeholder="Nama Pengguna"
                                value="{{ old('nama_pengguna') }}"
                                autocomplete="username"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kata_sandi">Kata Sandi</label>

                        <div class="input-box">
                            <svg viewBox="0 0 24 24">
                                <path d="M18 8h-1V6a5 5 0 0 0-10 0v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6a3 3 0 0 1 6 0v2H9V6zm3 11a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                            </svg>

                            <input
                                type="password"
                                id="kata_sandi"
                                name="kata_sandi"
                                placeholder="Kata Sandi"
                                autocomplete="current-password"
                                required
                            >
                        </div>
                    </div>

                    <button type="submit" class="login-button">
                        Masuk
                    </button>

                </form>

            </div>

        </section>

    </div>

    <!-- POP-UP MFA -->

    <div
        class="mfa-overlay {{ session('show_mfa') ? 'active' : '' }}"
        id="mfaOverlay"
    >

        <div class="mfa-modal">

            <div class="mfa-header">
                <h2>Verifikasi Akun</h2>

                <button
                    type="button"
                    class="mfa-close"
                    onclick="tutupMFA()"
                >
                    &times;
                </button>
            </div>

            <p class="mfa-description">
                Masukkan 6 digit kode dari<br>
                email kamu
            </p>

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form
                action="{{ route('admin.mfa.verify') }}"
                method="POST"
                id="otpForm"
            >
                @csrf

                <input
                    type="hidden"
                    name="otp"
                    id="otpValue"
                >

                <div class="otp-container">

                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric" autocomplete="one-time-code">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" inputmode="numeric">

                </div>

                <div class="mfa-actions">

                    <button
                        type="submit"
                        class="mfa-next"
                    >
                        Selanjutnya
                    </button>

                    <button
                        type="button"
                        class="mfa-back"
                        onclick="tutupMFA()"
                    >
                        Kembali
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- JAVASCRIPT OTP -->

    <script>

        const otpInputs = document.querySelectorAll('.otp-input');

        // Membuka pop-up dan fokus ke kotak pertama
        function bukaMFA() {
            document.getElementById('mfaOverlay').classList.add('active');
            otpInputs[0].focus();
        }

        // Menutup pop-up
        function tutupMFA() {
            document.getElementById('mfaOverlay').classList.remove('active');
        }

        // Perpindahan otomatis antar kotak OTP
        otpInputs.forEach((input, index) => {

            input.addEventListener('input', function () {

                this.value = this.value
                    .replace(/[^0-9]/g, '')
                    .slice(0, 1);

                if (this.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

            });

            input.addEventListener('keydown', function (event) {

                if (
                    event.key === 'Backspace' &&
                    !this.value &&
                    index > 0
                ) {
                    otpInputs[index - 1].focus();
                }

                if (event.key === 'ArrowLeft' && index > 0) {
                    otpInputs[index - 1].focus();
                }

                if (
                    event.key === 'ArrowRight' &&
                    index < otpInputs.length - 1
                ) {
                    otpInputs[index + 1].focus();
                }

            });

            // Paste enam digit OTP
            input.addEventListener('paste', function (event) {

                event.preventDefault();

                const pasted = event.clipboardData
                    .getData('text')
                    .replace(/[^0-9]/g, '')
                    .slice(0, 6);

                pasted.split('').forEach((digit, i) => {
                    if (otpInputs[i]) {
                        otpInputs[i].value = digit;
                    }
                });

                const nextIndex = Math.min(pasted.length, 5);
                otpInputs[nextIndex].focus();

            });

        });

        // Menggabungkan enam kotak menjadi satu nilai OTP
        document.getElementById('otpForm').addEventListener('submit', function(event) {

            const kode = Array.from(otpInputs)
                .map(input => input.value)
                .join('');

            document.getElementById('otpValue').value = kode;

            if (kode.length !== 6) {
                event.preventDefault();
                alert('Silakan masukkan 6 digit kode OTP.');
            }

        });

        // Fokus otomatis ketika pop-up muncul
        @if(session('show_mfa'))
            window.addEventListener('load', function() {
                otpInputs[0].focus();
            });
        @endif

    </script>

</body>
</html>
