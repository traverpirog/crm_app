<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Project\IndexProjectRequest;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProjectService
{
    public function index(IndexProjectRequest $request): LengthAwarePaginator;

    public function show(int $id): Model|Collection|Builder|array|null;

    public function store(StoreProjectRequest $request): Builder|Model;

    public function update(UpdateProjectRequest $request, int $id): Builder|array|Collection|Model;

    public function destroy(int $id): array;
}
