<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\Task\IndexTaskResource;
use App\Http\Resources\Task\TaskResource;
use App\Services\Interfaces\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    private TaskService $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index(IndexTaskRequest $request): AnonymousResourceCollection
    {
        return IndexTaskResource::collection($this->service->index($request));
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        $task = $this->service->store($request);
        return new TaskResource($task);
    }

    public function show(int $id): TaskResource
    {
        $task = $this->service->show($id);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, int $id): TaskResource
    {
        $task = $this->service->update($request, $id);
        return new TaskResource($task);
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->service->destroy($id));
    }
}
