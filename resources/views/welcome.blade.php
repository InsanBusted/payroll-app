<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT Mila Media Telekomunikasi — Sistem HR & Payroll</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&family=syne:600,700,800" rel="stylesheet" />

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy: #0b1f3a;
            --navy-2: #112748;
            --navy-3: #1a3560;
            --blue: #1d6fb8;
            --blue-2: #2e87d8;
            --sky: #5db0ef;
            --accent: #e84c27;
            --accent-2: #f2704f;
            --gold: #f0a500;
            --white: #ffffff;
            --off: #f4f7fb;
            --muted: #8fa3bc;
            --border: rgba(255, 255, 255, 0.10);
            --font: 'Plus Jakarta Sans', system-ui, sans-serif;
            --display: 'Syne', system-ui, sans-serif;
        }

        html,
        body {
            height: 100%;
            font-family: var(--font);
            background: var(--navy);
            color: var(--white);
            overflow-x: hidden;
        }

        /* ── BACKGROUND ── */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .bg-gradient {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 70% 20%, rgba(29, 111, 184, 0.25) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 10% 80%, rgba(232, 76, 39, 0.12) 0%, transparent 55%),
                linear-gradient(160deg, #0b1f3a 0%, #0d2444 40%, #091929 100%);
        }

        /* geometric grid lines */
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.028) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.028) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 90% 90% at 60% 40%, black 10%, transparent 75%);
        }

        .bg-orb-1 {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(46, 135, 216, 0.18) 0%, transparent 65%);
            top: -150px;
            right: -100px;
            animation: pulse-orb 8s ease-in-out infinite;
        }

        .bg-orb-2 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(232, 76, 39, 0.10) 0%, transparent 65%);
            bottom: -80px;
            left: 30%;
            animation: pulse-orb 11s ease-in-out infinite reverse;
        }

        /* floating signal rings */
        .ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(93, 176, 239, 0.12);
            animation: ring-expand 6s ease-out infinite;
        }

        .ring-1 {
            width: 320px;
            height: 320px;
            top: 8%;
            right: 12%;
            animation-delay: 0s;
        }

        .ring-2 {
            width: 520px;
            height: 520px;
            top: 4%;
            right: 8%;
            animation-delay: 1.5s;
        }

        .ring-3 {
            width: 720px;
            height: 720px;
            top: 0%;
            right: 4%;
            animation-delay: 3s;
        }

        @keyframes ring-expand {
            0% {
                opacity: 0.6;
                transform: scale(0.92);
            }

            50% {
                opacity: 0.15;
                transform: scale(1);
            }

            100% {
                opacity: 0.6;
                transform: scale(0.92);
            }
        }

        @keyframes pulse-orb {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.7;
                transform: scale(1.08);
            }
        }

        /* ── LAYOUT ── */
        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 480px;
        }

        /* ── LEFT PANEL ── */
        .left {
            display: flex;
            flex-direction: column;
            padding: 44px 56px;
        }

        .logo-row {
            display: flex;
            align-items: center;
            gap: 14px;
            animation: fade-up 0.6s ease both;
        }

        .logo-mark {
            width: 46px;
            height: 46px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .logo-mark::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, transparent 60%);
            border-radius: 12px;
        }

        .logo-mark svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: white;
            stroke-width: 2;
            position: relative;
            z-index: 1;
        }

        .logo-text {
            line-height: 1.2;
        }

        .logo-text strong {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.01em;
        }

        .logo-text span {
            font-size: 11px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 500;
        }

        .left-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-bottom: 60px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(93, 176, 239, 0.1);
            border: 1px solid rgba(93, 176, 239, 0.2);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--sky);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 24px;
            width: fit-content;
            animation: fade-up 0.6s 0.1s ease both;
        }

        .eyebrow-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--sky);
            animation: blink 2s ease infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .headline {
            font-family: var(--display);
            font-size: clamp(36px, 4vw, 52px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.03em;
            color: white;
            margin-bottom: 20px;
            animation: fade-up 0.6s 0.2s ease both;
        }

        .headline em {
            font-style: normal;
            color: transparent;
            -webkit-text-stroke: 1.5px rgba(93, 176, 239, 0.7);
        }

        .headline .accent-word {
            position: relative;
            display: inline-block;
        }

        .headline .accent-word::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        .desc {
            font-size: 15.5px;
            color: var(--muted);
            line-height: 1.75;
            max-width: 420px;
            margin-bottom: 40px;
            animation: fade-up 0.6s 0.3s ease both;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            animation: fade-up 0.6s 0.4s ease both;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.75);
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon svg {
            width: 15px;
            height: 15px;
            stroke: var(--sky);
            fill: none;
            stroke-width: 1.8;
        }

        .left-footer {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.3);
            animation: fade-up 0.6s 0.5s ease both;
        }

        /* ── RIGHT PANEL (LOGIN CARD) ── */
        .right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 44px 48px;
            animation: fade-up 0.7s 0.2s ease both;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 20px;
            padding: 40px 36px;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            position: relative;
            overflow: hidden;
        }

        /* top accent line */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(93, 176, 239, 0.5), transparent);
        }

        .card-header {
            margin-bottom: 32px;
        }

        .card-title {
            font-family: var(--display);
            font-size: 22px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .card-sub {
            font-size: 13.5px;
            color: var(--muted);
        }

        /* Error alert */
        @if (session('status')) .alert-success {
            background: rgba(26, 128, 80, 0.15);
            border: 1px solid rgba(26, 128, 80, 0.3);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            color: #6de4a8;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        @endif .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            stroke: var(--muted);
            fill: none;
            stroke-width: 1.8;
            pointer-events: none;
            transition: stroke 0.2s;
        }

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            padding: 12px 14px 12px 42px;
            font-family: var(--font);
            font-size: 14px;
            color: white;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .form-input:focus {
            border-color: rgba(93, 176, 239, 0.5);
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 0 3px rgba(93, 176, 239, 0.1);
        }

        .form-input:focus+.input-focus-ring {
            opacity: 1;
        }

        .form-input.is-error {
            border-color: rgba(232, 76, 39, 0.5);
        }

        .error-msg {
            font-size: 12px;
            color: #f97060;
            margin-top: 6px;
        }

        /* Password toggle */
        .pwd-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            color: var(--muted);
            display: flex;
            align-items: center;
        }

        .pwd-toggle svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
        }

        .pwd-toggle:hover {
            color: var(--sky);
        }

        /* Remember + forgot */
        .form-extras {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-row input[type="checkbox"] {
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            background: transparent;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }

        .checkbox-row input[type="checkbox"]:checked {
            background: var(--blue);
            border-color: var(--blue);
        }

        .checkbox-row input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 4px;
            width: 5px;
            height: 8px;
            border: 1.5px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .checkbox-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
        }

        .forgot-link {
            font-size: 13px;
            color: var(--sky);
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: white;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: var(--blue);
            border: none;
            border-radius: 10px;
            font-family: var(--font);
            font-size: 14.5px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.2s;
            letter-spacing: 0.01em;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, transparent 60%);
            border-radius: 10px;
            pointer-events: none;
        }

        .btn-login:hover {
            background: var(--blue-2);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(29, 111, 184, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.08);
        }

        .divider-text {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.25);
            white-space: nowrap;
        }

        .help-text {
            text-align: center;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.35);
            line-height: 1.6;
        }

        .help-text a {
            color: var(--sky);
            text-decoration: none;
        }

        .help-text a:hover {
            text-decoration: underline;
        }

        /* ── ANIMATIONS ── */
        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .page {
                grid-template-columns: 1fr;
                grid-template-rows: auto 1fr;
            }

            .left {
                padding: 32px 28px 20px;
            }

            .left-body {
                padding-bottom: 24px;
            }

            .headline {
                font-size: 32px;
            }

            .feature-list {
                display: none;
            }

            .right {
                padding: 24px 20px 44px;
            }
        }
    </style>
</head>

<body>

    <!-- Background -->
    <div class="bg-scene">
        <div class="bg-gradient"></div>
        <div class="bg-grid"></div>
        <div class="bg-orb-1"></div>
        <div class="bg-orb-2"></div>
        <div class="ring ring-1"></div>
        <div class="ring ring-2"></div>
        <div class="ring ring-3"></div>
    </div>

    <div class="page">

        <!-- ── LEFT ── -->
        <div class="left">
            <!-- Logo -->
            <div class="logo-row">
                <div class="logo-mark">
                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 20 Q4 4 12 4 Q20 4 20 12 Q20 20 12 20" />
                        <circle cx="12" cy="12" r="2.5" fill="white" stroke="none" />
                        <path d="M8 16 Q8 8 12 8 Q16 8 16 12" />
                    </svg>
                </div>
                <div class="logo-text">
                    <strong>PT Mila Media Telekomunikasi</strong>
                    <span>Sistem Payroll</span>
                </div>
            </div>

            <!-- Main Copy -->
            <div class="left-body">
                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Sistem Terintegrasi
                </div>

                <h1 class="headline">
                    Kelola Gaji<br>
                    dengan<br>
                    <em>Lebih Akurat</em>
                </h1>

                <p class="desc">
                    Platform terpadu untuk manajemen penggajian — dirancang khusus untuk kebutuhan
                    PT Mila Media Telekomunikasi.
                </p>

            </div>

            <div class="left-footer">
                &copy; {{ date('Y') }} PT Mila Media Telekomunikasi. Hak cipta dilindungi.
            </div>
        </div>

        <!-- ── RIGHT (LOGIN FORM) ── -->
        <div class="right">
            <div class="login-card">
                <div class="card-header">
                    <div class="card-title">Masuk ke Akun</div>
                    <div class="card-sub">Gunakan kredensial yang diberikan admin</div>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                <div class="alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label" for="email">Email / NIP</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                            <input
                                class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@milamedia.id"
                                autocomplete="username"
                                autofocus
                                required>
                        </div>
                        @error('email')
                        <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label class="form-label" for="password">Kata Sandi</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0110 0v4" />
                            </svg>
                            <input
                                class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                required>
                            <button type="button" class="pwd-toggle" id="togglePwd" aria-label="Tampilkan kata sandi">
                                <svg id="eyeIcon" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember + Forgot --}}
                    <div class="form-extras">
                        <label class="checkbox-row">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="checkbox-label">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa sandi?</a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-login">
                        Masuk ke Sistem
                    </button>
                </form>

                <div class="divider">
                    <div class="divider-line"></div>
                    <div class="divider-text">Butuh bantuan?</div>
                    <div class="divider-line"></div>
                </div>

                <div class="help-text">
                    Hubungi tim IT di <a href="mailto:it@milamedia.id">it@milamedia.id</a><br>
                    atau telepon ext. <strong style="color:rgba(255,255,255,0.5);">101</strong>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Password toggle
        const pwd = document.getElementById('password');
        const btn = document.getElementById('togglePwd');
        const eyeIcon = document.getElementById('eyeIcon');

        const eyeOpen = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        const eyeClose = `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;

        btn.addEventListener('click', () => {
            const show = pwd.type === 'password';
            pwd.type = show ? 'text' : 'password';
            eyeIcon.innerHTML = show ? eyeClose : eyeOpen;
        });

        // Input focus — sync icon color
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', () => {
                const icon = input.closest('.input-wrap').querySelector('.input-icon');
                if (icon) icon.style.stroke = 'rgba(93,176,239,0.7)';
            });
            input.addEventListener('blur', () => {
                const icon = input.closest('.input-wrap').querySelector('.input-icon');
                if (icon) icon.style.stroke = '';
            });
        });
    </script>
</body>

</html>