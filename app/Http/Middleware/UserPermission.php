<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission_key, $action): Response
    {
        if(!checkPermission($permission_key, $action)) {
            return redirect()->route('admin.no.permission')->with([
                'status' => 'error',
                'sms' => 'You do not have permission to perform this action.'
            ]);
        }
        return $next($request);
    }
}
