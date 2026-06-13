<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Entrar — Eduarda Cardoso Estética</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:    #C4748C;
            --primary-dk: #8B4F6F;
            --primary-lt: #F2D1D8;
            --dark:       #2C1820;
            --text:       #3D2B32;
            --text-light: #7A6068;
            --border:     #EEDAD8;
            --body-bg:    #FDFAFA;
            --radius:     14px;
            --font-head:  'Playfair Display', Georgia, serif;
            --font-body:  'Lato', system-ui, sans-serif;
        }

        html { -webkit-tap-highlight-color: transparent; }

        body {
            font-family: var(--font-body);
            background: var(--body-bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem env(safe-area-inset-right, 1.5rem) 1.5rem env(safe-area-inset-left, 1.5rem);
            background-image:
                radial-gradient(circle at 15% 15%, rgba(196,116,140,.10) 0%, transparent 55%),
                radial-gradient(circle at 85% 85%, rgba(139,79,111,.07) 0%, transparent 55%);
        }

        .login-wrap { width: 100%; max-width: 400px; }

        /* ── Brand ── */
        .login-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-brand-icon {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, var(--primary-lt), var(--primary));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            color: #fff;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(196,116,140,.35);
        }
        .login-brand h1 {
            font-family: var(--font-head);
            font-size: 1.55rem;
            color: var(--dark);
            line-height: 1.2;
        }
        .login-brand p {
            font-size: .78rem;
            color: var(--text-light);
            margin-top: .35rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        /* ── Card ── */
        .login-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            padding: 2rem;
            box-shadow: 0 12px 40px rgba(196,116,140,.13);
        }

        /* ── Error ── */
        .alert-error {
            background: #fff5f5;
            border: 1px solid #fca5a5;
            color: #c62828;
            border-radius: 8px;
            padding: .75rem 1rem;
            font-size: .85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        /* ── Fields ── */
        .field { margin-bottom: 1.1rem; }
        .field label {
            display: block;
            font-size: .82rem;
            font-weight: 700;
            color: var(--primary-dk);
            margin-bottom: .4rem;
            letter-spacing: .03em;
        }
        .field-icon-wrap { position: relative; }
        .field-icon {
            position: absolute;
            left: .9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #c8a8b5;
            font-size: .88rem;
            pointer-events: none;
        }
        .field input {
            width: 100%;
            padding: .78rem 1rem .78rem 2.6rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-family: var(--font-body);
            font-size: 1rem;
            color: var(--text);
            background: #fdfafa;
            transition: border-color .2s, box-shadow .2s;
            -webkit-appearance: none;
        }
        .field input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(196,116,140,.15);
        }

        /* ── Submit ── */
        .btn-login {
            width: 100%;
            padding: .9rem;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: var(--font-head);
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .03em;
            transition: background .2s, transform .1s;
            margin-top: .25rem;
            touch-action: manipulation;
        }
        .btn-login:hover  { background: var(--primary-dk); }
        .btn-login:active { transform: scale(.98); }

        /* ── Back link ── */
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .back-link a {
            color: var(--text-light);
            font-size: .82rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            transition: color .15s;
        }
        .back-link a:hover { color: var(--primary); }
    </style>
</head>
<body>
    <div class="login-wrap">

        <div class="login-brand">
            <div class="login-brand-icon">
                <i class="fas fa-spa"></i>
            </div>
            <h1>Eduarda Cardoso</h1>
            <p>Painel Administrativo</p>
        </div>

        <div class="login-card">
            @if($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="field">
                    <label for="usuario">Usuário</label>
                    <div class="field-icon-wrap">
                        <i class="fas fa-user field-icon"></i>
                        <input type="text" id="usuario" name="usuario"
                               value="{{ old('usuario') }}"
                               autocomplete="username"
                               autofocus>
                    </div>
                </div>

                <div class="field">
                    <label for="senha">Senha</label>
                    <div class="field-icon-wrap">
                        <i class="fas fa-lock field-icon"></i>
                        <input type="password" id="senha" name="senha"
                               autocomplete="current-password">
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    Entrar
                </button>
            </form>
        </div>

        <div class="back-link">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left"></i> Voltar ao site
            </a>
        </div>

    </div>
</body>
</html>
