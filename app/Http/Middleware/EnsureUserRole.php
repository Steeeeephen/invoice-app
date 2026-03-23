<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // My first thought was to have two separate middlewares to handle checking admin and super_admin status, but this is how one middleware can handle both.
    // Added the parameter 'string ...$roles'; this collects the strings passed to the middleware (check the route after the colon.
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // The middleware checks the users' role in the request, and if it is not in that array, it will do an abort 403
        // This can be seen again in the routes, where certain routes contain admin, super_admin, and some only contain super_admin.
        if(!in_array($request->user()->role, $roles)) {
           return redirect('/')->with('error', 'You do not have permission to do that!');
        }

        return $next($request);
    }
}
