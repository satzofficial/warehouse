<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class VerifyCustomCsrfTokenMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if ($request->isMethod('get')) {
      return $next($request);
    }
    // Check for the special CSRF token
    $specialCsrfToken = $request->header('X-Special-CSRF-Token');
    if (Hash::check($request->session()->token(), $specialCsrfToken)) {
      return $next($request);
    }

    abort(419, 'Special CSRF Token Mismatch');
  }
}