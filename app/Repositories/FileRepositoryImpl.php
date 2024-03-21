<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Task;
use App\Repositories\Interfaces\FileRepository;

class FileRepositoryImpl implements FileRepository
{

    public function store(array $data, int $taskId): array
    {
        $task = Task::findOrFail($taskId);
        foreach ($data as $item) {
            $file = File::create($item);
            $task->files()->attach($file);
        }
        return $data;
    }

    public function destroy(int $taskId, int $id): ?string
    {
        $task = Task::findOrFail($taskId);
        $file = $task->files()->find($id);
        $path = "";
        if (!is_null($file)) {
            $path = $file->path;
            $file->delete();
        }
        return $path;
    }
}
