@extends('layouts.admin')

@section('title', 'Antes/Depois')
@section('topbar-title', 'Antes e Depois')

@push('styles')
<style>
    .upload-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .file-area {
        border: 2px dashed #e0c8d0; border-radius: 10px;
        padding: 1.5rem 1rem; text-align: center; cursor: pointer;
        background: #fdf6f6; transition: .2s; position: relative;
    }
    .file-area:hover, .file-area.has-file { border-color: #C4748C; background: #fef0f4; }
    .file-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .file-area i { font-size: 1.8rem; color: #C4748C; margin-bottom: .5rem; display: block; }
    .file-area span { font-size: .85rem; color: #7a6068; }
    .file-area .preview-img { max-height: 120px; border-radius: 6px; margin: .5rem auto 0; display: none; object-fit: cover; width: 100%; }
    .file-note { font-size: .75rem; color: #9e8a90; margin-top: .3rem; }

    .photos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(460px, 1fr)); gap: 1.5rem; }
    .photo-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(196,116,140,.1); overflow: hidden; border: 1px solid #eedad8; }
    .photo-card-header { padding: .75rem 1rem; display: flex; align-items: center; justify-content: space-between; background: #fdf6f6; border-bottom: 1px solid #eedad8; }
    .photo-card-header strong { font-size: .95rem; color: #2c1820; }
    .photo-card-header span { font-size: .75rem; background: #f2d1d8; color: #6b2040; padding: .2rem .65rem; border-radius: 50px; }
    .photo-pair { display: grid; grid-template-columns: 1fr 36px 1fr; align-items: center; }
    .photo-pair img { width: 100%; height: 200px; object-fit: cover; object-position: center top; display: block; }
    .photo-pair-arrow { display: flex; align-items: center; justify-content: center; color: #C4748C; }
    .photo-card-footer { padding: .6rem 1rem; display: flex; justify-content: flex-end; }
    .empty-state { text-align: center; padding: 3rem; color: #9e8a90; }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; opacity: .4; }

    @media (max-width: 640px) {
        .upload-grid { grid-template-columns: 1fr; }
        .photos-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- Upload --}}
<div class="card">
    <div class="card-head"><i class="fas fa-plus-circle"></i> Adicionar par de fotos</div>
    <div class="card-body">
        <form action="{{ route('admin.antes-depois.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid2" style="margin-bottom:1rem">
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
                        @if($servicos->isEmpty())
                            <option>Limpeza de Pele</option>
                            <option>Micropigmentação</option>
                            <option>Massagem Relaxante</option>
                            <option>Peeling Facial</option>
                            <option>Radiofrequência</option>
                            <option>Drenagem Linfática</option>
                        @endif
                    </select>
                </div>
            </div>

            <label style="font-size:.82rem;font-weight:700;color:#6b3353;margin-bottom:.5rem;display:block">
                Fotos (tamanho recomendado: <strong>800×600px</strong>, máx. 5MB, JPG/PNG/WebP)
            </label>
            <div class="upload-grid" style="margin-bottom:1rem">
                <div>
                    <div class="file-area" id="area-antes">
                        <input type="file" name="foto_antes" accept="image/*" required
                               onchange="previewImg(this,'preview-antes','area-antes')">
                        <i class="fas fa-camera"></i>
                        <span>Foto <strong>ANTES</strong><br>Clique para selecionar</span>
                        <img id="preview-antes" class="preview-img" alt="">
                    </div>
                    <p class="file-note">Estado atual do cliente</p>
                </div>
                <div>
                    <div class="file-area" id="area-depois">
                        <input type="file" name="foto_depois" accept="image/*" required
                               onchange="previewImg(this,'preview-depois','area-depois')">
                        <i class="fas fa-magic"></i>
                        <span>Foto <strong>DEPOIS</strong><br>Clique para selecionar</span>
                        <img id="preview-depois" class="preview-img" alt="">
                    </div>
                    <p class="file-note">Após o tratamento</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Adicionar ao site
            </button>
        </form>
    </div>
</div>

{{-- Lista publicada --}}
<div class="card">
    <div class="card-head">
        <i class="fas fa-images"></i>
        Publicados no site
        <span style="margin-left:auto;font-size:.85rem;font-weight:400;color:#888">{{ $items->count() }} {{ $items->count() === 1 ? 'par' : 'pares' }}</span>
    </div>

    @if($items->isEmpty())
    <div class="empty-state">
        <i class="fas fa-images"></i>
        <p>Nenhuma foto publicada ainda. Adicione o primeiro par acima.</p>
    </div>
    @else
    <div class="card-body">
        <div class="photos-grid">
            @foreach($items as $item)
            <div class="photo-card">
                <div class="photo-card-header">
                    <strong>{{ $item->titulo }}</strong>
                    <span>{{ $item->servico }}</span>
                </div>
                <div class="photo-pair">
                    <img src="{{ Storage::url($item->foto_antes) }}" alt="Antes">
                    <div class="photo-pair-arrow"><i class="fas fa-arrow-right"></i></div>
                    <img src="{{ Storage::url($item->foto_depois) }}" alt="Depois">
                </div>
                <div class="photo-card-footer">
                    <form action="{{ route('admin.antes-depois.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Remover este par de fotos?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">
                            <i class="fas fa-trash"></i> Remover
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function previewImg(input, previewId, areaId) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById(previewId);
        const area    = document.getElementById(areaId);
        preview.src = e.target.result;
        preview.style.display = 'block';
        area.classList.add('has-file');
        area.querySelector('i').style.display  = 'none';
        area.querySelector('span').style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>
@endpush
