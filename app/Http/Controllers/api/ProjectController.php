<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\IndexProjectRequest;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Services\Interfaces\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    private ProjectService $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }


    public function index(IndexProjectRequest $request): AnonymousResourceCollection
    {
        return ProjectResource::collection($this->service->index($request));
    }

    public function store(StoreProjectRequest $request): ProjectResource
    {
        return new ProjectResource($this->service->store($request));
    }

    public function show(int $id): ProjectResource
    {
        return new ProjectResource($this->service->show($id));
    }


    public function update(UpdateProjectRequest $request, int $id): ProjectResource
    {
        return new ProjectResource($this->service->update($request, $id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->service->destroy($id));
    }
}
