<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Responses\LoginResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthenticatedSessionController extends Controller
{
    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Display the admin login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // If already logged in, redirect to admin dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.login.login');
    }

    /**
     * Handle an incoming admin authentication request.
     *
     * @param  \App\Http\Requests\Admin\AdminLoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Attempt to authenticate as admin
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();
            // Check if admin account is active
            if (!$admin->status) {
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'email' => 'Your account has been disabled. Please contact administrator.'
                ])->withInput($request->only('email'));
            }

            // Regenerate session for security
            $request->session()->regenerate();
            
            // Set admin session data
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            Session::put('admin_email', $admin->email);
            
            // // Log successful login
            // Log::info('Admin logged in successfully', [
            //     'admin_id' => $admin->id,
            //     'admin_email' => $admin->email,
            //     'ip_address' => $request->ip(),
            //     'user_agent' => $request->userAgent()
            // ]);

            return redirect()->intended($this->redirectTo);
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Destroy an authenticated admin session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        // if ($admin) {
        //     // Log logout
        //     Log::info('Admin logged out', [
        //         'admin_id' => $admin->id,
        //         'admin_email' => $admin->email,
        //         'ip_address' => $request->ip()
        //     ]);
        // }

        // Clear admin session data
        Session::forget(['admin_id', 'admin_name', 'admin_email']);
        
        // Logout from admin guard
        Auth::guard('admin')->logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Check if admin is authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth()
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            return response()->json([
                'authenticated' => true,
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'image' => $admin->image
                ]
            ]);
        }

        return response()->json([
            'authenticated' => false
        ], 401);
    }

    /**
     * Refresh admin session
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshSession()
    {
        if (Auth::guard('admin')->check()) {
            // Regenerate session ID for security
            request()->session()->regenerate();
            
            return response()->json([
                'success' => true,
                'message' => 'Session refreshed successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Not authenticated'
        ], 401);
    }
}
