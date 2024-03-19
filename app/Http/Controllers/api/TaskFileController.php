<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Resources\FileResource;
use App\Services\Interfaces\FileService;

class TaskFileController extends Controller
{
    public function store(StoreFileRequest $request, FileService $service, int $taskId): FileResource
    {
        return new FileResource($service->store($request, $taskId));
    }

    public function destroy(int $id, FileService $service)
    {
        //
    }
}
