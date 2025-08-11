<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDeveloper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role_id != 1) {
            return redirect()->route('admin.no_permission')->with([
                'status' => 'error',
                'sms' => 'You do not have permission to access this page.'
            ]);
        }
        return $next($request);   
    }
}
