<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos – Admin | Eduarda Cardoso Estética</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Lato',sans-serif; background:#f5f0f0; color:#333; }
        .admin-header { background:#8B4F6F; color:#fff; padding:1rem 2rem; display:flex; align-items:center; gap:1rem; }
        .admin-header h1 { font-size:1.3rem; }
        .admin-header a { color:#f2c0d0; text-decoration:none; font-size:.9rem; margin-left:auto; }
        .admin-content { max-width:1200px; margin:2rem auto; padding:0 1rem; }
        .admin-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:1rem; margin-bottom:2rem; }
        .stat-card { background:#fff; border-radius:12px; padding:1.2rem; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,.06); }
        .stat-card strong { display:block; font-size:2rem; color:#8B4F6F; }
        .stat-card span { font-size:.85rem; color:#666; }
        table { width:100%; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.06); border-collapse:collapse; }
        thead { background:#8B4F6F; color:#fff; }
        th, td { padding:.9rem 1rem; text-align:left; font-size:.9rem; }
        tr:nth-child(even) { background:#fdf6f6; }
        tr:hover { background:#f9eaea; }
        .badge { padding:.2rem .6rem; border-radius:20px; font-size:.75rem; }
        .badge-novo { background:#f2c0d0; color:#6b2040; }
        .badge-atendido { background:#c8e6c9; color:#2e7d32; }
        .empty { text-align:center; padding:3rem; color:#999; }
        .pagination { margin-top:1.5rem; display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; }
        .pagination a, .pagination span { padding:.4rem .8rem; border-radius:6px; background:#fff; color:#8B4F6F; border:1px solid #e0c8d0; text-decoration:none; font-size:.85rem; }
        .pagination .active span { background:#8B4F6F; color:#fff; border-color:#8B4F6F; }
    </style>
</head>
<body>
    <header class="admin-header">
        <i class="fas fa-spa"></i>
        <h1>Painel Admin – Contatos</h1>
        <a href="/"><i class="fas fa-arrow-left"></i> Ver Site</a>
    </header>

    <main class="admin-content">
        <div class="admin-stats">
            <div class="stat-card">
                <strong>{{ $contatos->total() }}</strong>
                <span>Total de Contatos</span>
            </div>
            <div class="stat-card">
                <strong>{{ $contatos->where('atendido', false)->count() }}</strong>
                <span>Pendentes</span>
            </div>
        </div>

        @if($contatos->isEmpty())
            <div class="empty"><i class="fas fa-inbox fa-2x"></i><p>Nenhum contato ainda.</p></div>
        @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Serviço</th>
                    <th>Mensagem</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contatos as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><strong>{{ $c->nome }}</strong></td>
                    <td><a href="https://wa.me/55{{ preg_replace('/\D/','',$c->telefone) }}" target="_blank">{{ $c->telefone }}</a></td>
                    <td>{{ $c->email ?? '–' }}</td>
                    <td>{{ $c->servico }}</td>
                    <td>{{ Str::limit($c->mensagem, 60) ?? '–' }}</td>
                    <td>
                        <span class="badge {{ $c->atendido ? 'badge-atendido' : 'badge-novo' }}">
                            {{ $c->atendido ? 'Atendido' : 'Novo' }}
                        </span>
                    </td>
                    <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $contatos->links() }}
        </div>
        @endif
    </main>
</body>
</html>
