<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCanonicalHost
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->environment('production')) {
            return $next($request);
        }

        $canonicalHost = parse_url(config('seo.site_url'), PHP_URL_HOST);

        if (! $canonicalHost || $request->getHost() === $canonicalHost) {
            return $next($request);
        }

        $target = rtrim(config('seo.site_url'), '/').$request->getRequestUri();

        return redirect()->away($target, 301);
    }
}
