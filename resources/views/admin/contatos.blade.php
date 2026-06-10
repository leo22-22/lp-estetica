<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos – Admin | Eduarda Cardoso Estética</title>
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
        .content{max-width:1200px;margin:2rem auto;padding:0 1rem}
        .flash{background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:.8rem 1.2rem;border-radius:10px;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem}
        .stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:1rem;margin-bottom:2rem}
        .stat{background:#fff;border-radius:12px;padding:1.2rem;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.06)}
        .stat strong{display:block;font-size:2rem;color:#8B4F6F}
        .stat span{font-size:.82rem;color:#666}
        .card{background:#fff;border-radius:14px;box-shadow:0 2px 10px rgba(0,0,0,.07);overflow:hidden}
        table{width:100%;border-collapse:collapse}
        thead{background:#8B4F6F;color:#fff}
        th,td{padding:.8rem 1rem;text-align:left;font-size:.88rem;vertical-align:middle}
        tr:nth-child(even){background:#fdf6f6}
        tr:hover{background:#f9eaea}
        .badge{padding:.2rem .6rem;border-radius:20px;font-size:.75rem;font-weight:700;white-space:nowrap}
        .badge-novo{background:#f2c0d0;color:#6b2040}
        .badge-ok{background:#c8e6c9;color:#2e7d32}
        .empty{text-align:center;padding:3rem;color:#aaa}
        .pagination{margin-top:1.5rem;display:flex;gap:.5rem;justify-content:center;flex-wrap:wrap}
        .pagination a,.pagination span{padding:.4rem .8rem;border-radius:6px;background:#fff;color:#8B4F6F;border:1px solid #e0c8d0;text-decoration:none;font-size:.85rem}
        .pagination .active span{background:#8B4F6F;color:#fff;border-color:#8B4F6F}
        .btn-sm{padding:.3rem .7rem;border-radius:6px;font-size:.78rem;font-weight:700;cursor:pointer;border:none;transition:.2s;text-decoration:none;display:inline-flex;align-items:center;gap:.3rem}
        .btn-ok{background:#c8e6c9;color:#1b5e20}
        .btn-ok:hover{background:#1b5e20;color:#fff}
        .btn-del{background:#fce4ec;color:#c62828}
        .btn-del:hover{background:#c62828;color:#fff}
        .msg-text{max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#666;font-size:.82rem}
        a.wpp{color:#25d366;text-decoration:none}
        a.wpp:hover{text-decoration:underline}
        @media(max-width:700px){
            th:nth-child(4),td:nth-child(4),
            th:nth-child(6),td:nth-child(6){display:none}
        }
    </style>
</head>
<body>

<header class="admin-header">
    <i class="fas fa-spa"></i>
    <h1>Painel Admin</h1>
    <nav class="admin-nav">
        <a href="{{ route('admin.contatos') }}" class="active"><i class="fas fa-envelope"></i> Contatos</a>
        <a href="{{ route('admin.servicos.index') }}"><i class="fas fa-concierge-bell"></i> Serviços</a>
        <a href="{{ route('admin.antes-depois.index') }}"><i class="fas fa-images"></i> Antes/Depois</a>
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Ver Site</a>
    </nav>
</header>

<main class="content">

    @if(session('success'))
    <div class="flash"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="stats">
        <div class="stat">
            <strong>{{ $contatos->total() }}</strong>
            <span>Total</span>
        </div>
        <div class="stat">
            <strong>{{ $pendentes }}</strong>
            <span>Pendentes</span>
        </div>
        <div class="stat">
            <strong>{{ $atendidos }}</strong>
            <span>Atendidos</span>
        </div>
    </div>

    <div class="card">
        @if($contatos->isEmpty())
            <div class="empty"><i class="fas fa-inbox fa-2x"></i><p style="margin-top:.75rem">Nenhum contato ainda.</p></div>
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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contatos as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><strong>{{ $c->nome }}</strong></td>
                    <td>
                        <a class="wpp" href="https://wa.me/55{{ preg_replace('/\D/','',$c->telefone) }}" target="_blank">
                            <i class="fab fa-whatsapp"></i> {{ $c->telefone }}
                        </a>
                    </td>
                    <td>{{ $c->email ?? '–' }}</td>
                    <td>{{ $c->servico }}</td>
                    <td class="msg-text" title="{{ $c->mensagem }}">{{ $c->mensagem ?? '–' }}</td>
                    <td>
                        <span class="badge {{ $c->atendido ? 'badge-ok' : 'badge-novo' }}">
                            {{ $c->atendido ? 'Atendido' : 'Novo' }}
                        </span>
                    </td>
                    <td>{{ $c->created_at->format('d/m/y H:i') }}</td>
                    <td>
                        <div style="display:flex;gap:.3rem;flex-wrap:wrap">
                            @if(!$c->atendido)
                            <form method="POST" action="{{ route('admin.contatos.atender', $c->id) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-sm btn-ok" title="Marcar atendido">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.contatos.destroy', $c->id) }}"
                                  onsubmit="return confirm('Remover este contato?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del" title="Remover">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination" style="padding:1rem">
            {{ $contatos->links() }}
        </div>
        @endif
    </div>

</main>
</body>
</html>
