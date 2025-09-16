<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Only apply this rule for admin guard
        if ($request->routeIs('admin.login') || $request->guard === 'admin') {
            // Get the intended URL (from session)
            $intended = session()->pull('url.intended', route('admin.home'));

            // Check if the intended URL is within admin dashboard
            if (str_contains($intended, '/admin')) {
                return redirect()->to($intended);
            }
 
            // Otherwise, always redirect to admin dashboard
            return redirect()->route('admin.home');
        }

        // Default behavior for other guards/users
        return redirect()->intended('/');
    }
}
