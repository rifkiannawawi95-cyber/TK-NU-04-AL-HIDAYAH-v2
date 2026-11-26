<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VercelEdgeCache
{
    /**
     * Handle an incoming request and set Vercel Edge caching headers for public pages.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && !auth()->check() && $response->isSuccessful()) {
            // Vercel Edge CDN caches this response for 5 minutes, 
            // and serves stale cache instantly while updating in the background for 24 hours.
            $response->headers->set('Cache-Control', 'public, s-maxage=300, stale-while-revalidate=86400');
        }

        return $response;
    }
}
