<?php
namespace App\Http\Middleware;

use Closure;

class ForceJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (strpos($request->getPathInfo(), '/api') === 0) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
