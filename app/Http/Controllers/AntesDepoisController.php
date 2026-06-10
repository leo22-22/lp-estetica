<?php

namespace App\Http\Controllers;

use App\Models\AntesDepois;
use Illuminate\Http\Request;

class AntesDepoisController extends Controller
{
    public function index()
    {
        $items = AntesDepois::where('ativo', true)
            ->orderBy('ordem')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.antes-depois.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'      => 'required|string|max:100',
            'servico'     => 'required|string|max:100',
            'foto_antes'  => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'foto_depois' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'ordem'       => 'nullable|integer',
        ]);

        $antes  = $request->file('foto_antes')->store('antes-depois', 'public');
        $depois = $request->file('foto_depois')->store('antes-depois', 'public');

        AntesDepois::create([
            'titulo'      => $validated['titulo'],
            'servico'     => $validated['servico'],
            'foto_antes'  => $antes,
            'foto_depois' => $depois,
            'ordem'       => $validated['ordem'] ?? 0,
        ]);

        return redirect()->route('admin.antes-depois.index')
            ->with('success', 'Par de fotos adicionado com sucesso!');
    }

    public function destroy(AntesDepois $antesDepois)
    {
        \Storage::disk('public')->delete([$antesDepois->foto_antes, $antesDepois->foto_depois]);
        $antesDepois->delete();

        return redirect()->route('admin.antes-depois.index')
            ->with('success', 'Removido com sucesso.');
    }
}
