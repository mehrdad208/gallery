<?php

namespace App\Utilities;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public static function upload($image, $basePath, $diskType)
    {
        if (!is_null($image)) {
            Storage::disk($diskType)->put($basePath, File::get($image));
        }
    }
    public static function uploadMany(array $images, $basePath, $diskType = 'public_storage')
    {
        $imagesPath = [];

        foreach ($images as $key => $image) {

            $fullPath = $basePath . $key . '_' . $image->getClientOriginalName();
            if (!is_null($image)) {
                Storage::disk($diskType)->put($fullPath, File::get($image));
            }
            $imagesPath += [$key => $fullPath];
        }
        return $imagesPath;
    }
}
