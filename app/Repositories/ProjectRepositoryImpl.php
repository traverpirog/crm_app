<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepositoryImpl implements ProjectRepository
{

    public function index(int $limit = 8): LengthAwarePaginator
    {
        return Project::paginate($limit);
    }

    public function store(array $data): Project
    {
        return Project::create($data);
    }

    public function show(int $id): Builder|array|Collection|Model
    {
        return Project::with("tasks")->findOrFail($id);
    }

    public function update(int $id, array $data): ?Project
    {
        $founded = Project::findOrFail($id);
        $founded->update($data);
        return $founded;
    }

    public function destroy(int $id): bool
    {
        return Project::destroy($id);
    }
}
