<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Project\IndexProjectRequest;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProjectService
{
    public function index(IndexProjectRequest $request): LengthAwarePaginator;

    public function show(int $id): ?Project;

    public function store(StoreProjectRequest $request): Project;

    public function update(UpdateProjectRequest $request, int $id): Project;

    public function destroy(int $id): array;
}
