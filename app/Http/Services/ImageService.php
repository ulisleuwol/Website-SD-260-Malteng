<?php

namespace App\Http\Services;

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public function uploadImage(array $data, string $directory, string $oldImage = null)
    {
        $file = $data['image'];
        $imageName = uniqid() . '.webp';
        $oriPath = storage_path('app/public/' . $directory . '/');
        $thumbPath = storage_path('app/public/' . $directory . '/thumbnail/');

        if (!file_exists($oriPath)) {
            mkdir($oriPath, 0755, true);
        }
        if (!file_exists($thumbPath)) {
            mkdir($thumbPath, 0755, true);
        }

        $intervention = new ImageManager(new Driver);

        // Resize, quality, and convert image
        $intervention->read($file)->scale(width: 900)->toWebp(100)->save($oriPath . $imageName);
        $intervention->read($file)->scale(width: 300)->toWebp(100)->save($thumbPath . $imageName);

        // Delete old image
        if ($oldImage) {
            Storage::delete([
                $directory . '/' . $oldImage,
                $directory . '/thumbnail/' . $oldImage
            ]);
        }

        $data['image'] = $imageName;

        return $data['image'];
    }
}
