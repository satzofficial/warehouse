<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add security headers
        // $response->headers->set('Content-Security-Policy', 'default-src \'self\'');
        // $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Add security headers
        // $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        // $response->headers->set('X-Content-Type-Options', 'nosniff');
        // $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        // $response->headers->set('X-XSS-Protection', '1; mode=block');

        // // Allow specific external domains (e.g., Google Fonts)
        // $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'self' https://fonts.googleapis.com;");
        // $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'self' https://buttons.github.io;");
        // $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'self' https://cdnjs.cloudflare.com;");
        // $response->headers->set('Content-Security-Policy', "default-src 'self'; style-src 'self' https://buttons.github.io;");
        

        $request->headers->set('X-Requested-With', 'XMLHttpRequests');
        $request->headers->set('X-Forwarded-Port', $request->getPort());        

        return $response;
    }
}
