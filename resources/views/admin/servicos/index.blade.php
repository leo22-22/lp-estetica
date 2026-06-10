@extends('layouts.admin')

@section('title', 'Serviços')
@section('topbar-title', 'Serviços')

@section('content')

{{-- Formulário adicionar --}}
<div class="card">
    <div class="card-head"><i class="fas fa-plus-circle"></i> Adicionar Serviço</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.servicos.store') }}">
            @csrf
            <div class="form-grid3" style="margin-bottom:1rem">
                <div class="form-group">
                    <label>Ícone (Font Awesome)</label>
                    <input type="text" name="icone" placeholder="fas fa-spa" value="{{ old('icone','fas fa-spa') }}" required>
                    <span class="form-hint">fas fa-spa, fas fa-magic, fas fa-hands…</span>
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
                    <td><i class="{{ $s->icone }}" style="font-size:1.3rem;color:#C4748C"></i></td>
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
                        <input type="text" name="icone" id="edit_icone" required>
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
function openEdit(id, icone, titulo, descricao, preco, ordem, ativo) {
    document.getElementById('editForm').action = '/admin/servicos/' + id;
    document.getElementById('edit_icone').value    = icone;
    document.getElementById('edit_titulo').value   = titulo;
    document.getElementById('edit_descricao').value= descricao;
    document.getElementById('edit_preco').value    = preco;
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
