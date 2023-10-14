<?php

namespace App\Services;

use Intervention\Image\ImageManager;

class UploadPhoto
{
    public static function FileUpload($file, $path, $name, $width, $height)
    {
        $path = trim($path, "\/") . "/";
        $pathinfo = pathinfo($file["name"], PATHINFO_EXTENSION);
        $name .= "." . $pathinfo;

        if (!file_exists($path)) {
            if (!mkdir($path, 0777, true)) {
                return "We could not make such a path !!..";
            }
        }

        $manager = new ImageManager(['driver' => 'GD']);
        $image = $manager->make($file["tmp_name"])->resize($width, $height);
        $image->save($path . $name);

        return $path . $name;
    }
}
