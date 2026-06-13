<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function index()
    {
        $items = Galeria::orderBy('ordem')->orderBy('id')->get();
        return view('admin.galeria.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|string|max:100',
            'categoria' => 'required|string|max:50',
            'imagem'    => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'ordem'     => 'nullable|integer',
        ]);

        $path = $request->file('imagem')->store('galeria', 'public');

        if ($path === false) {
            return back()->withErrors(['imagem' => 'Falha ao salvar a imagem. Verifique as permissões de storage.'])->withInput();
        }

        Galeria::create([
            'titulo'    => $request->titulo,
            'categoria' => $request->categoria,
            'imagem'    => $path,
            'ordem'     => $request->ordem ?? 0,
        ]);

        return redirect()->route('admin.galeria.index')->with('success', 'Foto adicionada à galeria!');
    }

    public function update(Request $request, Galeria $galeria)
    {
        $request->validate([
            'titulo'    => 'required|string|max:100',
            'categoria' => 'required|string|max:50',
            'ordem'     => 'nullable|integer',
        ]);

        $galeria->update([
            'titulo'    => $request->titulo,
            'categoria' => $request->categoria,
            'ordem'     => $request->ordem ?? 0,
            'ativo'     => $request->boolean('ativo', true),
        ]);

        return redirect()->route('admin.galeria.index')->with('success', 'Foto atualizada!');
    }

    public function destroy(Galeria $galeria)
    {
        \Storage::disk('public')->delete($galeria->imagem);
        $galeria->delete();
        return redirect()->route('admin.galeria.index')->with('success', 'Foto removida.');
    }
}
