<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->getUser();
        $pass = $request->getPassword();

        $expectedUser = config('admin.user');
        $expectedPass = config('admin.password');

        if (
            empty($expectedPass) ||
            !hash_equals($expectedUser, (string) $user) ||
            !hash_equals($expectedPass, (string) $pass)
        ) {
            return response('Acesso negado.', 401, [
                'WWW-Authenticate' => 'Basic realm="Admin – Eduarda Cardoso Estética"',
            ]);
        }

        return $next($request);
    }
}
