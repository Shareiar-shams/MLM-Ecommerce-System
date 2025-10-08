<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        if (!Auth::guard('admin')->check()) {
            
            return redirect()->route('admin.login');
        }

        $admin = Auth::guard('admin')->user();
        $method = $request->method();
        if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            activity()
                ->causedBy($admin)
                ->event('admin_action')
                ->withProperties([
                    'url' => $request->fullUrl(),
                    'method' => $method,
                    'input' => $request->except(['password', 'password_confirmation']),
                ])
                ->log("Admin performed {$method} request");
        }

        if ($request->is('admin/*') && !$request->is('admin/login') && !$request->is('admin/logout')) {
            session(['last_admin_url' => $request->fullUrl()]);
        }
        return $next($request);
    }
}
