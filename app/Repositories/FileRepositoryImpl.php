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

	public function destroy(int $id): bool
	{
        return File::destroy($id);
	}
}
