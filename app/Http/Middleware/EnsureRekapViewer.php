<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRekapViewer
{
    /**
     * Izinkan akses hanya untuk role direktur atau finance.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = $request->user()?->role?->name;

        if (!in_array($role, ['direktur', 'finance', 'superadmin'])) {
            abort(403, 'Halaman ini hanya dapat diakses oleh Direktur, Finance, atau Superadmin.');
        }

        return $next($request);
    }
}
