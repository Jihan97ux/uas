<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogResponse
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if ($request->is('event/get-json')) {
            Log::info('Response for /event/get-json', [
                'status' => $response->status(),
                'headers' => $response->headers->all(),
                'content' => $response->content()
            ]);
        }
        
        return $response;
    }
}