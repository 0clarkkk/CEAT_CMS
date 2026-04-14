<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilamentAdminAuthorize
{
    /**
     * Handle an incoming request for Filament admin panel.
     * Only allows admin and superadmin roles.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect('/login');
        }

        $userRole = $request->user()->role;

        if (! in_array($userRole, ['admin', 'superadmin'], true)) {
            abort(403, 'You do not have permission to access the admin panel.');
        }

        return $next($request);
    }
}
