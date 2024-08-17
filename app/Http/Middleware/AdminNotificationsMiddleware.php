<?php

namespace App\Http\Middleware;

use App\Models\Admin\Message;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AdminNotificationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();
        $notifications = Message::where('receiver_type', 'admin')
            ->where('receiver_id', $admin->id)
            ->where('is_read', 0)
            ->groupBy('sender_id')
            ->orderBy('sender_id','ASC')
            ->get();

        // Share the $notifications variable with all views
        view()->share('notifications', $notifications);

        return $next($request);
    }
}
