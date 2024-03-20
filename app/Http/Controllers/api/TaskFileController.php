<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Resources\FileResource;
use App\Services\Interfaces\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskFileController extends Controller
{
    public function store(StoreFileRequest $request, FileService $service, int $taskId): AnonymousResourceCollection
    {
        return FileResource::collection($service->store($request, $taskId));
    }

    public function destroy(int $taskId, int $id, FileService $service): JsonResponse
    {
        return response()->json($service->destroy($taskId, $id));
    }
}
