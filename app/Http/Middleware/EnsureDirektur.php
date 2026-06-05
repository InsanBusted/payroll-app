<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDirektur
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role?->name !== 'direktur') {
            abort(403, 'Halaman ini hanya dapat diakses oleh Direktur.');
        }

        return $next($request);
    }
}
