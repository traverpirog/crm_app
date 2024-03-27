<?php

namespace App\Services;

use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Services\Interfaces\CommentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CommentServiceImpl implements CommentService
{
    public function store(StoreCommentRequest $request, int $task_id): Comment
    {
        $data = $request->validated();
        $data["task_id"] = $task_id;
        $data["user_id"] = auth()->user()->id;
        return Task::query()->findOrFail($task_id)->comments()->create($data);
    }

    public function update(UpdateCommentRequest $request, int $task_id, int $comment_id)
    {
        // TODO: Implement update() method.
    }

    public function destroy(int $task_id, int $comment_id)
    {
        // TODO: Implement destroy() method.
    }
}
