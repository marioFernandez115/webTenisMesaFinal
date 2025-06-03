<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
  public function handle($request, Closure $next)
{
    if (auth()->user() && auth()->user()->rol === 'mantenimiento') {
        return $next($request);
    }

    abort(403, 'No tienes permiso para acceder a esta sección.');
}
}