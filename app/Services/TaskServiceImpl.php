<?php

namespace App\Services;

use App\Http\Requests\Task\IndexTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\EntityStatus;
use App\Models\Roles;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use App\Services\Interfaces\TaskService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorAlias;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_Task_C;

class TaskServiceImpl implements TaskService
{
    public function index(IndexTaskRequest $request, User $user): LengthAwarePaginator
    {
        $data = $request->validated();
        $data['limit'] = $data['limit'] ?? 8;
        $data['order_by'] = $data['order_by'] ?? "created_at";
        $data['order_dir'] = $data['order_dir'] ?? "desc";
        if ($user->role === Roles::ADMIN->value) {
            return $this->getAll($data);
        }
        return $user->tasks()
            ->orderBy($data["order_by"], $data["order_dir"])
            ->paginate($data['limit'])
            ->withQueryString();
    }

    public function store(StoreTaskRequest $request, User $user): Task
    {
        $data = $request->validated();
        $data["status"] = $data["status"] ?? EntityStatus::ACTIVE;
        $data["user_id"] = $user->id;
        $task = Task::query()->create($data);
        $this->updateOrCreateRelations($task->id, $data["users_id"] ?? []);
        return $task;
    }

    public function show(int $id): ?Task
    {
        return Task::query()->findOrFail($id);
    }

    public function update(UpdateTaskRequest $request, int $id): Task
    {
        $data = $request->validated();
        $founded = Task::query()->findOrFail($id);
        $founded->update($data);
        $this->updateOrCreateRelations($id, $data["users_id"] ?? []);
        return $founded;
    }

    public function destroy(int $id): array
    {
        if (!Task::destroy($id)) {
            abort(404);
        }
        return ["message" => "Task with id $id deleted"];
    }

    private function getAll(array $data): LengthAwarePaginatorAlias|array|LengthAwarePaginator|_IH_Task_C
    {
        return Task::query()
            ->orderBy($data["order_by"], $data["order_dir"])
            ->paginate($data["limit"])->withQueryString();
    }

    private function updateOrCreateRelations(int $task_id, $users_id): void
    {
        foreach ($users_id as $user_id) {
            UserTask::query()->updateOrCreate([
                "user_id" => $user_id,
                "task_id" => $task_id
            ]);
        }
    }
}
