<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->shouldForce($request)) {
            return $next($request);
        }

        if ($request->secure()) {
            return $next($request);
        }

        return redirect()->secure($request->getRequestUri(), 301);
    }

    protected function shouldForce(Request $request): bool
    {
        if (! app()->environment('production')) {
            return false;
        }

        return (bool) config('seo.force_https', true);
    }
}
