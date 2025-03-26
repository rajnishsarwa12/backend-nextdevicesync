<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * Convert an image to WebP and store it using move function.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $path
     * @return string|null
     */
    public function convertToWebP($image, $path)
    {
        if (!$image->isValid()) {
            return null;
        }

        // Generate WebP file name
        $webpFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.webp';
        $webpPath = public_path($path . '/' . $webpFileName);

        // Convert image to WebP
        $img = Image::make($image)->encode('webp', 80);

        // Save the WebP image temporarily
        $tempPath = tempnam(sys_get_temp_dir(), 'webp');
        $img->save($tempPath);

        // Move the WebP file to the desired directory
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        rename($tempPath, $webpPath);

        return $webpFileName; // Return WebP file name
}
}