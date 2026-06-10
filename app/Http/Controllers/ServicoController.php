<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::orderBy('ordem')->orderBy('id')->get();
        return view('admin.servicos.index', compact('servicos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icone'    => 'required|string|max:60',
            'titulo'   => 'required|string|max:100',
            'descricao'=> 'required|string|max:500',
            'preco'    => 'nullable|string|max:60',
            'ordem'    => 'nullable|integer',
        ]);
        $data['ativo'] = true;
        $data['ordem'] = $data['ordem'] ?? 0;
        Servico::create($data);

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço adicionado!');
    }

    public function update(Request $request, Servico $servico)
    {
        $data = $request->validate([
            'icone'    => 'required|string|max:60',
            'titulo'   => 'required|string|max:100',
            'descricao'=> 'required|string|max:500',
            'preco'    => 'nullable|string|max:60',
            'ordem'    => 'nullable|integer',
            'ativo'    => 'nullable',
        ]);
        $data['ativo'] = $request->boolean('ativo', true);
        $data['ordem'] = $data['ordem'] ?? 0;
        $servico->update($data);

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço atualizado!');
    }

    public function destroy(Servico $servico)
    {
        $servico->delete();
        return redirect()->route('admin.servicos.index')->with('success', 'Serviço removido!');
    }
}
