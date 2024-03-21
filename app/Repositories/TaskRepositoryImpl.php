<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepositoryImpl implements TaskRepository
{
    public function index(int $limit = 8): LengthAwarePaginator
    {
        return Task::paginate($limit)->withQueryString();
    }

    public function store(array $data): Task
    {
        return Task::create($data);
    }

    public function show(int $id): Task
    {
        return Task::with('files')->findOrFail($id);
    }

    public function update(int $id, array $data): Task
    {
        $founded = Task::findOrFail($id);
        $founded->update($data);
        return $founded;
    }

    public function destroy(int $id): bool
    {
        return Task::destroy($id);
    }
}
