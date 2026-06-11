<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntesDepois extends Model
{
    protected $table = 'antes_depois';

    protected $fillable = [
        'titulo',
        'servico',
        'foto_antes',
        'foto_depois',
        'ativo',
        'ordem',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'ordem' => 'integer',
    ];
}
