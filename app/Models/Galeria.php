<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galeria';

    protected $fillable = ['titulo', 'categoria', 'imagem', 'ativo', 'ordem'];

    protected $casts = ['ativo' => 'boolean', 'ordem' => 'integer'];
}
