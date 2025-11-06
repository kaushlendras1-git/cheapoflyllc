<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictIpAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedIps = [
            '49.200.60.18',
            '59.145.232.54',
            '182.72.183.22'
        ];

        $clientIp = $request->ip();

        if (!in_array($clientIp, $allowedIps)) {
           # abort(403, 'Access denied from your IP address.');
        }

        return $next($request);
    }
}