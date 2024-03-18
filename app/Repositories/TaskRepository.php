<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskRepository
{
    public function index(int $limit = 8): LengthAwarePaginator;

    public function store(array $data): Task;

    public function show(int $id): Task;

    public function update(Task $founded, array $data): Task;

    public function destroy(int $id): bool;
}
