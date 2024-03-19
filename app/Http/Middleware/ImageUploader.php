<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public static function upload(array $data, string $entityName, $id): array
    {
        $path = "/uploads/files/$entityName/$id";
        $files = $data['attachment'];
        $loadedFiles = [];
        foreach ($files as $file) {
            $loadedPath = Storage::putFileAs($path, $file, $file->getClientOriginalName());
            $loadedFiles[] = [
                "path" => $loadedPath,
                "type" => $file->getMimeType()
            ];
        }
        return $loadedFiles;
    }
}
