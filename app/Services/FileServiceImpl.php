<?php

namespace App\Services;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\File;
use App\Models\Task;
use App\Services\Interfaces\FileService;
use App\Utils\ImageUtil;

class FileServiceImpl implements FileService
{
    public function store(StoreFileRequest $request, int $taskId): array
    {
        $data = ImageUtil::upload($request->validated(), "tasks", $taskId);
        $task = Task::findOrFail($taskId);
        foreach ($data as $item) {
            $file = File::create($item);
            $task->files()->attach($file);
        }
        return $data;
    }

    public function destroy(int $taskId, int $id): array
    {
        $task = Task::findOrFail($taskId);
        $file = $task->files()->find($id);
        $path = "";
        if (!is_null($file)) {
            $path = $file->path;
            $file->delete();
        }
        if (!ImageUtil::delete($path)) {
            abort(404);
        }
        return ["message" => "File with id $id deleted"];
    }
}
