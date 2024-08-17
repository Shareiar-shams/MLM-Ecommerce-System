<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected $redirectTo = 'admin/home';
    /**
     * Display the login view.
     */
    public function create(): View
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('admin.login.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            // return redirect()->intended();
            // return redirect()->intended();
            return redirect()->route('admin.home');
        }
        return back()->withErrors([
            'email' => 'You are Not Active Person, Please Contact Admin!',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
