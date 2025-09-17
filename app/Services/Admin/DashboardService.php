<?php

namespace App\Services\Admin;

use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DashboardService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function updateAdmin(int $id, array $data): Admin
    {
        $admin = Admin::findOrFail($id);
        $admin->fill([
            'name'     => $data['name'],
            'position' => $data['position'] ?? null,
            'phone'    => $data['phone'],
        ]);
        $admin->save();

        return $admin;
    }

    public function updatePassword(int $id, string $oldPassword, string $newPassword): array
    {
        $admin = Admin::findOrFail($id);

        if (Hash::check($oldPassword, $admin->password)) {
            $admin->update([
                'password' => Hash::make($newPassword),
            ]);

            return [
                'message' => 'Password Changed!',
                'alert-type' => 'success',
            ];
        }

        return [
            'message' => 'Password does not match!',
            'alert-type' => 'error',
        ];
    }

    public function updateProfileImage($request, $id)
    {
        $admin = Admin::findOrFail($id);

        if ($request->hasFile('image')) {
            $filename = $this->imageService->uploadAndResize(
                $request->file('image'),
                'admins'
            );
            $admin->image = $filename;
        }

        $admin->save();

        return $admin;
    }

    public function clearCache(): void
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
    }
}
