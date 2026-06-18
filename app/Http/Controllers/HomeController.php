<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'servicos'    => $this->getServicos(),
            'galeria'     => $this->getGaleria(),
            'antesDepois' => $this->getAntesDepois(),
            'depoimentos' => $this->getDepoimentos(),
        ]);
    }

    public function contato(Request $request)
    {
        $validated = $request->validate([
            'nome'     => 'required|string|max:100',
            'telefone' => ['required', 'string', 'max:20', 'regex:/^\(\d{2}\)\s?\d{4,5}-\d{4}$/'],
            'email'    => 'nullable|email|max:100',
            'servico'  => ['required', 'string', Rule::in(['Limpeza de Pele'])],
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

    private function getServicos(): array
    {
        return [
            [
                'icone'     => 'fas fa-spa',
                'titulo'    => 'Limpeza de Pele',
                'descricao' => 'Procedimento essencial para manter a pele saudável, removendo impurezas, células mortas, excesso de oleosidade e cravos. Contribui para a prevenção de acne e favorece a absorção dos produtos da sua rotina de cuidados diários. Cada atendimento é realizado de forma cuidadosa, respeitando as características e necessidades individuais de cada cliente.',
                'preco'     => 'R$ 85',
            ],
        ];
    }

    private function getGaleria(): array
    {
        return [
            ['titulo' => 'Resultado – Limpeza de Pele', 'categoria' => 'limpeza', 'imagem' => asset('img/antes-depois/depois1.jpeg')],
            ['titulo' => 'Resultado – Limpeza de Pele', 'categoria' => 'limpeza', 'imagem' => asset('img/antes-depois/depois2.jpeg')],
            ['titulo' => 'Resultado – Limpeza de Pele', 'categoria' => 'limpeza', 'imagem' => asset('img/antes-depois/depois3.jpeg')],
        ];
    }

    private function getAntesDepois(): \Illuminate\Support\Collection
    {
        return collect([
            (object)['servico' => 'Limpeza de Pele', 'titulo' => 'Resultado Real', 'foto_antes' => asset('img/antes-depois/antes1.jpeg'), 'foto_depois' => asset('img/antes-depois/depois1.jpeg')],
            (object)['servico' => 'Limpeza de Pele', 'titulo' => 'Resultado Real', 'foto_antes' => asset('img/antes-depois/antes2.jpeg'), 'foto_depois' => asset('img/antes-depois/depois2.jpeg')],
            (object)['servico' => 'Limpeza de Pele', 'titulo' => 'Resultado Real', 'foto_antes' => asset('img/antes-depois/antes3.jpeg'), 'foto_depois' => asset('img/antes-depois/depois3.jpeg')],
        ]);
    }

    private function getDepoimentos(): array
    {
        return [
            ['nome' => 'Ana Paula M.', 'foto' => null, 'texto' => 'A Eduarda é incrível! Fiz a limpeza de pele e ficou perfeito, minha pele nunca esteve tão saudável. Atendimento impecável, ambiente lindo e ela é muito cuidadosa. Super recomendo!', 'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Carla S.',     'foto' => null, 'texto' => 'Finalmente encontrei uma profissional de confiança! A limpeza de pele foi maravilhosa, minha pele ficou completamente renovada. Já agendei a próxima sessão!',                                  'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Fernanda L.',  'foto' => null, 'texto' => 'Atendimento humanizado e muito cuidadoso! Saí completamente satisfeita, pele renovada e muito mais saudável. A Eduarda tem um dom especial para fazer você se sentir bem.',                         'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Juliana R.',   'foto' => null, 'texto' => 'Minha pele nunca ficou tão bonita! A profissional é muito atenciosa e o resultado foi além das minhas expectativas. Ambiente acolhedor e atendimento de alta qualidade.',                             'servico' => 'Limpeza de Pele', 'estrelas' => 5],
        ];
    }
}
