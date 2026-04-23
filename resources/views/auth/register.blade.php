<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - BookHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f0f2f5;
            --panel: #ffffff;
            --border: #d1d5db;
            --text: #111827;
            --muted: #475569;
            --accent: #14b87a;
            --accent-dark: #0d9d6a;
            --accent-light: #e6f7f0;
            --error: #dc2626;
            --success: #16a34a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: var(--bg);
        }

        h1, h2, h3 {
            font-family: 'Space Grotesk', sans-serif;
        }

        .page-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-card {
            width: 100%;
            max-width: 420px;
            padding: 26px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        }

        .form-top h2 {
            font-size: 24px;
            margin-bottom: 6px;
            color: var(--text);
        }

        .form-top p {
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .input-shell {
            position: relative;
        }

        .input-shell svg {
            position: absolute;
            left: 14px;
            top: 50%;
            width: 16px;
            height: 16px;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .form-input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #ffffff;
            color: var(--text);
            padding: 14px 16px 14px 44px;
            font: inherit;
            font-size: 14px;
            transition: border-color 0.18s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .form-input:focus {
            border-color: #93c5fd;
        }

        .form-input.error {
            border-color: var(--error);
            background: #fef2f2;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            padding: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password svg {
            width: 18px;
            height: 18px;
        }

        .error-text {
            margin-top: 8px;
            font-size: 12px;
            color: var(--error);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .error-text svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
        }

        .password-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .submit-btn {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 14px;
            background: var(--accent);
            color: white;
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.18s ease;
        }

        .submit-btn:hover {
            opacity: 0.96;
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .submit-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-inner svg {
            width: 16px;
            height: 16px;
        }

        .form-footer {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 13px;
        }

        .form-footer a {
            color: var(--accent);
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .form-alert {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
            border: 1px solid transparent;
        }

        .form-alert.success {
            background: #ecfdf5;
            border-color: #bbf7d0;
            color: #166534;
        }

        .form-alert.error {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .form-alert svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .page-shell {
                padding: 16px;
            }

            .password-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <div class="form-card">
            <div class="form-top">
                <h2>Buat akun peminjam</h2>
                <p>Isi data di bawah untuk membuat akun baru. Setelah selesai, kamu bisa masuk langsung.</p>
            </div>

            @if (session('success'))
                <div class="form-alert success">
                    <svg viewBox="0 0 24 24">
                        <path d="m5 12 5 5L20 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="form-alert error">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 9v4"></path>
                        <path d="M12 17h.01"></path>
                        <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"></path>
                    </svg>
                    Periksa kembali data yang kamu isi. Masih ada kolom yang belum valid.
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="name">Nama Lengkap</label>
                    <div class="input-shell">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21a8 8 0 0 0-16 0"></path>
                            <circle cx="12" cy="8" r="5"></circle>
                        </svg>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-input @error('name') error @enderror"
                            placeholder="Contoh: Fajar Ramadhan"
                            required
                            autofocus
                            autocomplete="name">
                    </div>
                    @error('name')
                        <div class="error-text">
                            <svg viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-8-4a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V7a1 1 0 0 0-1-1Zm0 8a1.25 1.25 0 1 0 0-2.5A1.25 1.25 0 0 0 10 14Z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="email">Alamat Email</label>
                    <div class="input-shell">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 6h16v12H4z"></path>
                            <path d="m4 7 8 6 8-6"></path>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input @error('email') error @enderror"
                            placeholder="nama@email.com"
                            required
                            autocomplete="email">
                    </div>
                    @error('email')
                        <div class="error-text">
                            <svg viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-8-4a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V7a1 1 0 0 0-1-1Zm0 8a1.25 1.25 0 1 0 0-2.5A1.25 1.25 0 0 0 10 14Z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="password-grid">
                    <div class="field-group">
                        <label class="field-label" for="password">Password</label>
                        <div class="input-shell">
                            <svg viewBox="0 0 24 24">
                                <rect x="4" y="11" width="16" height="9" rx="2"></rect>
                                <path d="M8 11V8a4 4 0 1 1 8 0v3"></path>
                            </svg>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input @error('password') error @enderror"
                                placeholder="Minimal 8 karakter"
                                required
                                autocomplete="new-password">
                            <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                                <svg viewBox="0 0 24 24" class="eye-open">
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg viewBox="0 0 24 24" class="eye-off" style="display:none;">
                                    <path d="m3 3 18 18"></path>
                                    <path d="M10.6 10.7A3 3 0 0 0 13.4 13.5"></path>
                                    <path d="M9.9 5.2A10.6 10.6 0 0 1 12 5c6.4 0 10 7 10 7a17.6 17.6 0 0 1-4 4.9"></path>
                                    <path d="M6.6 6.7C3.9 8.5 2 12 2 12a18.7 18.7 0 0 0 10 7 10.8 10.8 0 0 0 4.1-.8"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-text">
                                <svg viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-8-4a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V7a1 1 0 0 0-1-1Zm0 8a1.25 1.25 0 1 0 0-2.5A1.25 1.25 0 0 0 10 14Z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-shell">
                            <svg viewBox="0 0 24 24">
                                <path d="m9 12 2 2 4-4"></path>
                                <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                            </svg>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-input"
                                placeholder="Ulangi password"
                                required
                                autocomplete="new-password">
                            <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Tampilkan konfirmasi password">
                                <svg viewBox="0 0 24 24" class="eye-open">
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg viewBox="0 0 24 24" class="eye-off" style="display:none;">
                                    <path d="m3 3 18 18"></path>
                                    <path d="M10.6 10.7A3 3 0 0 0 13.4 13.5"></path>
                                    <path d="M9.9 5.2A10.6 10.6 0 0 1 12 5c6.4 0 10 7 10 7a17.6 17.6 0 0 1-4 4.9"></path>
                                    <path d="M6.6 6.7C3.9 8.5 2 12 2 12a18.7 18.7 0 0 0 10 7 10.8 10.8 0 0 0 4.1-.8"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span class="submit-inner" id="submitText">
                        <svg viewBox="0 0 24 24">
                            <path d="M5 12h14"></path>
                            <path d="m13 5 7 7-7 7"></path>
                        </svg>
                        Daftar Sekarang
                    </span>
                    <span class="submit-inner" id="submitLoading" style="display:none;">
                        <svg viewBox="0 0 24 24" class="animate-spin">
                            <circle cx="12" cy="12" r="9" opacity="0.3"></circle>
                            <path d="M21 12a9 9 0 0 0-9-9"></path>
                        </svg>
                        Menyiapkan akun...
                    </span>
                </button>
            </form>

            <div class="form-footer">
                <span>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></span>
                <a href="{{ url('/') }}">Kembali ke beranda</a>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach((button) => {
            button.addEventListener('click', () => {
                const target = document.getElementById(button.dataset.target);
                const eyeOpen = button.querySelector('.eye-open');
                const eyeOff = button.querySelector('.eye-off');
                const isPassword = target.type === 'password';

                target.type = isPassword ? 'text' : 'password';
                eyeOpen.style.display = isPassword ? 'none' : 'block';
                eyeOff.style.display = isPassword ? 'block' : 'none';
            });
        });

        document.getElementById('registerForm').addEventListener('submit', function () {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            document.getElementById('submitText').style.display = 'none';
            document.getElementById('submitLoading').style.display = 'flex';
        });
    </script>
</body>
</html>
