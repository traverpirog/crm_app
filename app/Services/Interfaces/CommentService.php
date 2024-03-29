<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentService
{
    public function store(StoreCommentRequest $request, Task $task);

    public function update(UpdateCommentRequest $request, Comment $comment);

    public function destroy(Comment $comment);
}
