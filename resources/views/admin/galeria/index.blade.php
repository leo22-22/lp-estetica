@extends('layouts.admin')

@section('title', 'Galeria')
@section('topbar-title', 'Galeria')

@push('styles')
<style>
    .upload-area {
        border: 2px dashed #e0c8d0; border-radius: 10px;
        padding: 2rem 1rem; text-align: center; cursor: pointer;
        background: #fdf6f6; transition: .2s; position: relative;
    }
    .upload-area:hover, .upload-area.has-file { border-color: #C4748C; background: #fef0f4; }
    .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .upload-area i { font-size: 2rem; color: #C4748C; margin-bottom: .5rem; display: block; }
    .upload-area span { font-size: .85rem; color: #7a6068; }
    .upload-area .preview-img { max-height: 140px; border-radius: 8px; margin: .75rem auto 0; display: none; object-fit: cover; }

    .photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    .photo-item { position: relative; border-radius: 10px; overflow: hidden; border: 1px solid #eedad8; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
    .photo-item img { width: 100%; height: 160px; object-fit: cover; display: block; }
    .photo-item-info { padding: .5rem .75rem .6rem; }
    .photo-item-title { font-size: .85rem; font-weight: 700; color: #2c1820; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .photo-item-cat { font-size: .75rem; color: #888; margin-top: .1rem; }
    .photo-item-footer { padding: .4rem .75rem .6rem; display: flex; align-items: center; justify-content: space-between; gap: .3rem; }
    .cat-badge { font-size: .7rem; background: #f2d1d8; color: #6b2040; padding: .15rem .5rem; border-radius: 20px; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; flex-shrink: 1; }
    .photo-item-footer .actions { flex-shrink: 0; display: flex; gap: .3rem; }
    .inactive-overlay { position: absolute; top: .5rem; left: .5rem; background: rgba(0,0,0,.55); color: #fff; font-size: .7rem; font-weight: 700; padding: .2rem .5rem; border-radius: 4px; }

    @media (max-width: 640px) {
        .photos-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')

{{-- Upload form --}}
<div class="card">
    <div class="card-head"><i class="fas fa-plus-circle"></i> Adicionar Foto à Galeria</div>
    <div class="card-body">
        <form action="{{ route('admin.galeria.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid3" style="margin-bottom:1rem">
                <div class="form-group">
                    <label>Título da foto</label>
                    <input type="text" name="titulo" placeholder="Ex: Micropigmentação Natural" required>
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <select name="categoria" required>
                        <option value="micropigmentacao">Micropigmentação</option>
                        <option value="limpeza">Limpeza de Pele</option>
                        <option value="facial">Tratamento Facial</option>
                        <option value="massagem">Massagem</option>
                        <option value="radiofrequencia">Radiofrequência</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ordem</label>
                    <input type="number" name="ordem" value="0" min="0">
                    <span class="form-hint">Menor número aparece primeiro</span>
                </div>
            </div>
            <div style="margin-bottom:1rem">
                <label style="font-size:.82rem;font-weight:700;color:#6b3353;margin-bottom:.4rem;display:block">
                    Foto (recomendado: 800×600px, máx. 5MB, JPG/PNG/WebP)
                </label>
                <div class="upload-area" id="upload-area">
                    <input type="file" name="imagem" id="galeria-input" accept="image/*" required
                           data-filename="galeria.jpg">
                    <i class="fas fa-image"></i>
                    <span>Clique para selecionar a foto</span>
                    <img id="preview-img" class="preview-img" alt="">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Adicionar à Galeria
            </button>
        </form>
    </div>
</div>

{{-- Grade de fotos --}}
<div class="card">
    <div class="card-head">
        <i class="fas fa-images"></i> Fotos na Galeria
        <span style="margin-left:auto;font-size:.85rem;font-weight:400;color:#888">{{ $items->count() }} {{ $items->count() === 1 ? 'foto' : 'fotos' }}</span>
    </div>

    @if($items->isEmpty())
        <div style="text-align:center;padding:3rem;color:#aaa">
            <i class="fas fa-images fa-2x"></i>
            <p style="margin-top:.75rem">Nenhuma foto na galeria ainda.</p>
        </div>
    @else
    <div class="card-body">
        <div class="photos-grid">
            @foreach($items as $item)
            <div class="photo-item">
                @if(!$item->ativo)
                    <div class="inactive-overlay">Inativo</div>
                @endif
                <img src="{{ Storage::url($item->imagem) }}" alt="{{ $item->titulo }}">
                <div class="photo-item-info">
                    <div class="photo-item-title">{{ $item->titulo }}</div>
                </div>
                <div class="photo-item-footer">
                    <span class="cat-badge">{{ $item->categoria }}</span>
                    <div class="actions">
                        <button class="btn-sm btn-edit"
                            onclick="openEdit({{ $item->id }}, {{ json_encode($item->titulo) }}, '{{ $item->categoria }}', {{ $item->ordem }}, {{ $item->ativo ? 'true' : 'false' }})">
                            <i class="fas fa-pen"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.galeria.destroy', $item) }}"
                              onsubmit="return confirm('Remover esta foto?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm btn-del"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

{{-- Modal editar --}}
<div class="modal-bg" id="editModal">
    <div class="modal">
        <div class="modal-head">
            <span><i class="fas fa-pen"></i> Editar Foto</span>
            <button class="modal-close" onclick="closeEdit()"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid2" style="margin-bottom:1rem">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="titulo" id="edit_titulo" required>
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select name="categoria" id="edit_categoria">
                            <option value="micropigmentacao">Micropigmentação</option>
                            <option value="limpeza">Limpeza de Pele</option>
                            <option value="facial">Tratamento Facial</option>
                            <option value="massagem">Massagem</option>
                            <option value="radiofrequencia">Radiofrequência</option>
                            <option value="outros">Outros</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:1rem">
                    <label>Ordem</label>
                    <input type="number" name="ordem" id="edit_ordem" min="0">
                </div>
                <div class="toggle-row">
                    <label class="toggle">
                        <input type="checkbox" name="ativo" id="edit_ativo" value="1">
                        <span class="slider"></span>
                    </label>
                    <span style="font-size:.9rem;font-weight:700">Foto visível no site</span>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-cancel" onclick="closeEdit()">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ratio 4:3 para fotos de galeria
initCropInput(
    document.getElementById('galeria-input'),
    document.getElementById('preview-img'),
    4/3
);

function openEdit(id, titulo, categoria, ordem, ativo) {
    document.getElementById('editForm').action     = '/admin/galeria/' + id;
    document.getElementById('edit_titulo').value   = titulo;
    document.getElementById('edit_categoria').value= categoria;
    document.getElementById('edit_ordem').value    = ordem;
    document.getElementById('edit_ativo').checked  = ativo;
    document.getElementById('editModal').classList.add('open');
}
function closeEdit() {
    document.getElementById('editModal').classList.remove('open');
}
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEdit();
});
</script>
@endpush
