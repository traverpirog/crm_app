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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectServiceImpl implements ProjectService
{
    public function index(IndexProjectRequest $request): LengthAwarePaginator
    {
        $data = $request->validated();
        $data['limit'] = $data['limit'] ?? 8;
        return Project::query()->paginate($data['limit']);
    }

    public function show(int $id): Model|Collection|Builder|array|null
    {
        return Project::query()->with("tasks")->findOrFail($id);
    }

    public function store(StoreProjectRequest $request): Builder|Model
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? EntityStatus::ACTIVE;
        return Project::query()->create($data);
    }

    public function update(UpdateProjectRequest $request, int $id): Builder|array|Collection|Model
    {
        $data = $request->validated();
        $founded = Project::query()->findOrFail($id);
        $founded->update($data);
        return $founded;
    }

    public function destroy(int $id): array
    {
        if (!Project::destroy($id)) {
            abort(404);
        }
        return ["message" => "Project with id $id deleted"];
    }
}
