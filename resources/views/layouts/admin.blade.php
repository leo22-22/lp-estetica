<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – Eduarda Cardoso Estética</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand:    #8B4F6F;
            --brand-dk: #6b3353;
            --brand-lt: #f2e0e8;
            --accent:   #C4748C;
            --sidebar:  240px;
            --header:   56px;
        }

        body { font-family: 'Lato', sans-serif; background: #f5f0f2; color: #333; display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar);
            background: var(--brand-dk);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 200;
            transition: transform .25s ease;
        }
        .sidebar-logo {
            padding: 1.4rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-logo span {
            display: block;
            font-size: .78rem;
            color: rgba(255,255,255,.55);
            text-transform: uppercase;
            letter-spacing: .08em;
        }
        .sidebar-logo strong {
            display: block;
            font-size: 1rem;
            color: #fff;
            margin-top: .2rem;
            line-height: 1.3;
        }
        .sidebar-nav {
            flex: 1;
            padding: 1.2rem 0;
            overflow-y: auto;
        }
        .nav-label {
            font-size: .68rem;
            font-weight: 900;
            color: rgba(255,255,255,.35);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: .8rem 1.5rem .3rem;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .7rem 1.5rem;
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 700;
            transition: background .15s, color .15s;
            border-left: 3px solid transparent;
        }
        .sidebar-nav a i { width: 18px; text-align: center; font-size: .95rem; }
        .sidebar-nav a:hover { background: rgba(255,255,255,.08); color: #fff; }
        .sidebar-nav a.active {
            background: rgba(255,255,255,.12);
            color: #fff;
            border-left-color: #f2c0d0;
        }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: rgba(255,255,255,.6);
            text-decoration: none;
            font-size: .85rem;
            transition: color .15s;
        }
        .sidebar-footer a:hover { color: #fff; }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar);
            right: 0;
            height: var(--header);
            background: #fff;
            border-bottom: 1px solid #ede0e6;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
        }
        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--brand);
            cursor: pointer;
        }
        .topbar-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--brand-dk);
        }
        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: .75rem; }
        .topbar-badge {
            background: var(--brand-lt);
            color: var(--brand);
            font-size: .78rem;
            font-weight: 700;
            padding: .25rem .7rem;
            border-radius: 20px;
        }

        /* ── Main ── */
        .main-wrap {
            margin-left: var(--sidebar);
            margin-top: var(--header);
            flex: 1;
            padding: 1.75rem;
            min-width: 0;
        }

        /* ── Flash ── */
        .flash {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .85rem 1.2rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: .9rem;
        }
        .flash-success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
        .flash-error   { background: #fff5f5; border: 1px solid #fca5a5; color: #dc2626; }

        /* ── Cards ── */
        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
            overflow: hidden;
            margin-bottom: 1.75rem;
        }
        .card-head {
            padding: 1rem 1.5rem;
            font-weight: 700;
            font-size: .95rem;
            color: var(--brand-dk);
            border-bottom: 1px solid #f0dde5;
            background: #fdf6f8;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .card-body { padding: 1.5rem; }

        /* ── Stats ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.2rem 1rem;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }
        .stat-card strong { display: block; font-size: 2rem; color: var(--brand); line-height: 1; }
        .stat-card span   { font-size: .8rem; color: #777; margin-top: .25rem; display: block; }

        /* ── Tables ── */
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--brand); color: #fff; }
        th, td { padding: .75rem 1rem; text-align: left; font-size: .88rem; vertical-align: middle; }
        tr:nth-child(even) { background: #fdf6f6; }
        tr:hover { background: #f9eaea; }

        /* ── Badges ── */
        .badge { padding: .2rem .6rem; border-radius: 20px; font-size: .75rem; font-weight: 700; white-space: nowrap; }
        .badge-new  { background: #f2c0d0; color: #6b2040; }
        .badge-ok   { background: #c8e6c9; color: #1b5e20; }
        .badge-off  { background: #ffcdd2; color: #b71c1c; }
        .badge-on   { background: #c8e6c9; color: #1b5e20; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .6rem 1.4rem; border-radius: 8px; border: none;
            font-family: inherit; font-size: .9rem; font-weight: 700;
            cursor: pointer; transition: background .2s;
        }
        .btn-primary   { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--brand); }
        .btn-sm        { padding: .3rem .7rem; font-size: .8rem; border-radius: 6px; border: none; font-weight: 700; cursor: pointer; transition: .2s; display: inline-flex; align-items: center; gap: .3rem; font-family: inherit; }
        .btn-edit      { background: #fff3e0; color: #e65100; }
        .btn-edit:hover{ background: #e65100; color: #fff; }
        .btn-del       { background: #fce4ec; color: #c62828; }
        .btn-del:hover { background: #c62828; color: #fff; }
        .btn-ok        { background: #c8e6c9; color: #1b5e20; }
        .btn-ok:hover  { background: #1b5e20; color: #fff; }
        .btn-cancel    { background: #eee; color: #555; border: none; padding: .6rem 1.2rem; border-radius: 8px; cursor: pointer; font-family: inherit; font-weight: 700; font-size: .9rem; }
        .btn-cancel:hover { background: #ddd; }

        /* ── Forms ── */
        .form-grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-grid3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
        .form-group { display: flex; flex-direction: column; gap: .35rem; }
        .form-group label { font-size: .82rem; font-weight: 700; color: var(--brand-dk); }
        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: .65rem .9rem; border: 2px solid #f0dde5; border-radius: 8px;
            font-family: inherit; font-size: .9rem; color: #333; transition: .2s;
            background: #fdfafa;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus { outline: none; border-color: var(--accent); }
        .form-group textarea { resize: vertical; min-height: 80px; }
        .form-hint { font-size: .75rem; color: #999; margin-top: .2rem; }

        /* ── Toggle switch ── */
        .toggle-row { display: flex; align-items: center; gap: .75rem; }
        .toggle { position: relative; width: 44px; height: 24px; flex-shrink: 0; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; inset: 0; background: #ddd; border-radius: 24px; transition: .3s; cursor: pointer; }
        .slider:before { content: ''; position: absolute; height: 18px; width: 18px; left: 3px; top: 3px; background: #fff; border-radius: 50%; transition: .3s; }
        input:checked + .slider { background: var(--accent); }
        input:checked + .slider:before { transform: translateX(20px); }

        /* ── Modal ── */
        .modal-bg { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 999; align-items: center; justify-content: center; padding: 1rem; }
        .modal-bg.open { display: flex; }
        .modal { background: #fff; border-radius: 14px; width: 100%; max-width: 600px; box-shadow: 0 12px 40px rgba(0,0,0,.2); overflow: hidden; }
        .modal-head { background: var(--brand); color: #fff; padding: 1rem 1.5rem; font-weight: 700; display: flex; align-items: center; justify-content: space-between; }
        .modal-body { padding: 1.5rem; }
        .modal-foot { padding: 1rem 1.5rem; background: #f9f0f4; display: flex; justify-content: flex-end; gap: .75rem; }
        .modal-close { background: none; border: none; color: #fff; font-size: 1.2rem; cursor: pointer; }

        /* ── Mobile overlay ── */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 190; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .topbar { left: 0; }
            .topbar-toggle { display: block; }
            .main-wrap { margin-left: 0; padding: 1rem; }
            .form-grid2, .form-grid3 { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <span>Painel Admin</span>
        <strong>Eduarda Cardoso<br>Estética</strong>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>
        <a href="{{ route('admin.contatos') }}" class="{{ request()->routeIs('admin.contatos') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Contatos
            @if(isset($pendentesCount) && $pendentesCount > 0)
            <span style="margin-left:auto;background:#f2c0d0;color:#6b2040;font-size:.7rem;padding:.1rem .5rem;border-radius:20px">{{ $pendentesCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.servicos.index') }}" class="{{ request()->routeIs('admin.servicos.*') ? 'active' : '' }}">
            <i class="fas fa-concierge-bell"></i> Serviços
        </a>
        <a href="{{ route('admin.galeria.index') }}" class="{{ request()->routeIs('admin.galeria.*') ? 'active' : '' }}">
            <i class="fas fa-th"></i> Galeria
        </a>
        <a href="{{ route('admin.antes-depois.index') }}" class="{{ request()->routeIs('admin.antes-depois.*') ? 'active' : '' }}">
            <i class="fas fa-images"></i> Antes/Depois
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ route('home') }}" target="_blank">
            <i class="fas fa-external-link-alt"></i> Ver site
        </a>
    </div>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- Topbar --}}
<header class="topbar">
    <button class="topbar-toggle" id="sidebarToggle" aria-label="Menu">
        <i class="fas fa-bars"></i>
    </button>
    <span class="topbar-title">@yield('topbar-title', 'Admin')</span>
    <div class="topbar-right">
        <span class="topbar-badge"><i class="fas fa-spa"></i> Admin</span>
    </div>
</header>

{{-- Main --}}
<main class="main-wrap">

    @if(session('success'))
    <div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @yield('content')

</main>

<script>
    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('sidebarOverlay');
    const toggle   = document.getElementById('sidebarToggle');

    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
    });
    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
    });
</script>
{{-- Cropper.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

{{-- Global crop modal --}}
<div class="modal-bg" id="cropModal" style="z-index:1100">
    <div class="modal" style="max-width:700px">
        <div class="modal-head">
            <span><i class="fas fa-crop-alt"></i> Recortar Imagem</span>
            <button class="modal-close" id="cropCancel"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" style="padding:1rem">
            <div style="max-height:420px;overflow:hidden;background:#111;border-radius:8px">
                <img id="cropImage" src="" alt="" style="max-width:100%;display:block">
            </div>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.75rem">
                <button type="button" class="btn-sm btn-edit" onclick="cropSetRatio(16/9)">16:9</button>
                <button type="button" class="btn-sm btn-edit" onclick="cropSetRatio(4/3)">4:3</button>
                <button type="button" class="btn-sm btn-edit" onclick="cropSetRatio(1)">1:1</button>
                <button type="button" class="btn-sm btn-edit" onclick="cropSetRatio(NaN)">Livre</button>
            </div>
        </div>
        <div class="modal-foot">
            <button type="button" class="btn-cancel" id="cropCancel2">Cancelar</button>
            <button type="button" class="btn btn-primary" id="cropConfirm">
                <i class="fas fa-check"></i> Confirmar Recorte
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    let cropper      = null;
    let targetInput  = null;
    let targetPreview= null;

    window.initCropInput = function (inputEl, previewEl, ratio) {
        inputEl.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            targetInput   = inputEl;
            targetPreview = previewEl;

            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('cropImage');
                img.src = e.target.result;

                if (cropper) { cropper.destroy(); cropper = null; }
                document.getElementById('cropModal').classList.add('open');

                setTimeout(() => {
                    cropper = new Cropper(img, {
                        aspectRatio: ratio ?? NaN,
                        viewMode: 1,
                        autoCropArea: 1,
                        movable: true,
                        zoomable: true,
                        scalable: false,
                        rotatable: false,
                        background: false,
                    });
                }, 80);
            };
            reader.readAsDataURL(file);
            // reset so same file can be re-selected after cancel
            this.value = '';
        });
    };

    function cropSetRatio(r) {
        if (cropper) cropper.setAspectRatio(isNaN(r) ? NaN : r);
    }
    window.cropSetRatio = cropSetRatio;

    function closeCropModal() {
        document.getElementById('cropModal').classList.remove('open');
        if (cropper) { cropper.destroy(); cropper = null; }
        targetInput = null; targetPreview = null;
    }

    document.getElementById('cropCancel')?.addEventListener('click',  closeCropModal);
    document.getElementById('cropCancel2')?.addEventListener('click', closeCropModal);

    document.getElementById('cropConfirm')?.addEventListener('click', function () {
        if (!cropper || !targetInput) return;

        cropper.getCroppedCanvas({ maxWidth: 1600, maxHeight: 1200 }).toBlob(blob => {
            const origName = targetInput.dataset.filename || 'imagem.jpg';
            const file = new File([blob], origName, { type: 'image/jpeg' });
            const dt   = new DataTransfer();
            dt.items.add(file);
            targetInput.files = dt.files;

            if (targetPreview) {
                targetPreview.src = URL.createObjectURL(blob);
                targetPreview.style.display = 'block';
                const area = targetPreview.closest('.file-area, .upload-area');
                if (area) {
                    area.classList.add('has-file');
                    area.querySelector?.('i') && (area.querySelector('i').style.display = 'none');
                    area.querySelector?.('span') && (area.querySelector('span').style.display = 'none');
                }
            }

            closeCropModal();
        }, 'image/jpeg', .92);
    });
})();
</script>

@stack('scripts')
</body>
</html>
