<?php

namespace Bagoesz21\ConsoleBrowser\Http\Middlewares;

use Closure;
use Illuminate\Http\Response;

class Console
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $credentials = config('console-browser.credentials');

        if ($request->getUser() !== $credentials['username'] || $request->getPassword() !== $credentials['password']) {
            $headers = ['WWW-Authenticate' => 'Basic'];
            return new Response('Invalid credentials.', 401, $headers);
        }

        return $next($request);
    }
}
