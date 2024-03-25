<?php

namespace App\Services;

use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\EntityStatus;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use App\Services\Interfaces\TaskService;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskServiceImpl implements TaskService
{
    public function index(IndexTaskRequest $request): LengthAwarePaginator
    {
        $data = $request->validated();
        $data['limit'] = $data['limit'] ?? 8;
        return Task::paginate($data['limit'])->withQueryString();
    }

    public function store(StoreTaskRequest $request): Task
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? EntityStatus::ACTIVE;
        return Task::create($data);
    }

    public function show(int $id): ?Task
    {
        return Task::with('files')->findOrFail($id);
    }

    public function update(UpdateTaskRequest $request, int $id): Task
    {
        $data = $request->validated();
        $founded = Task::findOrFail($id);
        $founded->update($data);
        return $founded;
    }

    public function destroy(int $id): array
    {
        if (!Task::destroy($id)) {
            abort(404);
        }
        return ["message" => "Task with id $id deleted"];
    }
}
