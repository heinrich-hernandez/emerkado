<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

class ImageResizer
{
    public static function resizeAndSaveImage($file, $folder, $user_id = null)
    {

        // To fix

        $image = Image::make($file)->resize(300, 300);
        $filename = $user_id . '.' . $file->getClientOriginalExtension();
        $path = public_path('storage/' . $folder . '/' . $filename);
        $image->save($path);
        return $folder . '/' . $filename;
    }
}
