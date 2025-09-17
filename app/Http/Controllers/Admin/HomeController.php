<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminPassRequest;
use App\Http\Requests\Admin\AdminProfileRequest;
use App\Http\Requests\Admin\ImageUploadRequest;
use App\Services\Admin\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = auth('admin')->user();
        $activities = $admin->activities()->latest()->get();
 
        return view('admin.profile.index', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileRequest $request, string $id)
    {
        $this->dashboardService->updateAdmin($id, $request->validated());

        return redirect()->back()->with([
            'message' => 'Profile Updated Successfully!',
            'alert-type' => 'success',
        ]);
    }

    /**
     * ImageUpdate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imgupdate(ImageUploadRequest $request, $id)
    {
        $this->dashboardService->updateProfileImage($request, $id);
        
        return redirect()->back()->with([
            'message' => 'Profile Picture Updated Successfully!',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Admin Password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passupdate(AdminPassRequest $request, $id)
    {
        $notification = $this->dashboardService->updatePassword(
            $id,
            $request->old_password,
            $request->new_password
        );

        return redirect()->back()->with($notification);
    }

    public function cache()
    {
        $this->dashboardService->clearCache();

        return redirect()->back()->with([
            'message' => 'Application Cache Cleared Successfully!',
            'alert-type' => 'success',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
