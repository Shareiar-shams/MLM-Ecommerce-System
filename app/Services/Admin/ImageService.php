<?php

namespace App\Services\Admin;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function uploadAndResize($file, $folder, $filename = null)
    {
        $filename = $filename ?? uniqid().'.'.$file->getClientOriginalExtension();

        // Original
        $path = $file->storeAs($folder.'/original', $filename, 'public');

        // Avatar (50x50)
        $this->resizeAndSave($file, $folder.'/avatar', $filename, 50, 50);

        // Thumbnail (150x150)
        $this->resizeAndSave($file, $folder.'/thumbnail', $filename, 150, 150);

        // Medium (300x300)
        $this->resizeAndSave($file, $folder.'/medium', $filename, 300, 300);

        // Full (800x800)
        $this->resizeAndSave($file, $folder.'/full', $filename, 800, 800);

        return $filename;
    }

    private function resizeAndSave($file, $folder, $filename, $width, $height)
    {
        $image = $this->imageManager->read($file)->cover($width, $height);
        $path = storage_path('app/public/'.$folder);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $image->save($path.'/'.$filename);
    }

    public function getImageUrl($folder, $filename, $type = 'original')
    {
        return asset("storage/{$folder}/{$type}/{$filename}");
    }
}
