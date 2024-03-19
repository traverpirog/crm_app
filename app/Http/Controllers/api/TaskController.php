<?php

namespace App\Http\Controllers\api;

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
    /**
     * Display a listing of the resource.
     */
    public function index(IndexTaskRequest $request, TaskService $service): AnonymousResourceCollection
    {
        return IndexTaskResource::collection($service->index($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, TaskService $service): TaskResource
    {
        $task = $service->store($request);
        return new TaskResource($task);
    }

    public function show(int $id, TaskService $service): TaskResource
    {
        $task = $service->show($id);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $id, TaskService $service): TaskResource
    {
        $task = $service->update($request, $id);
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, TaskService $service): JsonResponse
    {
        return response()->json($service->destroy($id));
    }
}
