<?php

namespace App\Http\Controllers;

use App\Models\AntesDepois;
use App\Models\Contato;
use App\Models\Servico;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $servicosDb  = Servico::where('ativo', true)->orderBy('ordem')->get();
        $servicos    = $servicosDb->isNotEmpty()
            ? $servicosDb->map(fn($s) => ['icone' => $s->icone, 'titulo' => $s->titulo, 'descricao' => $s->descricao, 'preco' => $s->preco])->toArray()
            : $this->getServicos();
        $depoimentos = $this->getDepoimentos();
        $galeria     = $this->getGaleria();
        $antesDepois = AntesDepois::where('ativo', true)
            ->orderBy('ordem')->orderBy('created_at', 'desc')
            ->get();

        return view('home', compact('servicos', 'depoimentos', 'galeria', 'antesDepois'));
    }

    public function contato(Request $request)
    {
        $validated = $request->validate([
            'nome'     => 'required|string|max:100',
            'telefone' => 'required|string|max:20',
            'email'    => 'nullable|email|max:100',
            'servico'  => 'required|string|max:100',
            'mensagem' => 'nullable|string|max:500',
        ], [
            'nome.required'     => 'O nome é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'servico.required'  => 'Selecione um serviço.',
        ]);

        Contato::create($validated);

        return redirect()->route('home')
            ->with('success', 'Mensagem enviada com sucesso! Em breve entraremos em contato. 💕');
    }

    public function listarContatos()
    {
        $contatos = Contato::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contatos', compact('contatos'));
    }

    private function getServicos(): array
    {
        return [
            [
                'icone'    => 'fas fa-spa',
                'titulo'   => 'Limpeza de Pele',
                'descricao' => 'Limpeza profunda com extração, hidratação e revitalização da pele. Resultado imediato e pele renovada.',
                'preco'    => 'A partir de R$ 120',
            ],
            [
                'icone'    => 'fas fa-paint-brush',
                'titulo'   => 'Micropigmentação',
                'descricao' => 'Sobrancelhas, lábios e cílios com técnicas avançadas. Design personalizado para realçar sua beleza natural.',
                'preco'    => 'A partir de R$ 350',
            ],
            [
                'icone'    => 'fas fa-hands',
                'titulo'   => 'Massagem Relaxante',
                'descricao' => 'Técnicas especializadas para aliviar tensões, melhorar a circulação e proporcionar bem-estar total.',
                'preco'    => 'A partir de R$ 90',
            ],
            [
                'icone'    => 'fas fa-magic',
                'titulo'   => 'Peeling Facial',
                'descricao' => 'Renovação celular profunda para tratar manchas, acne e envelhecimento. Pele mais jovem e luminosa.',
                'preco'    => 'A partir de R$ 150',
            ],
            [
                'icone'    => 'fas fa-sun',
                'titulo'   => 'Radiofrequência',
                'descricao' => 'Tecnologia avançada para firmeza e rejuvenescimento. Estimula o colágeno e melhora o contorno facial.',
                'preco'    => 'A partir de R$ 200',
            ],
            [
                'icone'    => 'fas fa-heart',
                'titulo'   => 'Drenagem Linfática',
                'descricao' => 'Técnica manual para redução de inchaço, eliminação de toxinas e melhora da circulação linfática.',
                'preco'    => 'A partir de R$ 110',
            ],
        ];
    }

    private function getDepoimentos(): array
    {
        return [
            [
                'nome'      => 'Ana Paula M.',
                'foto'      => null,
                'texto'     => 'A Eduarda é incrível! Fiz a micropigmentação das sobrancelhas e ficou perfeito, super natural. Atendimento impecável, ambiente lindo e ela é muito cuidadosa. Super recomendo!',
                'servico'   => 'Micropigmentação',
                'estrelas'  => 5,
            ],
            [
                'nome'      => 'Carla S.',
                'foto'      => null,
                'texto'     => 'Finalmente encontrei uma profissional de confiança! A limpeza de pele foi maravilhosa, minha pele ficou completamente renovada. Já agendei a próxima sessão!',
                'servico'   => 'Limpeza de Pele',
                'estrelas'  => 5,
            ],
            [
                'nome'      => 'Fernanda L.',
                'foto'      => null,
                'texto'     => 'A massagem relaxante foi terapêutica! Saí completamente renovada, sem nenhuma tensão. A Eduarda tem um dom especial para fazer você se sentir bem. Ambiente muito acolhedor.',
                'servico'   => 'Massagem Relaxante',
                'estrelas'  => 5,
            ],
            [
                'nome'      => 'Juliana R.',
                'foto'      => null,
                'texto'     => 'Fiz radiofrequência e os resultados foram além das minhas expectativas! Pele visivelmente mais firme e rejuvenescida. Profissional altamente qualificada e atenciosa.',
                'servico'   => 'Radiofrequência',
                'estrelas'  => 5,
            ],
        ];
    }

    private function getGaleria(): array
    {
        return [
            ['titulo' => 'Micropigmentação Natural', 'categoria' => 'micropigmentacao'],
            ['titulo' => 'Limpeza de Pele', 'categoria' => 'limpeza'],
            ['titulo' => 'Tratamento Facial', 'categoria' => 'facial'],
            ['titulo' => 'Sobrancelhas Perfeitas', 'categoria' => 'micropigmentacao'],
            ['titulo' => 'Massagem Relaxante', 'categoria' => 'massagem'],
            ['titulo' => 'Resultado Radiofrequência', 'categoria' => 'radiofrequencia'],
        ];
    }
}
