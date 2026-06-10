<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['icone', 'titulo', 'descricao', 'preco', 'ativo', 'ordem'];
    protected $casts    = ['ativo' => 'boolean', 'ordem' => 'integer'];
}
