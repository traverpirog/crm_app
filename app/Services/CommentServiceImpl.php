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
    public function store(StoreCommentRequest $request, Task $task): Comment
    {
        $data = $request->validated();
        $data["task_id"] = $task->id;
        $data["user_id"] = auth()->user()->id;
        return Task::query()->findOrFail($task->id)->comments()->create($data);
    }

    public function update(UpdateCommentRequest $request, Comment $comment): Builder|array|Collection|Model
    {
        $data = $request->validated();
        $comment->update($data);
        return $comment;
    }

    public function destroy(Comment $comment): array
    {
        $isDeleted = $comment->delete();
        if (!$isDeleted) {
            abort(404);
        }
        return ["message" => "Comment with id $comment->id deleted"];
    }
}
