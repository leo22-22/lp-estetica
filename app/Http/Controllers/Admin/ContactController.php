<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contato;

class ContactController extends Controller
{
    public function index()
    {
        $contatos  = Contato::orderBy('created_at', 'desc')->paginate(20);
        $pendentes = Contato::where('atendido', false)->count();
        $atendidos = Contato::where('atendido', true)->count();

        return view('admin.contatos', compact('contatos', 'pendentes', 'atendidos'));
    }

    public function atender(int $id)
    {
        Contato::findOrFail($id)->update(['atendido' => true]);

        return redirect()->route('admin.contatos')->with('success', 'Contato marcado como atendido.');
    }

    public function destroy(int $id)
    {
        Contato::findOrFail($id)->delete();

        return redirect()->route('admin.contatos')->with('success', 'Contato removido.');
    }
}
