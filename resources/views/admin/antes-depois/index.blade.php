<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antes e Depois – Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Lato', sans-serif; background: #fdf6f6; color: #3d2b32; }

        .admin-header {
            background: #8B4F6F; color: #fff;
            padding: 1rem 2rem; display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
        }
        .admin-header h1 { font-size: 1.2rem; margin-right: auto; }
        .admin-header nav { display: flex; gap: .5rem; flex-wrap: wrap; }
        .admin-header a { color: rgba(255,255,255,.75); text-decoration: none; font-size: .85rem; padding: .35rem .8rem; border-radius: 20px; border: 1px solid rgba(255,255,255,.3); transition: .2s; }
        .admin-header a:hover, .admin-header a.active { background: rgba(255,255,255,.2); color: #fff; }

        .content { max-width: 1100px; margin: 2rem auto; padding: 0 1rem; }

        /* Flash */
        .flash { padding: .9rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: .6rem; font-size: .9rem; }
        .flash-success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
        .flash-error   { background: #fff5f5; border: 1px solid #fca5a5; color: #dc2626; }

        /* Upload form */
        .upload-card {
            background: #fff; border-radius: 14px; padding: 2rem;
            box-shadow: 0 4px 20px rgba(196,116,140,.1);
            margin-bottom: 2.5rem;
        }
        .upload-card h2 { font-size: 1.2rem; margin-bottom: 1.5rem; color: #2c1820; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { display: flex; flex-direction: column; gap: .4rem; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: .85rem; font-weight: 700; color: #3d2b32; }
        input[type="text"], select {
            padding: .65rem 1rem; border: 2px solid #eedad8; border-radius: 8px;
            font-family: 'Lato', sans-serif; font-size: .95rem; background: #fdfafa;
        }
        input:focus, select:focus { outline: none; border-color: #c4748c; }

        /* File upload area */
        .file-upload-area {
            border: 2px dashed #e0c8d0; border-radius: 10px;
            padding: 1.5rem 1rem; text-align: center; cursor: pointer;
            background: #fdf6f6; transition: all .2s ease; position: relative;
        }
        .file-upload-area:hover, .file-upload-area.has-file { border-color: #c4748c; background: #fef0f4; }
        .file-upload-area input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .file-upload-area i { font-size: 1.8rem; color: #c4748c; margin-bottom: .5rem; display: block; }
        .file-upload-area span { font-size: .85rem; color: #7a6068; }
        .file-upload-area .preview-img {
            max-height: 120px; border-radius: 6px; margin: .5rem auto 0;
            display: none; object-fit: cover; width: 100%;
        }
        .file-note { font-size: .75rem; color: #9e8a90; margin-top: .3rem; }

        .upload-photos-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        .btn-submit {
            background: #c4748c; color: #fff; border: none; padding: .85rem 2rem;
            border-radius: 50px; font-size: .95rem; font-weight: 700; cursor: pointer;
            transition: background .2s; margin-top: 1.25rem;
        }
        .btn-submit:hover { background: #8b4f6f; }

        /* Grid de fotos existentes */
        .grid-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; color: #2c1820; }

        .photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 1.5rem;
        }
        .photo-card {
            background: #fff; border-radius: 12px;
            box-shadow: 0 2px 12px rgba(196,116,140,.1);
            overflow: hidden; border: 1px solid #eedad8;
        }
        .photo-card-header {
            padding: .75rem 1rem; display: flex; align-items: center;
            justify-content: space-between; background: #fdf6f6;
            border-bottom: 1px solid #eedad8;
        }
        .photo-card-header strong { font-size: .95rem; color: #2c1820; }
        .photo-card-header span { font-size: .75rem; background: #f2d1d8; color: #6b2040; padding: .2rem .65rem; border-radius: 50px; }
        .photo-card-images { display: grid; grid-template-columns: 1fr 40px 1fr; align-items: center; }
        .photo-card-images img { width: 100%; height: 200px; object-fit: cover; object-position: center top; display: block; }
        .photo-card-arrow { display: flex; align-items: center; justify-content: center; color: #c4748c; font-size: 1rem; }
        .photo-card-footer { padding: .6rem 1rem; display: flex; justify-content: flex-end; }
        .btn-delete {
            background: none; border: 1px solid #fca5a5; color: #dc2626;
            padding: .35rem .9rem; border-radius: 50px; font-size: .8rem; cursor: pointer;
            transition: all .2s;
        }
        .btn-delete:hover { background: #fef2f2; }

        .empty-state { text-align: center; padding: 3rem; color: #9e8a90; }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; opacity: .4; }

        @media (max-width: 640px) {
            .form-grid, .upload-photos-grid { grid-template-columns: 1fr; }
            .photos-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<header class="admin-header">
    <i class="fas fa-spa"></i>
    <h1>Painel Admin</h1>
    <nav>
        <a href="{{ route('admin.contatos') }}"><i class="fas fa-envelope"></i> Contatos</a>
        <a href="{{ route('admin.servicos.index') }}"><i class="fas fa-concierge-bell"></i> Serviços</a>
        <a href="{{ route('admin.antes-depois.index') }}" class="active"><i class="fas fa-images"></i> Antes/Depois</a>
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Ver Site</a>
    </nav>
</header>

<main class="content">

    @if(session('success'))
    <div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <!-- Formulário de upload -->
    <div class="upload-card">
        <h2><i class="fas fa-plus-circle" style="color:#c4748c"></i> Adicionar par de fotos</h2>

        <form action="{{ route('admin.antes-depois.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Título do resultado</label>
                    <input type="text" name="titulo" placeholder="Ex: Micropigmentação – Sobrancelha" required>
                </div>
                <div class="form-group">
                    <label>Serviço</label>
                    <select name="servico" required>
                        <option value="" disabled selected>Selecione</option>
                        @foreach($servicos as $s)
                        <option>{{ $s->titulo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group full">
                    <label>Fotos (tamanho recomendado: <strong>800×600px</strong>, máx. 5MB, JPG/PNG/WebP)</label>
                    <div class="upload-photos-grid">
                        <div>
                            <div class="file-upload-area" id="area-antes">
                                <input type="file" name="foto_antes" accept="image/*" required
                                       onchange="previewImg(this,'preview-antes','area-antes')">
                                <i class="fas fa-camera"></i>
                                <span>Foto <strong>ANTES</strong><br>Clique para selecionar</span>
                                <img id="preview-antes" class="preview-img" alt="">
                            </div>
                            <p class="file-note">Foto do estado atual do cliente</p>
                        </div>
                        <div>
                            <div class="file-upload-area" id="area-depois">
                                <input type="file" name="foto_depois" accept="image/*" required
                                       onchange="previewImg(this,'preview-depois','area-depois')">
                                <i class="fas fa-magic"></i>
                                <span>Foto <strong>DEPOIS</strong><br>Clique para selecionar</span>
                                <img id="preview-depois" class="preview-img" alt="">
                            </div>
                            <p class="file-note">Foto após o tratamento</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-upload"></i> Adicionar ao site
            </button>
        </form>
    </div>

    <!-- Lista de pares existentes -->
    <p class="grid-title">Publicados no site ({{ $items->count() }} {{ $items->count() === 1 ? 'par' : 'pares' }})</p>

    @if($items->isEmpty())
    <div class="empty-state">
        <i class="fas fa-images"></i>
        <p>Nenhuma foto publicada ainda. Adicione o primeiro par acima.</p>
    </div>
    @else
    <div class="photos-grid">
        @foreach($items as $item)
        <div class="photo-card">
            <div class="photo-card-header">
                <strong>{{ $item->titulo }}</strong>
                <span>{{ $item->servico }}</span>
            </div>
            <div class="photo-card-images">
                <img src="{{ Storage::url($item->foto_antes) }}" alt="Antes">
                <div class="photo-card-arrow"><i class="fas fa-arrow-right"></i></div>
                <img src="{{ Storage::url($item->foto_depois) }}" alt="Depois">
            </div>
            <div class="photo-card-footer">
                <form action="{{ route('admin.antes-depois.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Remover este par de fotos?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash"></i> Remover
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</main>

<script>
function previewImg(input, previewId, areaId) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);
    const area = document.getElementById(areaId);
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            area.classList.add('has-file');
            area.querySelector('i').style.display = 'none';
            area.querySelector('span').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}
</script>
</body>
</html>
