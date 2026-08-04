<?php

namespace App\Http\Middleware;

use App\Models\DesaProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class BindDesaSlug
{
    public function handle(Request $request, Closure $next): Response
    {
        $slug = 'nama-desa';

        try {
            if (Schema::hasTable('desa_profiles')) {
                if ($request->route() && $request->route()->hasParameter('desa_slug')) {
                    $routeSlug = $request->route('desa_slug');
                    $profile = DesaProfile::where('slug', $routeSlug)->first();
                    if ($profile) {
                        DesaProfile::setCurrent($profile);
                        $slug = $profile->slug;
                    } else {
                        $profile = DesaProfile::current();
                        $slug = $profile->slug ?: 'nama-desa';
                    }
                } else {
                    $profile = DesaProfile::current();
                    $slug = $profile->slug ?: 'nama-desa';
                }
            }
        } catch (\Throwable $e) {
            // Fallback for unmigrated database state in tests
        }

        URL::defaults([
            'desa_slug' => $slug,
        ]);

        if ($request->route() && $request->route()->hasParameter('desa_slug')) {
            $routeSlug = $request->route('desa_slug');

            if ($routeSlug && $routeSlug !== $slug && !empty($slug)) {
                $currentPath = $request->path();
                $newPath = preg_replace('#^'.preg_quote($routeSlug, '#').'#', $slug, $currentPath);

                $queryString = $request->getQueryString();
                $targetUrl = url($newPath).($queryString ? '?'.$queryString : '');

                return redirect()->to($targetUrl, 301);
            }

            $request->route()->forgetParameter('desa_slug');
        }

        return $next($request);
    }
}
