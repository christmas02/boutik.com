<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Boutik17 | Connexion Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{ asset('/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* Background pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(ellipse at 20% 50%, rgba(20,184,166,.12) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(139,92,246,.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* Logo / Brand */
        .login-brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-brand-name {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -1px;
        }
        .login-brand-name em { color: #14b8a6; font-style: normal; }
        .login-brand-sub {
            font-size: 13px;
            color: rgba(255,255,255,.4);
            margin-top: 4px;
        }

        /* Card */
        .login-card {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 20px;
            padding: 36px 32px;
            backdrop-filter: blur(10px);
        }
        .login-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }
        .login-card p {
            font-size: 13px;
            color: rgba(255,255,255,.4);
            margin-bottom: 28px;
        }

        /* Alerts */
        .alert-login-error {
            background: rgba(239,68,68,.12);
            border: 1px solid rgba(239,68,68,.2);
            color: #fca5a5;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13.5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form */
        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,.7);
            margin-bottom: 6px;
        }
        .form-control {
            background: rgba(255,255,255,.06) !important;
            border: 1px solid rgba(255,255,255,.1) !important;
            border-radius: 10px !important;
            color: #fff !important;
            font-size: 14px !important;
            padding: 11px 14px !important;
            transition: border-color .15s;
        }
        .form-control::placeholder { color: rgba(255,255,255,.25) !important; }
        .form-control:focus {
            border-color: #14b8a6 !important;
            box-shadow: 0 0 0 3px rgba(20,184,166,.15) !important;
            background: rgba(255,255,255,.08) !important;
            outline: none !important;
        }

        /* Password toggle */
        .pass-wrapper { position: relative; }
        .pass-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,.35);
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            line-height: 1;
        }
        .pass-toggle:hover { color: rgba(255,255,255,.7); }

        /* Forgot */
        .forgot-link {
            font-size: 12px;
            color: rgba(255,255,255,.4);
            text-decoration: none;
        }
        .forgot-link:hover { color: #14b8a6; }

        /* Submit */
        .btn-login {
            width: 100%;
            background: #14b8a6;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            padding: 12px;
            cursor: pointer;
            transition: background .15s;
            margin-top: 8px;
        }
        .btn-login:hover { background: #0d9488; }
        .btn-login:active { background: #0f766e; }

        .footer-text {
            text-align: center;
            margin-top: 28px;
            font-size: 12px;
            color: rgba(255,255,255,.2);
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Brand -->
    <div class="login-brand">
        <div class="login-brand-name">Boutik<em>17</em></div>
        <div class="login-brand-sub">Espace d'administration</div>
    </div>

    <!-- Card -->
    <div class="login-card">
        <h2>Connexion</h2>
        <p>Entrez vos identifiants pour accéder au tableau de bord.</p>

        @include('backoffice.status')

        <form action="/connexion" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Identifiant (email)</label>
                <input type="text" name="email" class="form-control"
                       placeholder="votre@email.com" autocomplete="username" required>
            </div>

            <div class="mb-1">
                <label class="form-label d-flex justify-content-between">
                    <span>Mot de passe</span>
                    <a href="/mot_de_passe_oublier" class="forgot-link">Mot de passe oublié ?</a>
                </label>
                <div class="pass-wrapper">
                    <input type="password" name="password" class="form-control"
                           placeholder="••••••••" id="password-field" autocomplete="current-password" required>
                    <button type="button" class="pass-toggle" id="toggle-pass">
                        <i class="ri-eye-line" id="eye-icon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="ri-login-box-line me-2"></i> Se connecter
            </button>
        </form>
    </div>

    <div class="footer-text">&copy; {{ date('Y') }} Boutik17 &mdash; Tous droits réservés</div>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    document.getElementById('toggle-pass')?.addEventListener('click', function () {
        const field = document.getElementById('password-field');
        const icon  = document.getElementById('eye-icon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'ri-eye-off-line';
        } else {
            field.type = 'password';
            icon.className = 'ri-eye-line';
        }
    });
</script>
</body>
</html>
