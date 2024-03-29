<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskService
{
    public function index(IndexTaskRequest $request, User $user): LengthAwarePaginator;

    public function store(StoreTaskRequest $request, User $user): Task;

    public function update(UpdateTaskRequest $request, Task $task): Task;

    public function destroy(Task $task): array;
}
