<?php

namespace Database\Seeders;

use App\Data\DefaultServicos;
use App\Models\Servico;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (DefaultServicos::all() as $s) {
            Servico::firstOrCreate(
                ['titulo' => $s['titulo']],
                array_merge($s, ['ativo' => true])
            );
        }
    }
}
