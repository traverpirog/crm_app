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
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(IndexTaskRequest $request): LengthAwarePaginator
    {
        $data = $request->validated();
        $data['limit'] = $data['limit'] ?? 8;
        return $this->repository->index($data['limit']);
    }

    public function store(StoreTaskRequest $taskRequest): Task
    {
        $taskData = $taskRequest->validated();
        $taskData['status'] = $taskData['status'] ?? EntityStatus::ACTIVE;
        return $this->repository->store($taskData);
    }

    public function show(int $id): ?Task
    {
        return $this->repository->show($id);
    }

    public function update(UpdateTaskRequest $request, int $id): Task
    {
        $data = $request->validated();
        $founded = Task::findOrFail($id);
        return $this->repository->update($founded, $data);
    }

    public function destroy(int $id): array
    {
        if (!$this->repository->destroy($id)) {
            abort(404);
        }
        return ["message" => "Task with id $id deleted"];
    }
}
