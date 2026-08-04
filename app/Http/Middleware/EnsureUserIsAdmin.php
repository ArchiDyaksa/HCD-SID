<?php

namespace App\Http\Middleware;

use App\Models\DesaProfile;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $user = auth()->user();

        // If user is super_admin, allow access to all villages
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // If user is village admin, check matching desa_profile_id with current active village
        $currentDesa = DesaProfile::current();

        if ($user->desa_profile_id && $currentDesa && (int)$user->desa_profile_id !== (int)$currentDesa->id) {
            abort(403, 'Akses ditolak! Anda tidak memiliki wewenang mengelola data Desa ini.');
        }

        return $next($request);
    }
}