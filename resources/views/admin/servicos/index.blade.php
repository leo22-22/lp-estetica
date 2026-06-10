@extends('layouts.admin')

@section('title', 'Serviços')
@section('topbar-title', 'Serviços')

@push('styles')
<style>
    .icon-picker-wrap { position: relative; }
    .icon-selected-preview {
        display: flex; align-items: center; gap: .75rem;
        padding: .6rem .9rem; border: 2px solid #f0dde5; border-radius: 8px;
        background: #fdfafa; cursor: pointer; transition: .2s; user-select: none;
    }
    .icon-selected-preview:hover { border-color: #C4748C; }
    .icon-selected-preview i.preview-icon { font-size: 1.3rem; color: #C4748C; width: 22px; text-align: center; }
    .icon-selected-preview span { font-size: .85rem; color: #555; flex: 1; }
    .icon-selected-preview .icon-arrow { color: #aaa; font-size: .75rem; }

    .icon-dropdown {
        display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0;
        background: #fff; border: 2px solid #e0c8d0; border-radius: 10px;
        padding: .75rem; z-index: 500; box-shadow: 0 8px 24px rgba(0,0,0,.12);
    }
    .icon-dropdown.open { display: block; }
    .icon-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(40px, 1fr)); gap: .4rem;
    }
    .icon-btn {
        display: flex; align-items: center; justify-content: center;
        width: 40px; height: 40px; border-radius: 8px; border: 2px solid transparent;
        background: #f9f0f4; cursor: pointer; transition: .15s; font-size: 1.1rem; color: #8B4F6F;
    }
    .icon-btn:hover { background: #f2d1d8; border-color: #C4748C; }
    .icon-btn.selected { background: #C4748C; color: #fff; border-color: #8B4F6F; }
    .icon-search {
        width: 100%; padding: .5rem .75rem; border: 2px solid #f0dde5; border-radius: 6px;
        font-family: inherit; font-size: .85rem; margin-bottom: .6rem;
    }
    .icon-search:focus { outline: none; border-color: #C4748C; }
</style>
@endpush

@section('content')

{{-- Formulário adicionar --}}
<div class="card">
    <div class="card-head"><i class="fas fa-plus-circle"></i> Adicionar Serviço</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.servicos.store') }}">
            @csrf
            <div class="form-grid3" style="margin-bottom:1rem">
                <div class="form-group">
                    <label>Ícone</label>
                    <div class="icon-picker-wrap" id="picker-add">
                        <input type="hidden" name="icone" id="icone-add" value="{{ old('icone','fas fa-spa') }}" required>
                        <div class="icon-selected-preview" onclick="togglePicker('add')">
                            <i class="preview-icon fas fa-spa" id="preview-add"></i>
                            <span id="label-add">fas fa-spa</span>
                            <i class="icon-arrow fas fa-chevron-down"></i>
                        </div>
                        <div class="icon-dropdown" id="dropdown-add">
                            <input type="text" class="icon-search" placeholder="Buscar ícone..." oninput="filterIcons(this,'grid-add')">
                            <div class="icon-grid" id="grid-add"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Título *</label>
                    <input type="text" name="titulo" placeholder="Limpeza de Pele" value="{{ old('titulo') }}" required>
                </div>
                <div class="form-group">
                    <label>Preço</label>
                    <input type="text" name="preco" placeholder="A partir de R$ 120" value="{{ old('preco') }}">
                </div>
            </div>
            <div class="form-grid2" style="margin-bottom:1rem">
                <div class="form-group">
                    <label>Descrição *</label>
                    <textarea name="descricao" placeholder="Descrição do serviço..." required>{{ old('descricao') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Ordem de exibição</label>
                    <input type="number" name="ordem" placeholder="0" value="{{ old('ordem', 0) }}" min="0">
                    <span class="form-hint">Menor número aparece primeiro</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar Serviço</button>
        </form>
    </div>
</div>

{{-- Lista --}}
<div class="card">
    <div class="card-head"><i class="fas fa-list"></i> Serviços Cadastrados ({{ $servicos->count() }})</div>

    @if($servicos->isEmpty())
        <div style="text-align:center;padding:3rem;color:#aaa">
            <i class="fas fa-concierge-bell fa-2x"></i>
            <p style="margin-top:.75rem">Nenhum serviço cadastrado ainda.</p>
        </div>
    @else
    <div style="overflow-x:auto">
        <table>
            <thead>
                <tr>
                    <th>Ordem</th>
                    <th>Ícone</th>
                    <th>Título / Descrição</th>
                    <th>Preço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicos as $s)
                <tr>
                    <td>{{ $s->ordem }}</td>
                    <td><i class="{{ $s->icone }}" style="font-size:1.4rem;color:#C4748C"></i></td>
                    <td>
                        <strong>{{ $s->titulo }}</strong>
                        <br><small style="color:#999">{{ Str::limit($s->descricao, 60) }}</small>
                    </td>
                    <td>{{ $s->preco ?? '–' }}</td>
                    <td><span class="badge {{ $s->ativo ? 'badge-on' : 'badge-off' }}">{{ $s->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                    <td>
                        <div style="display:flex;gap:.4rem;flex-wrap:wrap">
                            <button class="btn-sm btn-edit"
                                onclick="openEdit({{ $s->id }}, '{{ addslashes($s->icone) }}', '{{ addslashes($s->titulo) }}', '{{ addslashes($s->descricao) }}', '{{ addslashes($s->preco ?? '') }}', {{ $s->ordem }}, {{ $s->ativo ? 'true' : 'false' }})">
                                <i class="fas fa-pen"></i> Editar
                            </button>
                            <form method="POST" action="{{ route('admin.servicos.destroy', $s->id) }}"
                                  onsubmit="return confirm('Remover este serviço?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

{{-- Modal editar --}}
<div class="modal-bg" id="editModal">
    <div class="modal">
        <div class="modal-head">
            <span><i class="fas fa-pen"></i> Editar Serviço</span>
            <button class="modal-close" onclick="closeEdit()"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-grid3" style="margin-bottom:1rem">
                    <div class="form-group">
                        <label>Ícone</label>
                        <div class="icon-picker-wrap" id="picker-edit">
                            <input type="hidden" name="icone" id="icone-edit" required>
                            <div class="icon-selected-preview" onclick="togglePicker('edit')">
                                <i class="preview-icon fas fa-spa" id="preview-edit"></i>
                                <span id="label-edit">fas fa-spa</span>
                                <i class="icon-arrow fas fa-chevron-down"></i>
                            </div>
                            <div class="icon-dropdown" id="dropdown-edit">
                                <input type="text" class="icon-search" placeholder="Buscar ícone..." oninput="filterIcons(this,'grid-edit')">
                                <div class="icon-grid" id="grid-edit"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="titulo" id="edit_titulo" required>
                    </div>
                    <div class="form-group">
                        <label>Preço</label>
                        <input type="text" name="preco" id="edit_preco">
                    </div>
                </div>
                <div class="form-grid2" style="margin-bottom:1rem">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="descricao" id="edit_descricao" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ordem</label>
                        <input type="number" name="ordem" id="edit_ordem" min="0">
                    </div>
                </div>
                <div class="toggle-row">
                    <label class="toggle">
                        <input type="checkbox" name="ativo" id="edit_ativo" value="1">
                        <span class="slider"></span>
                    </label>
                    <span style="font-size:.9rem;font-weight:700">Serviço ativo (aparece no site)</span>
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
const ICONS = [
    ['fas fa-spa',           'spa'],
    ['fas fa-magic',         'varinha'],
    ['fas fa-hands',         'mãos'],
    ['fas fa-paint-brush',   'pincel'],
    ['fas fa-sun',           'sol'],
    ['fas fa-heart',         'coração'],
    ['fas fa-star',          'estrela'],
    ['fas fa-leaf',          'folha'],
    ['fas fa-gem',           'joia'],
    ['fas fa-crown',         'coroa'],
    ['fas fa-feather',       'pena'],
    ['fas fa-fire',          'fogo'],
    ['fas fa-snowflake',     'neve'],
    ['fas fa-tint',          'gota'],
    ['fas fa-bolt',          'raio'],
    ['fas fa-eye',           'olho'],
    ['fas fa-smile',         'sorriso'],
    ['fas fa-cut',           'tesoura'],
    ['fas fa-syringe',       'seringa'],
    ['fas fa-band-aid',      'curativo'],
    ['fas fa-heartbeat',     'batimento'],
    ['fas fa-seedling',      'broto'],
    ['fas fa-wind',          'vento'],
    ['fas fa-moon',          'lua'],
    ['fas fa-female',        'mulher'],
    ['fas fa-user',          'pessoa'],
    ['fas fa-hand-sparkles', 'brilho'],
    ['fas fa-dumbbell',      'haltere'],
    ['fas fa-apple-alt',     'maçã'],
    ['fas fa-stethoscope',   'estetoscópio'],
    ['fas fa-pills',         'pílulas'],
    ['fas fa-microscope',    'microscópio'],
    ['fas fa-palette',       'paleta'],
    ['fas fa-highlighter',   'marca-texto'],
    ['fas fa-ring',          'anel'],
    ['fas fa-kiss',          'beijo'],
];

function buildGrid(gridId, selected) {
    const grid = document.getElementById(gridId);
    grid.innerHTML = '';
    ICONS.forEach(([cls, label]) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'icon-btn' + (cls === selected ? ' selected' : '');
        btn.title = cls;
        btn.dataset.cls   = cls;
        btn.dataset.label = label;
        btn.innerHTML = `<i class="${cls}"></i>`;
        btn.addEventListener('click', () => selectIcon(gridId, cls));
        grid.appendChild(btn);
    });
}

function selectIcon(gridId, cls) {
    const context = gridId.replace('grid-', '');
    document.getElementById('icone-' + context).value = cls;
    document.getElementById('preview-' + context).className = cls;
    document.getElementById('label-' + context).textContent = cls;
    document.querySelectorAll('#' + gridId + ' .icon-btn').forEach(b => {
        b.classList.toggle('selected', b.dataset.cls === cls);
    });
    document.getElementById('dropdown-' + context).classList.remove('open');
}

function togglePicker(context) {
    const dropdown = document.getElementById('dropdown-' + context);
    dropdown.classList.toggle('open');
    if (dropdown.classList.contains('open')) {
        const current = document.getElementById('icone-' + context).value;
        buildGrid('grid-' + context, current);
        dropdown.querySelector('.icon-search').value = '';
        dropdown.querySelector('.icon-search').focus();
    }
}

function filterIcons(input, gridId) {
    const q = input.value.toLowerCase();
    document.querySelectorAll('#' + gridId + ' .icon-btn').forEach(btn => {
        const match = btn.dataset.cls.includes(q) || btn.dataset.label.includes(q);
        btn.style.display = match ? '' : 'none';
    });
}

// Fechar dropdowns ao clicar fora
document.addEventListener('click', e => {
    if (!e.target.closest('.icon-picker-wrap')) {
        document.querySelectorAll('.icon-dropdown').forEach(d => d.classList.remove('open'));
    }
});

// Modal editar
function openEdit(id, icone, titulo, descricao, preco, ordem, ativo) {
    document.getElementById('editForm').action      = '/admin/servicos/' + id;
    document.getElementById('icone-edit').value     = icone;
    document.getElementById('preview-edit').className = icone;
    document.getElementById('label-edit').textContent  = icone;
    document.getElementById('edit_titulo').value    = titulo;
    document.getElementById('edit_descricao').value = descricao;
    document.getElementById('edit_preco').value     = preco;
    document.getElementById('edit_ordem').value     = ordem;
    document.getElementById('edit_ativo').checked   = ativo;
    document.getElementById('editModal').classList.add('open');
}
function closeEdit() {
    document.getElementById('editModal').classList.remove('open');
    document.querySelectorAll('.icon-dropdown').forEach(d => d.classList.remove('open'));
}
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEdit();
});

// Init picker de adição com valor padrão
buildGrid('grid-add', document.getElementById('icone-add').value);
</script>
@endpush
