<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AllowedIp;

class RestrictIpAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if open all is enabled
        $openAll = AllowedIp::where('open_all', 1)->where('status', 1)->exists();
        
        if ($openAll) {
            return $next($request);
        }
        
        $allowedIps = AllowedIp::where('status', 1)->where('open_all', 0)->pluck('ip_address')->toArray();
        
        // Always allow localhost for development
        $allowedIps[] = '127.0.0.1';
        $allowedIps[] = '::1';
        
        $clientIp = $request->ip();

        if (!in_array($clientIp, $allowedIps)) {
            abort(403, 'Access denied from your IP address: ' . $clientIp);
        }

        return $next($request);
    }
}