<?php
namespace App\Http\Responses;


class LoginResponse
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Only apply this rule for admin guard
        if ($request->is('admin/*') || $request->routeIs('admin.login')) {
            $lastAdminUrl = session()->pull('last_admin_url');
            $intended     = session()->pull('url.intended', route('admin.home'));

            // Priority: last admin URL > intended admin URL > dashboard
            if ($lastAdminUrl) {
                return redirect()->to($lastAdminUrl);
            }

            if (str_contains($intended, '/admin')) {
                return redirect()->to($intended);
            }

            return redirect()->route('admin.home');
        }

        // Default behavior for other guards/users
        return redirect()->intended('/');
    }
}
