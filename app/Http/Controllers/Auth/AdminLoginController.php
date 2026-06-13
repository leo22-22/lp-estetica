<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'senha'   => 'required',
        ], [
            'usuario.required' => 'Informe o usuário.',
            'senha.required'   => 'Informe a senha.',
        ]);

        $expectedUser = config('admin.user');
        $expectedPass = config('admin.password');

        if (
            !empty($expectedPass) &&
            hash_equals($expectedUser, $request->usuario) &&
            hash_equals($expectedPass, $request->senha)
        ) {
            $request->session()->put('admin_authenticated', true);
            $request->session()->regenerate();
            $intended = $request->session()->pull('url.intended', route('admin.index'));
            return redirect($intended);
        }

        return back()
            ->withErrors(['senha' => 'Usuário ou senha incorretos.'])
            ->withInput(['usuario' => $request->usuario]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}
