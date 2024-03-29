<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\File\StoreTaskFileResource;
use App\Models\Task;
use App\Services\Interfaces\FileService;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskFileController extends Controller
{
    private FileService $service;

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function store(StoreFileRequest $request, int $taskId): AnonymousResourceCollection
    {
        return StoreTaskFileResource::collection($this->service->store($request, $taskId, Task::class));
    }

    public function destroy(int $taskId, int $id): JsonResponse
    {
        return response()->json($this->service->destroy($taskId, $id, Task::class));
    }
}
