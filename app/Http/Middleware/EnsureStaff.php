<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaff
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role?->name !== 'staff') {
            abort(403, 'Halaman ini hanya dapat diakses oleh Staff.');
        }

        return $next($request);
    }
}
