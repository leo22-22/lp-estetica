<?php

namespace App\Data;

class DefaultServicos
{
    public static function all(): array
    {
        return [
            ['icone' => 'fas fa-spa',        'titulo' => 'Limpeza de Pele',    'descricao' => 'Procedimento essencial para manter a pele saudável, removendo impurezas, células mortas, excesso de oleosidade e cravos. Pele mais limpa, uniforme e iluminada.', 'preco' => 'A partir de R$ 120', 'ordem' => 1],
            ['icone' => 'fas fa-paint-brush', 'titulo' => 'Micropigmentação',   'descricao' => 'Sobrancelhas, lábios e cílios com técnicas avançadas. Design personalizado para realçar sua beleza natural.', 'preco' => 'A partir de R$ 350', 'ordem' => 2],
            ['icone' => 'fas fa-hands',       'titulo' => 'Massagem Relaxante', 'descricao' => 'Técnicas especializadas para aliviar tensões, melhorar a circulação e proporcionar bem-estar total.',         'preco' => 'A partir de R$ 90',  'ordem' => 3],
            ['icone' => 'fas fa-magic',       'titulo' => 'Peeling Facial',     'descricao' => 'Renovação celular profunda para tratar manchas, acne e envelhecimento. Pele mais jovem e luminosa.',          'preco' => 'A partir de R$ 150', 'ordem' => 4],
            ['icone' => 'fas fa-sun',         'titulo' => 'Radiofrequência',    'descricao' => 'Tecnologia avançada para firmeza e rejuvenescimento. Estimula o colágeno e melhora o contorno facial.',       'preco' => 'A partir de R$ 200', 'ordem' => 5],
            ['icone' => 'fas fa-heart',       'titulo' => 'Drenagem Linfática', 'descricao' => 'Técnica manual para redução de inchaço, eliminação de toxinas e melhora da circulação linfática.',            'preco' => 'A partir de R$ 110', 'ordem' => 6],
        ];
    }

    public static function titulos(): array
    {
        return array_column(self::all(), 'titulo');
    }
}
