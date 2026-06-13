<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NormalizeTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if ($path === '/' || ! str_ends_with($path, '/')) {
            return $next($request);
        }

        $normalized = rtrim($path, '/');
        $query = $request->getQueryString();
        $target = $normalized.($query ? '?'.$query : '');

        return redirect($target, 301);
    }
}
