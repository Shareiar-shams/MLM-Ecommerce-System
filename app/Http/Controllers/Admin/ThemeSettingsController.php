<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeSettingsController extends Controller
{
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        AdminThemeSetting::updateOrCreate(
            ['admin_id' => $admin->id],
            ['settings' => $request->settings]
        );

        return response()->json(['success' => true]);
    }

    public function get()
    {
        $admin = Auth::guard('admin')->user();
        $settings = AdminThemeSetting::where('admin_id', $admin->id)->first();
        
        return response()->json([
            'settings' => $settings ? $settings->settings : null
        ]);
    }
}