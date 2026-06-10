@extends('layouts.admin')

@section('title', 'Contatos')
@section('topbar-title', 'Contatos')

@section('content')

<div class="stats-row">
    <div class="stat-card">
        <strong>{{ $contatos->total() }}</strong>
        <span>Total</span>
    </div>
    <div class="stat-card">
        <strong>{{ $pendentes }}</strong>
        <span>Pendentes</span>
    </div>
    <div class="stat-card">
        <strong>{{ $atendidos }}</strong>
        <span>Atendidos</span>
    </div>
</div>

<div class="card">
    <div class="card-head"><i class="fas fa-envelope"></i> Mensagens recebidas</div>

    @if($contatos->isEmpty())
        <div style="text-align:center;padding:3rem;color:#aaa">
            <i class="fas fa-inbox fa-2x"></i>
            <p style="margin-top:.75rem">Nenhum contato ainda.</p>
        </div>
    @else
    <div style="overflow-x:auto">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Telefone</th>
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
                        <a href="https://wa.me/55{{ preg_replace('/\D/','',$c->telefone) }}" target="_blank"
                           style="color:#25d366;text-decoration:none">
                            <i class="fab fa-whatsapp"></i> {{ $c->telefone }}
                        </a>
                    </td>
                    <td>{{ $c->servico }}</td>
                    <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#666;font-size:.82rem"
                        title="{{ $c->mensagem }}">{{ $c->mensagem ?? '–' }}</td>
                    <td>
                        <span class="badge {{ $c->atendido ? 'badge-ok' : 'badge-new' }}">
                            {{ $c->atendido ? 'Atendido' : 'Novo' }}
                        </span>
                    </td>
                    <td style="white-space:nowrap">{{ $c->created_at->format('d/m/y H:i') }}</td>
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
    </div>
    <div style="padding:1rem;display:flex;justify-content:center">
        {{ $contatos->links() }}
    </div>
    @endif
</div>

@endsection
