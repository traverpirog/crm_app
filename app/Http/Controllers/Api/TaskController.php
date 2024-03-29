<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\File\StoreFileResource;
use App\Http\Resources\Task\IndexTaskResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\File;
use App\Models\Roles;
use App\Models\Task;
use App\Models\User;
use App\Services\Interfaces\FileService;
use App\Services\Interfaces\TaskService;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService,
        private readonly FileService $fileService
    )
    {
    }

    public function index(IndexTaskRequest $request): AnonymousResourceCollection
    {
        return IndexTaskResource::collection($this->taskService->index($request, auth()->user()));
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        $task = $this->taskService->store($request, auth()->user());
        return new TaskResource($task);
    }

    public function storeFile(StoreFileRequest $request, Task $task): AnonymousResourceCollection
    {
        return StoreFileResource::collection($this->fileService->store($request, $task->id, Task::class));
    }

    public function destroyFile(Task $task, File $file): JsonResponse
    {
        return response()->json($this->fileService->destroy($task->id, $file->id, Task::class));
    }

    public function show(Task $task): TaskResource
    {
        $this->checkTaskAccess($task);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $task = $this->taskService->update($request, $task);
        return new TaskResource($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        return response()->json($this->taskService->destroy($task));
    }
}
