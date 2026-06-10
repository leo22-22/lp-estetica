<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços – Admin | Eduarda Cardoso Estética</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Lato',sans-serif;background:#f5f0f0;color:#333}
        .admin-header{background:#8B4F6F;color:#fff;padding:1rem 2rem;display:flex;align-items:center;gap:1rem;flex-wrap:wrap}
        .admin-header h1{font-size:1.3rem;margin-right:auto}
        .admin-nav{display:flex;gap:.5rem;flex-wrap:wrap}
        .admin-nav a{color:rgba(255,255,255,.75);text-decoration:none;font-size:.85rem;padding:.35rem .8rem;border-radius:20px;border:1px solid rgba(255,255,255,.3);transition:.2s}
        .admin-nav a:hover,.admin-nav a.active{background:rgba(255,255,255,.2);color:#fff}
        .content{max-width:1100px;margin:2rem auto;padding:0 1rem}
        .flash{background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:.8rem 1.2rem;border-radius:10px;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem}
        .card{background:#fff;border-radius:14px;box-shadow:0 2px 10px rgba(0,0,0,.07);overflow:hidden;margin-bottom:2rem}
        .card-head{background:#f9f0f4;padding:1rem 1.5rem;font-weight:700;font-size:1rem;color:#5c2b46;border-bottom:1px solid #f0dde5;display:flex;align-items:center;gap:.5rem}
        .card-body{padding:1.5rem}
        .grid2{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
        .grid3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem}
        .form-group{display:flex;flex-direction:column;gap:.35rem}
        .form-group label{font-size:.82rem;font-weight:700;color:#5c2b46}
        .form-group input,.form-group textarea,.form-group select{padding:.65rem .9rem;border:2px solid #f0dde5;border-radius:8px;font-family:inherit;font-size:.9rem;color:#333;transition:.2s}
        .form-group input:focus,.form-group textarea:focus,.form-group select:focus{outline:none;border-color:#C4748C}
        .form-group textarea{resize:vertical;min-height:80px}
        .form-hint{font-size:.75rem;color:#999;margin-top:.2rem}
        .btn-add{background:#C4748C;color:#fff;border:none;padding:.65rem 1.5rem;border-radius:8px;font-family:inherit;font-weight:700;font-size:.9rem;cursor:pointer;transition:.2s;display:inline-flex;align-items:center;gap:.4rem}
        .btn-add:hover{background:#8B4F6F}
        .btn-sm{padding:.3rem .7rem;border-radius:6px;font-size:.8rem;font-weight:700;cursor:pointer;border:none;transition:.2s;display:inline-flex;align-items:center;gap:.3rem}
        .btn-edit{background:#fff3e0;color:#e65100}
        .btn-edit:hover{background:#e65100;color:#fff}
        .btn-del{background:#fce4ec;color:#c62828}
        .btn-del:hover{background:#c62828;color:#fff}
        table{width:100%;border-collapse:collapse}
        thead{background:#8B4F6F;color:#fff}
        th,td{padding:.8rem 1rem;text-align:left;font-size:.88rem;vertical-align:middle}
        tr:nth-child(even){background:#fdf6f6}
        tr:hover{background:#f9eaea}
        .badge-on{background:#c8e6c9;color:#1b5e20;padding:.15rem .5rem;border-radius:20px;font-size:.75rem;font-weight:700}
        .badge-off{background:#ffcdd2;color:#b71c1c;padding:.15rem .5rem;border-radius:20px;font-size:.75rem;font-weight:700}
        .empty{text-align:center;padding:3rem;color:#aaa}
        .actions{display:flex;gap:.4rem;flex-wrap:wrap}
        /* modal */
        .modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:999;align-items:center;justify-content:center;padding:1rem}
        .modal-bg.open{display:flex}
        .modal{background:#fff;border-radius:14px;width:100%;max-width:600px;box-shadow:0 12px 40px rgba(0,0,0,.2);overflow:hidden}
        .modal-head{background:#8B4F6F;color:#fff;padding:1rem 1.5rem;font-weight:700;display:flex;align-items:center;justify-content:space-between}
        .modal-body{padding:1.5rem}
        .modal-foot{padding:1rem 1.5rem;background:#f9f0f4;display:flex;justify-content:flex-end;gap:.75rem}
        .btn-cancel{background:#eee;color:#555;border:none;padding:.6rem 1.2rem;border-radius:8px;cursor:pointer;font-family:inherit;font-weight:700;font-size:.9rem}
        .btn-cancel:hover{background:#ddd}
        .toggle-row{display:flex;align-items:center;gap:.75rem}
        .toggle{position:relative;width:44px;height:24px}
        .toggle input{opacity:0;width:0;height:0}
        .slider{position:absolute;inset:0;background:#ddd;border-radius:24px;transition:.3s;cursor:pointer}
        .slider:before{content:'';position:absolute;height:18px;width:18px;left:3px;top:3px;background:#fff;border-radius:50%;transition:.3s}
        input:checked+.slider{background:#C4748C}
        input:checked+.slider:before{transform:translateX(20px)}
        @media(max-width:600px){.grid2,.grid3{grid-template-columns:1fr}}
    </style>
</head>
<body>

<header class="admin-header">
    <i class="fas fa-spa"></i>
    <h1>Painel Admin</h1>
    <nav class="admin-nav">
        <a href="{{ route('admin.servicos.index') }}" class="active"><i class="fas fa-concierge-bell"></i> Serviços</a>
        <a href="{{ route('admin.contatos') }}"><i class="fas fa-envelope"></i> Contatos</a>
        <a href="{{ route('admin.antes-depois.index') }}"><i class="fas fa-images"></i> Antes/Depois</a>
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Ver Site</a>
    </nav>
</header>

<main class="content">

    @if(session('success'))
    <div class="flash"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    {{-- Adicionar serviço --}}
    <div class="card">
        <div class="card-head"><i class="fas fa-plus-circle"></i> Adicionar Serviço</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.servicos.store') }}">
                @csrf
                <div class="grid3" style="margin-bottom:1rem">
                    <div class="form-group">
                        <label>Ícone (Font Awesome)</label>
                        <input type="text" name="icone" placeholder="fas fa-spa" value="{{ old('icone','fas fa-spa') }}" required>
                        <span class="form-hint">Ex: fas fa-spa, fas fa-magic, fas fa-hands</span>
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
                <div class="grid2" style="margin-bottom:1rem">
                    <div class="form-group">
                        <label>Descrição *</label>
                        <textarea name="descricao" placeholder="Descrição do serviço..." required>{{ old('descricao') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ordem de exibição</label>
                        <input type="number" name="ordem" placeholder="0" value="{{ old('ordem',0) }}" min="0">
                        <span class="form-hint">Menor número aparece primeiro</span>
                    </div>
                </div>
                <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Adicionar Serviço</button>
            </form>
        </div>
    </div>

    {{-- Lista --}}
    <div class="card">
        <div class="card-head"><i class="fas fa-list"></i> Serviços Cadastrados ({{ $servicos->count() }})</div>
        @if($servicos->isEmpty())
            <div class="empty"><i class="fas fa-concierge-bell fa-2x"></i><p style="margin-top:.75rem">Nenhum serviço cadastrado ainda.</p></div>
        @else
        <table>
            <thead>
                <tr>
                    <th>Ordem</th>
                    <th>Ícone</th>
                    <th>Título</th>
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
                    <td><strong>{{ $s->titulo }}</strong><br><small style="color:#999">{{ Str::limit($s->descricao, 60) }}</small></td>
                    <td>{{ $s->preco ?? '–' }}</td>
                    <td><span class="{{ $s->ativo ? 'badge-on' : 'badge-off' }}">{{ $s->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                    <td>
                        <div class="actions">
                            <button class="btn-sm btn-edit" onclick="openEdit({{ $s->id }}, '{{ addslashes($s->icone) }}', '{{ addslashes($s->titulo) }}', '{{ addslashes($s->descricao) }}', '{{ addslashes($s->preco ?? '') }}', {{ $s->ordem }}, {{ $s->ativo ? 'true' : 'false' }})">
                                <i class="fas fa-pen"></i> Editar
                            </button>
                            <form method="POST" action="{{ route('admin.servicos.destroy', $s->id) }}" onsubmit="return confirm('Remover este serviço?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</main>

{{-- Modal editar --}}
<div class="modal-bg" id="editModal">
    <div class="modal">
        <div class="modal-head">
            <span><i class="fas fa-pen"></i> Editar Serviço</span>
            <button onclick="closeEdit()" style="background:none;border:none;color:#fff;font-size:1.2rem;cursor:pointer"><i class="fas fa-times"></i></button>
        </div>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="grid3" style="margin-bottom:1rem">
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
                <div class="grid2" style="margin-bottom:1rem">
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
                <button type="submit" class="btn-add"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEdit(id, icone, titulo, descricao, preco, ordem, ativo) {
    document.getElementById('editForm').action = '/admin/servicos/' + id;
    document.getElementById('edit_icone').value = icone;
    document.getElementById('edit_titulo').value = titulo;
    document.getElementById('edit_descricao').value = descricao;
    document.getElementById('edit_preco').value = preco;
    document.getElementById('edit_ordem').value = ordem;
    document.getElementById('edit_ativo').checked = ativo;
    document.getElementById('editModal').classList.add('open');
}
function closeEdit() {
    document.getElementById('editModal').classList.remove('open');
}
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEdit();
});
</script>
</body>
</html>
