<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepository
{
    public function index(int $limit = 8): LengthAwarePaginator;

    public function store(array $data): Project;

    public function show(int $id): ?Project;

    public function update(int $id, array $data): ?Project;

    public function destroy(int $id): bool;
}
