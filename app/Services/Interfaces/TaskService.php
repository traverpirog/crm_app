<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskService
{
    public function index(IndexTaskRequest $request): LengthAwarePaginator;

    public function show(int $id): ?Task;

    public function store(StoreTaskRequest $request): Task;

    public function update(UpdateTaskRequest $request, int $id): Task;

    public function destroy(int $id): array;
}
