<?php

namespace App\Services;

use App\Http\Requests\Project\IndexProjectRequest;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\EntityStatus;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepository;
use App\Services\Interfaces\ProjectService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectServiceImpl implements ProjectService
{
    private ProjectRepository $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }


    public function index(IndexProjectRequest $request): LengthAwarePaginator
    {
        $data = $request->validated();
        $data['limit'] = $data['limit'] ?? 8;
        return $this->repository->index($data['limit']);
    }

    public function show(int $id): ?Project
    {
        return $this->repository->show($id);
    }

    public function store(StoreProjectRequest $request): Project
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? EntityStatus::ACTIVE;
        return $this->repository->store($data);
    }

    public function update(UpdateProjectRequest $request, int $id): Project
    {
        $data = $request->validated();
        return $this->repository->update($id, $data);
    }

    public function destroy(int $id): array
    {
        if (!$this->repository->destroy($id)) {
            abort(404);
        }
        return ["message" => "Project with id $id not found"];
    }
}
