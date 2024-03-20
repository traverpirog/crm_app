<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public static function upload(array $data, string $entityName = "uploads", $id = ''): array
    {
        $files = $data['attachment'];
        $loadedFiles = [];
        foreach ($files as $file) {
            $loadedPath = Storage::putFile("/public/$entityName/$id", $file);
            $loadedFiles[] = [
                "path" => $loadedPath,
                "type" => $file->getMimeType()
            ];
        }
        return $loadedFiles;
    }
}
