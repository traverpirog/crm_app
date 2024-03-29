<?php

namespace App\Services;

use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Services\Interfaces\CommentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CommentServiceImpl implements CommentService
{
    public function store(StoreCommentRequest $request, int $task_id): Comment
    {
        $data = $request->validated();
        $data["task_id"] = $task_id;
        $data["user_id"] = auth()->user()->id;
        return Task::query()->findOrFail($task_id)->comments()->create($data);
    }

    public function update(UpdateCommentRequest $request, int $task_id, int $comment_id): Builder|array|Collection|Model
    {
        $data = $request->validated();
        $task = Task::query()->findOrFail($task_id);
        $comment = $task->comments()->findOrFail($comment_id);
        $comment->update($data);
        return $comment;
    }

    public function destroy(int $task_id, int $comment_id): array
    {
        $task = Task::query()->findOrFail($task_id);
        $isDeleted = $task->comments()->delete($comment_id);
        if (!$isDeleted) {
            abort(404);
        }
        return ["message" => "Comment with id $comment_id deleted"];
    }
}
