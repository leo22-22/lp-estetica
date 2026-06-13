<?php

namespace App\Http\Controllers;

use App\Data\DefaultServicos;
use App\Models\AntesDepois;
use App\Models\Contato;
use App\Models\Galeria;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        $servicosDb = Servico::where('ativo', true)->orderBy('ordem')->get();
        $servicos   = $servicosDb->isNotEmpty()
            ? $servicosDb->map(fn($s) => ['icone' => $s->icone, 'titulo' => $s->titulo, 'descricao' => $s->descricao, 'preco' => $s->preco])->toArray()
            : DefaultServicos::all();

        $galeriaDb  = Galeria::where('ativo', true)->orderBy('ordem')->orderBy('id')->get();
        $galeria    = $galeriaDb->isNotEmpty()
            ? $galeriaDb->map(fn($g) => ['titulo' => $g->titulo, 'categoria' => $g->categoria, 'imagem' => $g->imagem])->toArray()
            : $this->getGaleria();

        $antesDepois = AntesDepois::where('ativo', true)->orderBy('ordem')->orderBy('created_at', 'desc')->get();
        $depoimentos = $this->getDepoimentos();

        return view('home', compact('servicos', 'depoimentos', 'galeria', 'antesDepois'));
    }

    public function contato(Request $request)
    {
        $titulos = Servico::where('ativo', true)->pluck('titulo')->toArray();
        if (empty($titulos)) {
            $titulos = DefaultServicos::titulos();
        }

        $validated = $request->validate([
            'nome'     => 'required|string|max:100',
            'telefone' => ['required', 'string', 'max:20', 'regex:/^\(\d{2}\)\s?\d{4,5}-\d{4}$/'],
            'email'    => 'nullable|email|max:100',
            'servico'  => ['required', 'string', Rule::in($titulos)],
            'mensagem' => 'nullable|string|max:500',
        ], [
            'nome.required'     => 'O nome é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.regex'    => 'Informe um telefone válido, ex: (11) 99999-9999.',
            'servico.required'  => 'Selecione um serviço.',
            'servico.in'        => 'Selecione um serviço válido da lista.',
        ]);

        Contato::create($validated);

        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('home')->with('success', 'Mensagem enviada! Em breve entraremos em contato. 💕');
    }

    private function getDepoimentos(): array
    {
        return [
            ['nome' => 'Ana Paula M.', 'foto' => null, 'texto' => 'A Eduarda é incrível! Fiz a micropigmentação das sobrancelhas e ficou perfeito, super natural. Atendimento impecável, ambiente lindo e ela é muito cuidadosa. Super recomendo!', 'servico' => 'Micropigmentação',  'estrelas' => 5],
            ['nome' => 'Carla S.',     'foto' => null, 'texto' => 'Finalmente encontrei uma profissional de confiança! A limpeza de pele foi maravilhosa, minha pele ficou completamente renovada. Já agendei a próxima sessão!',                    'servico' => 'Limpeza de Pele',    'estrelas' => 5],
            ['nome' => 'Fernanda L.',  'foto' => null, 'texto' => 'A massagem relaxante foi terapêutica! Saí completamente renovada, sem nenhuma tensão. A Eduarda tem um dom especial para fazer você se sentir bem. Ambiente muito acolhedor.',            'servico' => 'Massagem Relaxante', 'estrelas' => 5],
            ['nome' => 'Juliana R.',   'foto' => null, 'texto' => 'Fiz radiofrequência e os resultados foram além das minhas expectativas! Pele visivelmente mais firme e rejuvenescida. Profissional altamente qualificada e atenciosa.',                 'servico' => 'Radiofrequência',    'estrelas' => 5],
        ];
    }

    private function getGaleria(): array
    {
        return [
            ['titulo' => 'Micropigmentação Natural',  'categoria' => 'micropigmentacao', 'imagem' => null],
            ['titulo' => 'Limpeza de Pele',           'categoria' => 'limpeza',          'imagem' => null],
            ['titulo' => 'Tratamento Facial',         'categoria' => 'facial',           'imagem' => null],
            ['titulo' => 'Sobrancelhas Perfeitas',    'categoria' => 'micropigmentacao', 'imagem' => null],
            ['titulo' => 'Massagem Relaxante',        'categoria' => 'massagem',         'imagem' => null],
            ['titulo' => 'Resultado Radiofrequência', 'categoria' => 'radiofrequencia',  'imagem' => null],
        ];
    }
}
