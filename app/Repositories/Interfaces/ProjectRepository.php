<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepository
{
    public function index(int $limit = 8): LengthAwarePaginator;

    public function store(array $data): Project;

    public function show(int $id): Builder|array|Collection|Model;

    public function update(int $id, array $data): ?Project;

    public function destroy(int $id): bool;
}
