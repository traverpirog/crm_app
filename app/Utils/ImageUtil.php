<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class ImageUtil
{
    public static function upload(array $data, string $entityName = "uploads", $id = ''): array
    {
        $path = "$entityName/$id";
        $files = $data['attachment'];
        $loadedFiles = [];
        foreach ($files as $file) {
            $loadedPath = Storage::putFile("/public/$path", $file);
            $loadedFiles[] = [
                "path" => $path . "/" . basename($loadedPath),
                "type" => $file->getMimeType()
            ];
        }
        return $loadedFiles;
    }

    public static function delete(string $path): bool
    {
        return Storage::delete("/public/" . $path);
    }
}
