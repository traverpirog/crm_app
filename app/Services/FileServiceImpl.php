<?php

namespace App\Services;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\File;
use App\Models\Task;
use App\Services\Interfaces\FileService;
use App\Utils\ImageUtil;
use DB;
use Illuminate\Database\Eloquent\Model;

class FileServiceImpl implements FileService
{
    public function store(StoreFileRequest $request, int $entityId, string $className): array
    {
        $entity = $this->getEntity($entityId, $className);
        $data = ImageUtil::upload($request->validated(), $entity->getTable(), $entityId);
        foreach ($data as $item) {
            $file = File::create($item);
            $entity->files()->attach($file);
        }
        return $data;
    }

    public function destroy(int $entityId, int $id, string $className): array
    {
        $entity = $this->getEntity($entityId, $className);
        $file = $entity->files()->find($id);
        $path = "";
        if (!is_null($file)) {
            $path = $file->path;
            DB::delete("delete from filables where file_id = ? and filable_type = ?", [$file->id, $className]);
            $file->delete();
        }
        if (!ImageUtil::delete($path)) {
            abort(404);
        }
        return ["message" => "File with id $id deleted"];
    }

    private function getEntity(int $entityId, string $className): Model
    {
        $entity = new $className;
        if (!($entity instanceof Model)) {
            abort(500, "Use correct entity. It should be extended from Model");
        }
        return $entity->newQuery()->findOrFail($entityId);
    }
}
