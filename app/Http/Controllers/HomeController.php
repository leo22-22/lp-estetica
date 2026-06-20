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
            ['nome' => 'Amanda',   'foto' => null, 'texto' => 'Oii dudinha, tudo bem? Amei a experiência! Além do atendimento ser excelente, você foi muito atenciosa e cuidadosa comigo. Minha pele ficou incrível depois da limpeza, com sensação de pele macia. Com certeza faria novamente e recomendo seu trabalho! 💖', 'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Chirlei',  'foto' => null, 'texto' => 'Fiz minha limpeza de pele com essa maravilhosa — super atenciosa, calma e mãos de fada! Minha pele ficou super macia e mais suave, amei! Super recomendo. Obrigada Eduarda pelo profissionalismo e carinho ❤️', 'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Duda',     'foto' => null, 'texto' => 'Duda, ameei a limpeza!! 😍 Você tem mãos de fada — saí até mais leve, pele iluminada 💖 Quero voltar mais vezes!', 'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Idanilde', 'foto' => null, 'texto' => 'Nunca havia feito uma limpeza de pele antes, essa foi minha primeira vez. A Eduarda me esclareceu certas dúvidas e vi que nossa pele realmente precisa de cuidados especiais. Amei o trabalho e o atendimento — sabe muito bem o que se propõe a fazer. A minha pele agradece essas mãozinhas. Obrigada pelos cuidados, com certeza voltarei! ❤️', 'servico' => 'Limpeza de Pele', 'estrelas' => 5],
            ['nome' => 'Pedro',    'foto' => null, 'texto' => 'Ótima profissional, educada e simpática. Limpeza relaxante e com ótimos resultados! Preço totalmente acessível.', 'servico' => 'Limpeza de Pele', 'estrelas' => 5],
        ];
    }
}
